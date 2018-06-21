<?php 
$title = "Humidity";
include_once("./headerFooter/header.php"); 
?>

<div class="row">
    <div class="left-align col s12 m12 l8 offset-l2">
        <h3 class="titlePage">Humidity Page<span class="spanTitle" id="modifyDate"><i class="material-icons icoSett">date_range</i>SEE ANOTHER DATE</span></h3>
        <div class="card ">                   
            <div class="card-content green lighten-1">
                <span class="titleChart" id="titleHumidity">Humidity evolution (last 30 records)</span>
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
<script src="./js/humidity.js"></script> 

</body>
</html>