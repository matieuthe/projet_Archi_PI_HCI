function changeTemp(){
    $('#tempHumidity').html($('#rangeHumidity').val());
}

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
            $('#rangeHumidity').val(tabValue['level']);
            changeTemp();
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