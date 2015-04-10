<?php
require_once 'common.php';
?>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kelnet Gaming Community</title>
<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
<link rel="stylesheet" href="bootstrap/css/bootstrap-social.css">
<link rel="stylesheet" href="grid.css">
</head>
<body>
<div class="container">
<nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href=".">URF Statistics</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="champions.php">Champions</a></li>
            </ul>
            <a class="btn btn-social-icon btn-twitter navbar-vertical-align navbar-right" href="http://twitter.com/jmwiltse">
                <i class="fa fa-twitter"></i>
            </a>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
</nav>
<h3>URF Champion Statistics</h3>
<?php echo "<p>Total games sampled: " . getTotalGames($matches_collection) . "</p>";
$ranked = getRankedStats($ranked_collection);
$unranked = $ranked["unranked"];
$bronze = $ranked["bronze"];
$silver = $ranked["silver"];
$gold = $ranked["gold"];
$plat = $ranked["plat"];
$diamond = $ranked["diamond"];
$master = $ranked["master"];
$challenger = $ranked["challenger"];
$total = $unranked + $bronze + $silver + $gold + $plat + $diamond + $master + $challenger;
$unranked /= ($total * (1/100));
$bronze /= ($total * (1/100));
$silver /= ($total * (1/100));
$gold /= ($total * (1/100));
$plat /= ($total * (1/100));
$diamond /= ($total * (1/100));
$master /= ($total * (1/100));
$challenger /= ($total * (1/100));
$unranked = round($unranked,1);
$bronze = round($bronze,1);
$silver = round($silver,1);
$gold = round($gold,1);
$plat = round($plat,1);
$diamond = round($diamond,2);
$master = round($master,2);
$challenger = round($challenger,3);

echo "<b>Rank Breakdown: </b></br>";
echo "Unranked: $unranked%, Bronze: $bronze%, Silver: $silver%, Gold: $gold%, Platinum: $plat%, Diamond: $diamond%, Master: $master%, Challenger: $challenger%</br>";
?>
<table class="table sortable">
<tr>
<th class="col-lg-3">Champion</th>
<th class="col-lg-3">Pick Rate</th>
<th class="col-lg-3">Win Rate</th>
<th class="col-lg-3">Ban Rate</th>
</tr>
<?php
$winrates = getChampWinRates($stats_collection);
foreach($winrates as $stats){
    $winrate = $stats->winrate;
    $pickrate = $stats->pickrate;
    $champPic = getChampImage($conn, $stats->championId);
    $banrate = $stats->banrate;
    echo "<tr>";
    echo "<td class=\"col-lg-3\">$champPic</td>";
    echo "<td class=\"col-lg-3\">$pickrate%</td>";
    echo "<td class=\"col-lg-3\">$winrate%</td>";
    echo "<td class=\"col-lg-3\">$banrate%</td>";
    echo "</tr>";
    //echo $champId . " " . $stats->games . " " . $stats->wins . "</br>";
}
?>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="sorttable.js"></script>
</body>
</html>
