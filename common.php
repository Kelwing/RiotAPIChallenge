<?php

$m = new MongoClient();
$db = $m->challenge;
$collection = $db->matches;

class Champion {
    public $games;
    public $wins;
    public $pickrate;
    public $winrate;
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


function getChampWinRates($collection) {
    $cursor = $collection->find(array(), array('participants' => 1));
    $champs = array();
    foreach ($cursor as $document) {
        $participants = $document["participants"];
        foreach($participants as $player){
            $champion = $player["championId"];
            if(!isset($champs[$champion])){
                $champs[$champion] = new Champion();
                $champs[$champion]->games = 0;
                $champs[$champion]->wins = 0;
            }
            $champs[$champion]->games++;
            if($player["stats"]["winner"]){
                $champs[$champion]->wins++;
            }
        }
    }
    $totalGames = $cursor->count();
    foreach ($champs as $champ){
        $wins = $champ->wins;
        $games = $champ->games;
        $winrate = round(($wins / $games) * 100, 1);
        $pickrate = round(($games / ($totalGames * 2)) * 100, 1);
        $champ->winrate = $winrate;
        $champ->pickrate = $pickrate;
    }
    return $champs;
}

?>
