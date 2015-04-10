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
    <link href="./circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="apichallenge.css" rel="stylesheet">
    <script src="./js/jquery-1.11.2.min.js"></script>
    <script src="./circliful/js/jquery.circliful.min.js"></script>
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
                
                    <li class="active"><a href="#">Nurf Game Statistics</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="header" style="margin-top:100px; text-align:center; font-size:40px">Highest Win Rates</div>
    <?php
    
        $winrates = getChampWinRates($stats_collection);
        $counter = 1;
        echo'<table id="mostPopularChampions" class="table"
                <tr>';
                foreach($winrates as $stats){
                    $winrate = $stats->winrate;
                    $champPic = getChampImage($conn, $stats->championId);
                    echo "<td>";
                    echo    '<div id="champ' . $counter . '" class="circle" data-dimension="200" data-text="' . $winrate . '" data-info="Sion" data-width="20" data-fontsize="30" data-percent="50" data-fgcolor="#61a9dc" data-bgcolor="#eee" data-fill="#ddd" data-total="100" data-part="' . $winrate . '" data-icon="long-arrow-up" data-icon-size="28" data-icon-color="#fff"></div>';
                    echo "</td>";
		    if($counter >= 5){
		    	break;
		    }
                    $counter++;
                }
            echo '</tr>
            </table>';
    ?>
    <div class="header" style="margin-top:100px; text-align:center; font-size:40px">Division of Ranks</div>
    <table id="ranksTable" class="table">
    	<tr>
	    <th style="text-align:center">Bronze Logo</th>
	    <th style="text-align:center">Silver Logo</th>
	    <th style="text-align:center">Gold Logo</th>
	    <th style="text-align:center">Platinum Logo</th>
	    <th style="text-align:center">Diamond Logo</th>
	</tr>
	<tr>
	   <!-- display the logos and percentage per league!-->
	</tr>
    </table>        
    <script>
        $( document ).ready(function() {
            $('#champ1').circliful();
            $('#champ2').circliful();
            $('#champ3').circliful();
            $('#champ4').circliful();
            $('#champ5').circliful();
        });
    </script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
