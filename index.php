<? 
include_once("./headerFooter/header.php") ;
include_once("./process/config.php");

$con = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

$selectsql = "SELECT type FROM tap_event ORDER BY tid DESC LIMIT 1";
$result = mysqli_query($con, $selectsql);
while($r = mysqli_fetch_assoc($result)){
    $rows[] = $r;
}
$con->close();
?>

<div class="row">
    <div class="left-align col s12 m8 offset-m2">
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
                        <h2 class="infoCardTitle"><?php if($rows[0]['type'] == 1) echo "ON"; else echo "OFF";?></h2>
                        <p>Water supply statut</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card red lighten-1">
                    <div class="card-content white-text">
                        <h2 class="infoCardTitle">340L</h2>
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
                <a href="./humidity.php"><i class="material-icons right">send</i> See more</a>
            </div>
        </div>
    </div>    
</div>

<?php include_once("./headerFooter/footer.php"); ?> 
    
<script>
    $(document).ready(function(){        
        $.ajax({
           type: "POST",
           url: "./process/getHumidity.php",
           success: function(data){
                var tabValue = $.parseJSON(data);
                $('#lastHumidity').html(tabValue[0]['level'] + "%");
                new Morris.Area({
                    // ID of the element in which to draw the chart.
                    element: 'myfirstchart',
                    // Chart data records -- each entry in this array corresponds to a point on
                    // the chart.
                    data: tabValue,
                    // The name of the data record attribute that contains x-values.
                    xkey: 'recordTime',
                    // A list of names of data record attributes that contain y-values.
                    ykeys: ['level'],
                    // Labels for the ykeys -- will be displayed when you hover over the
                    // chart.
                    labels: ['recordTime'],
                    behaveLikeLine:true,
                    lineColors: ['#64b5f6'],
                });
           }
        });
    }); 
</script>

    </body>
</html>