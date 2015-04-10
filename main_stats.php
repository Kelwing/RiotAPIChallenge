<?php
require_once 'common.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Riot API Challenge</title>
    <link href="../css/jquery.circliful.css" rel="stylesheet" type="text/css" />
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="apichallenge.css" rel="stylesheet">
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/jquery.circliful.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">NURF Statistics Made Pretty</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="../index.php">Recent Game Stats</a></li>
                    <li class="active"><a href="#">Nurf Game Statistics</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="header" style="margin-top:100px; text-align:center; font-size:40px">Most Popular NURF Champions</div>
    <?php
        $winrates = getChampWinRates($collection);
        $counter = 1;
        echo'<table id="mostPopularChampions" class="table"
                <tr>';
                foreach($winrates as $champId => $stats){
                    $games = $stats->games;
                    $wins = $stats->wins;
                    $winrate = $stats->winrate;
                    $pickrate = $stats->pickrate;
                    $champPic = getChampImage($conn, $champId);
                    echo "<td>";
                    echo    '<div id="champ' . $counter . '" class="circle" data-dimension="200" data-text="' . $winrate . '" data-info="Sion" data-width="20" data-fontsize="30" data-percent="50" data-fgcolor="#61a9dc" data-bgcolor="#eee" data-fill="#ddd" data-total="100" data-part="' . $winrate . '" data-icon="long-arrow-up" data-icon-size="28" data-icon-color="#fff"></div>"';
                    echo "</td>";
                    $counter++;
                }
            echo '</tr>
            </table>';
    ?>
            
    <script>
        $( document ).ready(function() {
            $('#champ1').circliful();
            $('#champ2').circliful();
            $('#champ3').circliful();
            $('#champ4').circliful();
            $('#champ5').circliful();
        });
    </script>
    <!--<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
