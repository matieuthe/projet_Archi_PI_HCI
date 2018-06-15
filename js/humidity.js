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
