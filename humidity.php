<?php include_once("./headerFooter/header.php"); ?>

<div class="row">
    <div class="left-align col s12 m8 offset-m2">
        <h3 class="titlePage">Humidity Level</h3>
          <div class="card ">                   
            <div class="card-content green lighten-1">
                <div class="row">
                    <div class="col s5">
                        <span class="titleChart">Humidity evolution on the :</span>
                    </div>
                    <div class="col s4">
                        <input type="text" class="datepicker" placeholder="Default Today (click to change)">
                    </div>
                    <div class="col s3">
                        <button id="openDatePicker">Change Date</button>
                    </div>
                </div>
            </div>
            <div class="card-content">
                <div id="myfirstchart" style="height: 250px;"></div>
            </div>
                            <table class="centered">
        <thead>
          <tr>
              <th>Date</th>
              <th>Hour</th>
              <th>Humidity Level</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>02/06/2018</td>
            <td>14h</td>
            <td>60%</td>
          </tr>          
            <tr>
            <td>02/06/2018</td>
            <td>14h</td>
            <td>60%</td>
          </tr>          
            <tr>
            <td>02/06/2018</td>
            <td>14h</td>
            <td>60%</td>
          </tr>
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
        $('.datepicker').val(today.toDateString());
        
        var instance = M.Datepicker.getInstance($('.datepicker'));

        instance.setDate(new Date());
        
        $('#openDatePicker').click(function(){
            instance.open();
        })
         //$('.datepicker').set('select', new Date(2015, 3, 30))
  });
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