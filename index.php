<? 
$title = "Home";
include_once("./headerFooter/header.php");
?>

<div class="row">
    <div class="left-align col s12 m12 l8 offset-l2">
        <h3 class="titlePage">Home Page</h3>

        <!-- Information containers -->
        <div class="row center-align">
            <div class="col s12 m4">
                <div class="card green lighten-1">
                    <div class="card-content white-text">
                        <h2 class="infoCardTitle" id="lastHumidity">--%</h2>
                        <p>Humidity level</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card yellow darken-2">
                     <div class="card-content white-text">
                        <h2 class="infoCardTitle" id="infoPower">--</h2>
                        <p>Water supply statut</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card red lighten-1">
                    <div class="card-content white-text">
                        <h2 class="infoCardTitle" id="infoConsoToday">--L</h2>
                        <p>Consumption today</p>
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
            <div class="card-action right-align">
                <a href="./humidity.php"><i class="material-icons right">send</i> <span class="spanTitle">See more</span></a>
            </div>
        </div>
    </div>    
</div>

<?php include_once("./headerFooter/footer.php"); ?> 
<script src="./js/index.js"></script>
    </body>
</html>