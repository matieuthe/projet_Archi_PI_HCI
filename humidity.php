<?php 
$title = "Humidity";
include_once("./headerFooter/header.php"); 
?>

<div class="row">
    <div class="left-align col s12 m8 offset-m2">
        <h3 class="titlePage">Humidity Page<span class="spanTitle" id="modifyDate"><i class="material-icons icoSett">date_range</i>SEE ANOTHER DATE</span></h3>
        <div class="card ">                   
            <div class="card-content green lighten-1">
                <span class="titleChart" id="titleHumidity">Humidity evolution last 24h hours</span>
            </div>
            <div class="card-content">
                <div id="myfirstchart" style="height: 250px;"></div>
            </div>
            <table class="centered highlight" id="preciseValue">
                <thead>
                    <tr>
                        <th>Date (Year-Month-Day)</th>
                        <th>Hour</th>
                        <th>Humidity Level in %</th>
                    </tr>
                </thead>

                <tbody id="bodyTableau">
                    <tr>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <!-- The result will be print -->
                </tbody>
            </table>

        </div>

    </div>
</div>

<form action="#" method="get" id="formDate">
    <input type='text' class='datepicker' id="datePicker" name='date' value="" onchange="closeDatePicker()" hidden>
</form>


<?php include_once("./headerFooter/footer.php"); ?>

<script>
    var bar;
    function closeDatePicker(){
        $('#myfirstchart').empty();
        printGraph();
    } 

    function printGraph(){
        $.ajax({
            type: "GET",
            url: "./process/getHumidity.php",
            data: $("#formDate").serialize(),
            success: function(data){
                var tabValue = $.parseJSON(data);
                if(tabValue[0] != undefined){
                    bar = new Morris.Area({
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
                        labels: ['humidity in %'],
                        behaveLikeLine:true,
                        lineColors: ['#64b5f6'],
                    });
                    document.getElementById("bodyTableau").innerHTML = "";
                    for(var i = 0; i < tabValue.length; i++){
                        document.getElementById("bodyTableau").innerHTML += "<tr><td>" 
                            + tabValue[i]['recordTime'].substr(0,10) 
                            + "</td><td>" 
                            + tabValue[i]['recordTime'].substr(10,6) 
                            + "</td><td>" 
                            + tabValue[i]['level'] 
                            + "</td></tr>";
                    }

                }else{
                    
                    $('#myfirstchart').html("<h4 class='center-align'>No record available this day</h4>");
                    document.getElementById("bodyTableau").innerHTML = "<tr><td>--</td><td>--</td><td>--</td></tr>" 
                }
                    if($('#datePicker').val() == " "){
                        document.getElementById("titleHumidity").innerHTML = "Humidity evolution on " + $('#datePicker').val();
                        $('#datePicker').val("");
                    } 
            }
        });
    }

    $(document).ready(function(){
        $.ajax({
            type: "POST",
            url: "./process/infoTap.php",
            success: function(data){
                var tabValue = $.parseJSON(data);
                
                var yearMin = tabValue['dateMin'].substring(0,4);
                var monthMin = tabValue['dateMin'].substring(5,7);
                var dayMin = tabValue['dateMin'].substring(8,10);
                
                var yearMax = tabValue['dateMax'].substring(0,4);
                var monthMax = tabValue['dateMax'].substring(5,7);
                var dayMax = tabValue['dateMax'].substring(8,10);
                
                var picker = $('.datepicker').datepicker({
                    format:'yyyy-mm-dd',
                    minDate: new Date(yearMin, monthMin - 1, dayMin),
                    maxDate: new Date(yearMax, monthMax - 1, dayMax),
                });
                
                var instance = M.Datepicker.getInstance($('.datepicker'));
                $('#modifyDate').click(function(){
                    instance.open();
                });
            }
        });

        printGraph();
        window.onresize = closeDatePicker;
    });
</script>

</body>
</html>