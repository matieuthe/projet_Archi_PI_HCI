<?php include_once("./headerFooter/header.php"); ?>

<div class="row">
    <div class="left-align col s12 m8 offset-m2">
        <h3 class="titlePage">Humidity Page</h3>
          <div class="card ">                   
            <div class="card-content green lighten-1">
                    <span class="titleChart">Humidity evolution last 24h hours</span>
            </div>
            <div class="row">
                <div class='input-field col s6 offset-s1'>
                    <i class='material-icons prefix icoDatePicker'>date_range</i>
                    <input type='text' class='datepicker' name='date' placeholder='Click to change date'>
                </div>  
            </div>              
            <div class="card-content">
                <div id="myfirstchart" style="height: 250px;"></div>
            </div>
              
            <table class="centered" id="preciseValue">
            <thead>
                <tr>
                  <th>Date (Year-Month-Day)</th>
                  <th>Hour</th>
                  <th>Humidity Level in %</th>
                </tr>
            </thead>

            <tbody class="centered">
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
<?php include_once("./headerFooter/footer.php"); ?>

<script> 
    $(document).ready(function(){
        $('.datepicker').datepicker({
            defaultDate:new Date(),
            setDefaultDate:true,
        });
        
        var today = new Date()
        //$('.datepicker').val(today.toDateString());
        
        var instance = M.Datepicker.getInstance($('.datepicker'));

        instance.setDate(new Date());
        
        $('.icoDatePicker').click(function(){
            instance.open();
        })
        $.ajax({
           type: "POST",
           url: "./process/getHumidity.php",
           success: function(data){
                var tabValue = $.parseJSON(data);
                $('#lastHumidity').html(tabValue[tabValue.length-1]['level'] + "%");
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
                    labels: ['humidity in %'],
                    behaveLikeLine:true,
                    lineColors: ['#64b5f6'],
                });
               var table = document.getElementById('preciseValue');
               for(var i = 0; i < tabValue.length;i++){
                    var row = table.insertRow(1);
                   var cell1 = row.insertCell(0);
                   var cell2 = row.insertCell(1);
                   var cell3 = row.insertCell(2);
                   cell1.innerHTML = tabValue[i]['recordTime'].substr(0,10);
                   cell2.innerHTML = tabValue[i]['recordTime'].substr(10,6);
                   cell3.innerHTML = tabValue[i]['level'];
               }
               //Delete the default line when there is no data
               document.getElementById('preciseValue').deleteRow(25);
           }
        });
    });
</script>

</body>
</html>