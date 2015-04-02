<?php
$apikey = "";
$servername = "localhost";
$username = "";
$password = "";
$dbname = "";

$conn = new mysqli($servername, $username, $password, $dbname);
if(!$conn){
    die("Connection failed: " .mysqli_connect_error());
}
try
{
    $m = new Mongo();
    $db = $m->selectDB("challenge");
}
catch (MongoConnectionException $e) {
    echo '<p>Couldn\'t connect to mongodb</p>';
    exit();
}

$sql = "SELECT matchId FROM matches WHERE processed=0 LIMIT 8";
$result = $conn->query($sql);
if($result === FALSE){
    echo $conn->error;
} else {
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $matchId = $row['matchId'];
            $sql = "UPDATE matches SET processed=1 WHERE matchId=$matchId";
            $match_json = file_get_contents("https://na.api.pvp.net/api/lol/na/v2.2/match/$matchId?includeTimeline=true&api_key=$apikey");
            if($match_json === false){
                echo "Failed to grab match: $matchId\n";
            } else {
                $conn->query($sql);
                $match = json_decode($match_json);
                $db->createCollection("matches");
                $matchCollection = $db->matches;
                $matchCollection->insert($match);
            }
        }
    }
}
?>
