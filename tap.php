<?php 
include_once("./headerFooter/header.php"); 
include_once("./process/config.php");

$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$selectsql = "SELECT value FROM parameters WHERE name='minHumidity'";
$result = mysqli_query($con, $selectsql);
$rows = array();
while($r = mysqli_fetch_assoc($result)){
    $rows[] = $r;
}

$selectsql = "SELECT type FROM tap_event ORDER BY tid DESC LIMIT 1";
$result = mysqli_query($con, $selectsql);
while($r = mysqli_fetch_assoc($result)){
    $rows[] = $r;
}

$con->close();

?>

<div class="row">
    <div class="left-align col s12 m8 offset-m2">
        <h3 class="titlePage">Water Supply <span class="spanTitle"><i class="material-icons icoSett">settings</i>CHANGE SETTINGS</span></h3>        
        <!-- Information containers -->
        <div class="row center-align">
            <div class="col s12 m6 l3">
                <div class="card light-blue lighten-2">
                    <div class="card-content white-text">
                        <h2 class="infoCardTitle" id="infoLevel">--%</h2>
                        <p>Declenchment level</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card yellow darken-2">
                    <div class="card-content white-text">
                        <h2 class="infoCardTitle" id="infoPower">--</h2>
                        <p>Water supply statut</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card red lighten-1">
                    <div class="card-content white-text">
                        <h2 class="infoCardTitle">340L</h2>
                        <p>Consumption today</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <div class="card green lighten-1">
                    <div class="card-content white-text">
                        <h2 class="infoCardTitle">50M²</h2>
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
        </div>
    </div>    
</div>

<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>



<?php include_once("./headerFooter/footer.php"); ?>

<script>

    $(document).ready(function(){
        $('.modal').modal();

        $('.spanTitle').click(function(e){
            $('.modal').modal('open');
        });

        $.ajax({
            type: "POST",
            url: "./process/infoTap.php",
            success: function(data){
                var tabValue = $.parseJSON(data);
                $('#infoLevel').html(tabValue['level'] + "%");
                $('#infoPower').html(tabValue['statut']);
            }
        });

        new Morris.Area({
            // ID of the element in which to draw the chart.
            element: 'myfirstchart',
            // Chart data records -- each entry in this array corresponds to a point on
            // the chart.
            data: [
                { hour: '2012-02-20', value: 20 },
                { hour: '2012-02-21', value: 10 },
                { hour: '2012-02-22', value: 80 },
                { hour: '2012-02-23', value: 5 },
                { hour: '2012-02-24', value: 20 },
                { hour: '2012-02-25', value: 50 }
            ],
            // The name of the data record attribute that contains x-values.
            xkey: 'hour',
            // A list of names of data record attributes that contain y-values.
            ykeys: ['value'],
            // Labels for the ykeys -- will be displayed when you hover over the
            // chart.
            labels: ['humidity'],
            behaveLikeLine:true,
            lineColors: ['#64b5f6'],
        });
    });
</script>



</body>
</html>