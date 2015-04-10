<?php

$m = new MongoClient();
$db = $m->challenge;
$matches_collection = $db->matches;
$stats_collection = $db->champ_stats;
$ranked_collection = $db->ranked_data;

class Champion {
    public $championId = 0;
    public $games = 0;
    public $nomirrorgames = 0;
    public $wins = 0;
    public $bans = 0;
    public $pickrate = 0;
    public $winrate = 0;
    public $banrate = 0;
}

class Ranks {
    public $unranked = 0;
    public $bronze = 0;
    public $silver = 0;
    public $gold = 0;
    public $plat = 0;
    public $diamond = 0;
    public $master = 0;
    public $challenger = 0;
}

$totalGames = 0;

$servername = "";
$username = "";
$password = "";
$dbname = "";
$apikey = "";

$conn = new mysqli($servername, $username, $password, $dbname);
if(!$conn){
    die("Connection failed: " .mysqli_connect_error());
}

function dragonVersion($conn) {
    $sql = "SELECT version FROM dragon WHERE current=1";
    $result = $conn->query($sql);
    $version = "5.2.1";
    if($result === FALSE) {
        echo $conn->error;
    } else {
        $row = $result->fetch_assoc();
        $version = $row['version'];
    }
    return $version;
}

function getSpellImage($conn, $id) {
    $sql = "SELECT image FROM summoner_spells WHERE id=$id";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $imageurl = $row['image'];
    $version = dragonVersion($conn);
    $fullurl = "http://ddragon.leagueoflegends.com/cdn/$version/img/spell/$imageurl";
    return "<img src=\"$fullurl\" height=\"32\" width=\"32\">";
}

function getChampImage($conn, $id){
    $sql = "SELECT image FROM champions WHERE id=$id";
    $result = $conn->query($sql);
    $version = dragonVersion($conn);
    $row = $result->fetch_assoc();
    $imageurl = $row['image'];
    $fullurl = "http://ddragon.leagueoflegends.com/cdn/$version/img/champion/$imageurl";
    return "<img src=\"$fullurl\" height=\"32\" width=\"32\">";
}

function mirrorMatch($participants, $champion) {
    $count = 0;
    foreach ($participants as $player) {
        if($player["championId"] == $champion){
            $count++;
            if($count > 1) {
                return true;
            }
        }    
    }
    return false;
}

function updateRanks($ranks, $participant) {
    $rank = $participant["highestAchievedSeasonTier"];
    switch($rank) {
    case "UNRANKED":
        $ranks->unranked++;
        break;
    case "BRONZE":
        $ranks->bronze++;
        break;
    case "SILVER":
        $ranks->silver++;
        break;
    case "GOLD":
        $ranks->gold++;
        break;
    case "PLATINUM":
        $ranks->plat++;
        break;
    case "DIAMOND":
        $ranks->diamond++;
        break;
    case "MASTER":
        $ranks->master++;
        break;
    case "CHALLENGER":
        $ranks->challenger++;
        break;
    default:
        echo "ERROR: Rank $rank unknown!";
    }
}

function processChampStats($collection, $stats_coll, $ranked_coll) {
    $cursor = $collection->find(array(), array('participants' => 1,'teams' => 1));
    $champs = array();
    $ranks = new Ranks();
    $new_document = array();
    foreach ($cursor as $document) {
        $teams = $document["teams"];
        foreach($teams as $team){
            if(isset($team["bans"])){
                $bans = $team["bans"];
                foreach($bans as $ban){
                    $champion = $ban["championId"];
                    if(!isset($champs[$champion])){
                        $champs[$champion] = new Champion();
                    }
                    $champs[$champion]->bans++;
                }
            }
        }
        $participants = $document["participants"];
        foreach($participants as $player){
            $champion = $player["championId"];
            if(!isset($champs[$champion])){
                $champs[$champion] = new Champion();
            }
            $champs[$champion]->games++;
            if(!mirrorMatch($participants, $champion)) {
                $champs[$champion]->nomirrorgames++;
                if($player["stats"]["winner"]){
                    $champs[$champion]->wins++;
                }
            }
            updateRanks($ranks, $player);
        }
    }
    $totalGames = $cursor->count();
    $stats_coll->remove();
    foreach ($champs as $champId => $champ){
        $champ->championId = $champId;
        $wins = $champ->wins;
        $nomirrorgames = $champ->nomirrorgames;
        $games = $champ->games;
        $bans = $champ->bans;
        $winrate = round(($wins / $nomirrorgames) * 100, 1);
        $pickrate = round(($games / ($totalGames*2)) * 100, 1);
        $champ->banrate = round(($bans / $totalGames) * 100, 1);
        $champ->winrate = $winrate;
        $champ->pickrate = $pickrate;
        $stats_coll->insert($champ);
    }
    $ranked_coll->remove();
    $ranked_coll->insert($ranks);
}

function getChampWinRates($collection) {
    $cursor = $collection->find();
    $cursor->sort(array('winrate' => -1));
    $champs = array();
    foreach($cursor as $document){
        $champ = new Champion();
        $champ->championId = $document["championId"];
        $champ->wins = $document["wins"];
        $champ->games = $document["games"];
        $champ->winrate = $document["winrate"];
        $champ->pickrate = $document["pickrate"];
        $champ->bans = $document["bans"];
        $champ->banrate = $document["banrate"];
        $champs[] = $champ;
    }
    return $champs;
}

function getRankedStats($collection) {
    $data = $collection->findOne();
    return $data;
}

function getTotalGames($collection) {
    return $collection->count();
}

?>
