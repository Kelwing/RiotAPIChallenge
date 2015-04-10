<?php
$matchId = "";
$servername = "";
$username = "";
$password = "";
$dbname = "";
$apikey = "";

$conn = new mysqli($servername, $username, $password, $dbname);
if(!$conn){
        die("Connection failed: " .mysqli_connect_error());
}

$tenminago = time() - (60*60*7);
$rounded = ceil($tenminago/300)*300;

$matches = file_get_contents("https://na.api.pvp.net/api/lol/na/v4.1/game/ids?beginDate=$rounded&api_key=$apikey");
$value = json_decode($matches);
$elements = count($value);
echo "Size: $elements";
foreach ($value as $matchId){
    $sql = "INSERT INTO matches VALUES ('$matchId', '0')";
    $result = $conn->query($sql);
    if($result === FALSE){
        echo $conn->error;
    }
}

?>
