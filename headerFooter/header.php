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
        <div class="navbar-fixed">
            <nav>
                <div id="navigation" class="nav-wrapper  green lighten-1">
                    <a href="./index.php" class="brand-logo"><i class="material-icons">format_paint</i>Smart Garden</a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                     <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="./index.php"><i class="material-icons left">home</i>Home</a></li>
                        <li><a href="./humidity.php"><i class="material-icons left">opacity</i>Humidity</a></li>
                        <li><a href="#"><i class="material-icons left"><img height="25px "src="./ressources/img/water_supply_ico.png"></i>Water supply</a></li>
                        <li><a href="#"><i class="material-icons left">power_settings_new</i>Logout</a></li>
                    </ul>
                </div>
            </nav>
        </div>
        <ul class="sidenav" id="mobile-demo">
            <li class="center-align"><h4>Smart Garden</h4></li>
            <li><div class="divider"></div></li>
            <li><a href="./index.php"><i class="material-icons left">home</i>Home</a></li>
            <li><a href="./humidity.php"><i class="material-icons left">opacity</i>Humidity</a></li>
            <li><a href="#"><i class="material-icons left"><img height="25px "src="./ressources/img/water_supply_ico.png"></i>Water supply</a></li>
            <li><a href=".#"><i class="material-icons left">power_settings_new</i>Logout</a></li>
        </ul>
               