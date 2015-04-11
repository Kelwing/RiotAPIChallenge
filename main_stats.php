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

    <!--JQUERY PLUGIN!-->
    <script src="./js/jquery-1.11.2.min.js"></script>

    <!--bootstrap shit !-->
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- custom stylesheets!-->
    <link href="apichallenge.css" rel="stylesheet">
    <link href="./barchart-plugin/main.css" rel="stylesheet">

    <!-- circliful pie chart shit!-->
    <link href="./circliful/css/jquery.circliful.css" rel="stylesheet" type="text/css" />
    <script src="./circliful/js/jquery.circliful.min.js"></script>

    <!--BARCHART PLUGIN!-->
    <script src="./barchart-plugin/jchart.js"></script>
    
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

    <table class="table">
        <tr style="text-align:center">
            <td style="margin:auto">
                <div id="winRates" data-sort="true" data-width="600" class="jChart chart-sm">
		    <?php
			$colors = array("#1000ff","#006eff","#00b6ff","#00fff6","#00ff90");
			$winrates = getChampWinRates($stats_collection);
			$counter = 1;
			foreach($winrates as $stats){
			    $winrate = $stats->winrate;
			    echo '<div class="define-chart-row" data-color="'.$color[$counter-1].'" title="sumName">'.$winrate.'</div>';
			    if($counter >= 5){
			    	break;
			    }else {
				$counter++;
			    }
			}
		    ?> 
                    <div class="define-chart-footer">10%</div>
                    <div class="define-chart-footer">20%</div>
                    <div class="define-chart-footer">30%</div>
                    <div class="define-chart-footer">40%</div>
                    <div class="define-chart-footer">50%</div>
                    <div class="define-chart-footer">60%</div>
                    <div class="define-chart-footer">70%</div>
                    <div class="define-chart-footer">80%</div>
                    <div class="define-chart-footer">90%</div>
                    <div class="define-chart-footer">100%</div>
                </div>
            </td>
        </tr>
	<tr>
	    <table class="table">
		<tr>
    			<div class="header" style="margin-top:15px; text-align:center; font-size:40px">Division Of Ranks</div>
		</tr>
		<tr>
	<?php 
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
		$pieColors = array("#000", "#5E2323", "#757575", "#EEC900", "#38A3D8", "#fff", "#00FFA", "");
		$rankedNames = array("Unranked", "Bronze","Silver","Gold","Platinum","Diamond","Master","Challenger");
		$ranks = array($unranked, $bronze, $silver, $gold, $plat, $diamond, $master, $challenger);
		$counter = 0;
		foreach($ranks as $value){	
			echo '<td style="margin-right:10px"><div id="rank'.$counter.'" class="circle" style="margin:auto" data-dimension="150" data-text="'.$ranks[$counter].'%" data-info="'.$rankedNames[$counter].'" data-width="20" data-fontsize="30" data-percent="35" data-fgcolor="'.$pieColors[$counter].'" data-bgcolor="#eee" data-fill="#ddd" data-total="100" data-part="'.$ranks[$counter].'" data-icon="long-arrow-up" data-icon-size="28" data-icon-color="#fff"></div></td>';
			$counter++;
		}
	    ?>
	        </tr>
	    </table>
	</tr>
    </table>
    
    <script>
        $( document ).ready(function() {
            $('#rank0').circliful();
            $('#rank1').circliful();
            $('#rank2').circliful();
            $('#rank3').circliful();
            $('#rank4').circliful();
	    $('#rank5').circliful();
            $('#rank6').circliful();
            $('#rank7').circliful();
            $("#winRates").jChart(); 
        });
    </script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
