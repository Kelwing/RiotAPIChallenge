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
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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
            <a class="navbar-brand" href="/">Kelnet Gaming Community</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/">Home</a></li>
            </ul>
            <form class="navbar-form navbar-right" action="game.php" method="get" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Lookup Game" name="game">
                </div>
                <button type="submit" class="btn btn-default" >Submit</button>
            </form>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
</nav>
<table class="table">
<tr>
<th>Champion</th>
<th>Pick Rate</th>
<th>Win Rate</th>
</tr>
<?php
$winrates = getChampWinRates($collection);
foreach($winrates as $champId => $stats){
    $games = $stats->games;
    $wins = $stats->wins;
    $winrate = $stats->winrate;
    $pickrate = $stats->pickrate;
    $champPic = getChampImage($conn, $champId);
    echo "<tr>";
    echo "<td>$champPic</td>";
    echo "<td>$pickrate%</td>";
    echo "<td>$winrate%</td>";
    echo "</tr>";
    //echo $champId . " " . $stats->games . " " . $stats->wins . "</br>";
}
?>
</table>
<?php echo "<p>Total games sampled: " . $totalGames . "</p>"; ?>
</body>
</html>
