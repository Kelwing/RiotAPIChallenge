<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Riot API Challenge</title>
    <!--JQUERY PLUGIN!-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
                    <div class="define-chart-row" data-color="red" title="Pumpkin">13</div>
                    <div class="define-chart-row" data-color="gray" title="Pecan">24</div>
                    <div class="define-chart-row" data-color="green" title="Cherry">17</div>
                    <div class="define-chart-row" data-color="orange" title="Apple">26</div>
                    <div class="define-chart-row" data-color="black" title="Rhubarb">12</div>
                    <div class="define-chart-row" data-color="blue" title="Chocolate Cream">8</div>
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
    </table>
    
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
            $("#winRates").jChart(); 
        });
    </script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
