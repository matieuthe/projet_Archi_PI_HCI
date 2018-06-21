function changeTemp(){
    $('#tempHumidity').html($('#rangeHumidity').val());
}

function printGraph(){
    $('#myfirstchart').empty();
    $.ajax({
        type: "POST",
        url: "./process/calcConso.php",
        success: function(data){
            var valueConso = $.parseJSON(data);
            var monthConso = 0;
            valueConso.forEach(element => {
                monthConso += element.value;
            });
            $('#dayConsumption').html( valueConso[valueConso.length -1]['value']+ "L")
            $('#monthConsumption').html(Math.round(monthConso/1000) + "M³")
            new Morris.Area({
                // ID of the element in which to draw the chart.
                element: 'myfirstchart',
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
            document.getElementById("bodyTableau").innerHTML = "";
            valueConso.reverse();
            for(var i = 0; i < valueConso.length; i++){
                document.getElementById("bodyTableau").innerHTML += "<tr><td>" 
                    + valueConso[i]['recordTime'].substr(0,10) 
                    + "</td><td>" 
                    + valueConso[i]['value'] + " L"
                    + "</td></tr>";
            }
        }
    });
}

$(document).ready(function(){
    $('.modal').modal();

    $('.spanTitle').click(function(e){
        $('.modal').modal('open');
    });

    $('#submitFormUpdate').on('click', function(){
        $.ajax({
            type: "POST",
            data: $("#formParamTap").serialize(),
            url: "./process/updateParam.php",
            success: function(data){
                window.location.replace("./tap.php");
            }
        });
    });

    $.ajax({
        type: "POST",
        url: "./process/infoTap.php",
        success: function(data){
            var tabValue = $.parseJSON(data);
            $('#infoLevel').html(tabValue['level'] + "%");
            $('#infoPower').html(tabValue['statut']);
            $('#rangeHumidity').val(tabValue['level']);
            changeTemp();
        }
    });

    printGraph();
    window.onresize = printGraph;
});