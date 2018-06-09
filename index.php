<? include_once("./headerFooter/header.php") ?>

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
                        <h2 class="infoCardTitle">On</h2>
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
            <div class="card-action right-align">
                <a href="./humidity.php"><i class="material-icons right">send</i> See more</a>
            </div>
        </div>
    </div>    
</div>

<?php include_once("./headerFooter/footer.php"); ?> 
    
<script> 
    new Morris.Area({
      // ID of the element in which to draw the chart.
        element: 'myfirstchart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
        { hour: '2012-02-24 15:00', value: 20 },
        { hour: '2012-02-24 16:00', value: 10 },
        { hour: '2012-02-24 17:00', value: 80 },
        { hour: '2012-02-24 18:00', value: 5 },
        { hour: '2012-02-24 19:00', value: 20 },
        { hour: '2012-02-24 20:00', value: 20 },
        { hour: '2012-02-24 21:00', value: 30 },
        { hour: '2012-02-24 22:00', value: 40 },
        { hour: '2012-02-24 23:00', value: 70 },
        { hour: '2012-02-25 00:00', value: 30 },
        { hour: '2012-02-25 01:00', value: 50 }
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
</script>

    </body>
</html>