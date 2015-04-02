<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Riot API Challenge</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="apichallenge.css" rel="stylesheet">
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js"></script>
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
                    <li><a href="../index.html">Recent Game Stats</a></li>
                    <li class="active"><a href="#">Nurf Game Statistics</a></li>
                </ul>
                <form class="navbar-form navbar-right" action="javascript:displayFilters();" method="get" role="search">
                    <div class="form-group">
                        <input type="text" id="summonerName" onKeyDown="if(event.keyCode==13) displayFilters();" class="form-control" placeholder="Find Stats" name="name">
                    </div>
                    <button type="submit"  class="btn btn-default">Submit</button>
                </form>
                <div id="currentGameButton" class="navbar-form navbar-right" ></div>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    <div class="header" style="margin-top:100px; text-align:center; font-size:40px">Most Popular NURF Champions</div>
    <table id="mostPopularChampions" class="table">
        <tr>
            <th>Sion</th>
            <th>Irelia</th>
            <th>Sample Summoner</th>
            <th>Hello world</th>
            <th>Test</th>
        </tr>
        <tr>
            <td>
                <div class="circle" >
                    <div class="innerCircle">57%
                    </div>
                </div>
            </td>
            <td>
                <div class="circle" >
                    <div class="innerCircle">57%
                    </div>
                </div>
            </td>
            <td>
                <div class="circle" >
                    <div class="innerCircle">57%
                    </div>
                </div>
            </td>
            <td>
                <div class="circle" >
                    <div class="innerCircle">57%
                    </div>
                </div>
            </td>
            <td>
                <div class="circle" >
                    <div class="innerCircle">57%
                    </div>
                </div>
            </td>
        </tr>
    </table>
    
    <!--<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js"></script>
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) 
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
