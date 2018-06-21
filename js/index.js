function printGraph(){
    $('#myfirstchart').empty();
    $.ajax({
        type: "POST",
        url: "./process/getHumidity.php",
        success: function(data){
            var tabValue = $.parseJSON(data);
            if(tabValue[0] != undefined){
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
                    labels: ['humidity in %'],
                    behaveLikeLine:true,
                    lineColors: ['#64b5f6'],
                });
            }else{
                $('#myfirstchart').html("<h4 class='center-align'>No records available</h4>");
            }
        }
    });
}

function printChartWater(){
    $('#chartWater').empty();
    $.ajax({
        type: "POST",
        url: "./process/calcConso.php",
        success: function(data){
            var valueConso = $.parseJSON(data);
            new Morris.Area({
                // ID of the element in which to draw the chart.
                element: 'chartWater',
                // Chart data records -- each entry in this array corresponds to a point on
                // the chart.
                data: valueConso,
                // The name of the data record attribute that contains x-values.
                xkey: 'recordTime',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['value'],
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['humidity'],
                behaveLikeLine:true,
                lineColors: ['#64b5f6'],
            });
        }
    });
}

$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: "./process/infoTap.php",
        success: function(data){
            var tabValue = $.parseJSON(data);
            $('#infoPower').html(tabValue['statut']);
            $('#infoConsoToday').html(tabValue['consoDay'] + "L");
        }
    });
    
    printGraph();
    printChartWater();
    window.onresize = function(){
        printGraph();
        printChartWater();
    }
}); 
