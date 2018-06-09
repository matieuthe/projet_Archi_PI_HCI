<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8" />
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
    <link rel="stylesheet" href="./js/morris.js-0.5.1/morris.css">

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Home Page</title>
    </head>
    <body>
        <nav>
            <div id="navigation" class="nav-wrapper  green lighten-1">
                <a href="./index.php" class="brand-logo"><i class="material-icons">format_paint</i>Smart Garden</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                 <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="./index.php"><i class="material-icons left">home</i>Home</a></li>
                    <li><a href="./process/logout.php"><i class="material-icons left">opacity</i>Humidity</a></li>
                    <li><a href="./process/logout.php"><i class="material-icons left"><img height="25px "src="./ressources/img/water_supply_ico.png"></i>Water supply</a></li>
                    <li><a href="./process/logout.php"><i class="material-icons left">power_settings_new</i>Logout</a></li>
                </ul>
            </div>
        </nav>
        
        <ul class="sidenav" id="mobile-demo">
            <li class="center-align"><h4>Smart Garden</h4></li>
            <li><div class="divider"></div></li>
            <li><a href="./process/logout.php"><i class="material-icons left">home</i>Home</a></li>
            <li><a href="./process/logout.php"><i class="material-icons left">opacity</i>Humidity</a></li>
            <li><a href="./process/logout.php"><i class="material-icons left"><img height="25px "src="./ressources/img/water_supply_ico.png"></i>Water supply</a></li>
            <li><a href="./process/logout.php"><i class="material-icons left">power_settings_new</i>Logout</a></li>
        </ul>
                
        <!---
        Dernier relever d'humiditer
        Statue de l'alimentation en eau
        Consommation d'eau depuis le début de la journée
        
        En dessous : Evolution de la consommation d'eau dans les dernières 24h dans un graphiques
<i class="material-icons">show_chart</i>
        -->
        <div class="row">
            <div class="left-align col s12 m8 offset-m2">
            <h3 class="titlePage">Home Page</h3>
                
                <!-- Information containers -->
                <div class="row center-align">
                    <div class="col s4">
                        <div class="card green lighten-1">
                            <div class="card-content white-text">
                                <h2 class="infoCardTitle">60%</h2>
                                <p>Humidity level</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s4 ">
                        <div class="card yellow darken-2">
                             <div class="card-content white-text">
                                <h2 class="infoCardTitle">ON</h2>
                                <p>Water supply statut</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s4 ">
                        <div class="card red lighten-1">
                            <div class="card-content white-text">
                                <h2 class="infoCardTitle">340L</h2>
                                <p>Water consumption today</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Last 24hours graphiques -->
                <div class="card ">                   
                    <div class="card-content green lighten-1">
                        <span class="titleChart">Humididty evolution last 24 hours</span>
                    </div>
                    <div class="divider"></div>
                    <div class="card-content">
                        <div id="myfirstchart" style="height: 250px;"></div>
                    </div>
                </div>
        </div>    
        </div>
    </body>
    <script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="./js/materialize.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="./js/morris.js-0.5.1/morris.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            //var instances = M.Sidenav.init(elems, options);
        });

        // Or with jQuery

        $(document).ready(function(){
            $('.sidenav').sidenav();
        });  
        
        new Morris.Line({
          // ID of the element in which to draw the chart.
          element: 'myfirstchart',
          // Chart data records -- each entry in this array corresponds to a point on
          // the chart.
          data: [
            { hour: '15', value: 20 },
            { hour: '16', value: 10 },
            { hour: '17', value: 80 },
            { hour: '18', value: 5 },
            { hour: '19', value: 20 }
          ],
          // The name of the data record attribute that contains x-values.
          xkey: 'hour',
          // A list of names of data record attributes that contain y-values.
          ykeys: ['value'],
          // Labels for the ykeys -- will be displayed when you hover over the
          // chart.
          labels: ['humidity']
        });
    </script>
</html>