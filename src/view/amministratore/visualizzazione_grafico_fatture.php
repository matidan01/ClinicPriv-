<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");
include_once("../../includes/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatturato Clinica Chirurgica</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h1>Grafico fatturato per mese nel <?php echo date("Y")?></h1>

    <div class="row mt-5">
        <div class="col">
            <div id="graficoFatturato" style="height: 300px;">
                <div id="grafico">

                </div>
            </div>
        </div>
    </div>

</div>

<script>
    
    document.addEventListener("DOMContentLoaded", function(){
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../../api/amministratore/visualizzazione_grafico_fatturato_logica.php");
        xhr.addEventListener("load", function() {
            if (xhr.status === 200) {
                const fatturato_mensile = JSON.parse(xhr.responseText);
                console.log(fatturato_mensile);
                const yArray = fatturato_mensile;
                const xArray = ["Gennaio","Febbraio","Marzo","Aprile","Maggio", "Giugno", "Luglio", "Agosto", 
                                "Settembre", "Ottobre", "Novembre", "Dicembre"];
                const data = [{
                    x: xArray,
                    y: yArray,
                    type: "bar",
                    orientation:"v",
                    marker: {color:"rgba(0,0,255)"}
                }];
                const layout = {title:"Fatturato per mese"};
                Plotly.newPlot('grafico', data, layout);
            } else {
                console.error("Errore durante la richiesta AJAX:", xhr.status);
            }
        });
        xhr.send();
    });
</script>

</body>
</html>