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
                    element: 'myfirstchart',
                    data: tabValue,
                    xkey: 'recordTime',
                    ykeys: ['level'],
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
            if(valueConso[1] != undefined){
                new Morris.Area({
                    element: 'chartWater',
                    data: valueConso,
                    xkey: 'recordTime',
                    ykeys: ['value'],
                    labels: ['humidity'],
                    behaveLikeLine:true,
                    lineColors: ['#64b5f6'],
                });
            }else{
                $('#chartWater').html("<h4 class='center-align'>No record available this month</h4>");
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
