<?php 
$title = "Water Supply";
include_once("./headerFooter/header.php"); 
?>

<div class="row">
    <div class="left-align col s12 m12 l8 offset-l2">
        <h3 class="titlePage">Water Supply <span class="spanTitle"><i class="material-icons icoSett">settings</i>CHANGE SETTINGS</span></h3>        
        <!-- Information containers -->
        <div class="row center-align">
        <div class="col s6 m6 l3">
                <div class="card light-blue lighten-2">
                    <div class="card-content white-text">
                        <h2 class="infoCardTitle" id="infoLevel">--%</h2>
                        <p>Declenchment level</p>
                    </div>
                </div>
            </div>
            <div class="col s6 m6 l3">
                <div class="card yellow darken-2">
                    <div class="card-content white-text">
                        <h2 class="infoCardTitle" id="infoPower">--</h2>
                        <p>Water supply statut</p>
                    </div>
                </div>
            </div>
            <div class="col s6 m6 l3">
                <div class="card red lighten-1">
                    <div class="card-content white-text">
                        <h2 class="infoCardTitle" id="dayConsumption">--L</h2>
                        <p>Consumption today</p>
                    </div>
                </div>
            </div>
            <div class="col s6 m6 l3">
                <div class="card green lighten-1">
                    <div class="card-content white-text">
                        <h2 class="infoCardTitle" id="monthConsumption">--M³</h2>
                        <p>Monthly consumption</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Last 24hours graphiques -->
        <div class="card ">                   
            <div class="card-content green lighten-1">
                <span class="titleChart">Consumption water evolution last 30 days</span>
            </div>
            <div class="divider"></div>
            <div class="card-content">
                <div id="myfirstchart" style="height: 250px;"></div>
            </div>
        </div><
    </div>    
</div>

<!-- 
    declenchement level
    manual declenchement
-->

<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Settings</h4>
        <form action="#" id="formParamTap">
            <div class="row">
                <div class="col s6 center">
                    <p>Humidity declenchment level : <span id="tempHumidity" style="opacity:0.5;padding-left:10px">--</span></p>
                </div>
                <div class="col s6">
                    <p class="range-field">
                        <input type="range" name="rangeHumidity" min="0" max="100" id="rangeHumidity" onchange="changeTemp()">
                    </p>
                </div>
            </div>            
        </form>
    </div>
    <div class="modal-footer">        
        <a href="#" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
        <a href="#" class="modal-close waves-effect waves-green btn-flat" id="submitFormUpdate">Update</a>
    </div>
</div>

<?php include_once("./headerFooter/footer.php"); ?>
<script src="./js/tap.js"></script>
</body>
</html>