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
</head>
<body>

<div class="container mt-5">
    <h1>Fatturato Clinica Chirurgica</h1>

    <div class="row mt-3">
        <div class="col">
            <label for="dataInizio">Data Inizio:</label>
            <input type="date" id="dataInizio" class="form-control">
        </div>
        <div class="col">
            <label for="dataFine">Data Fine:</label>
            <input type="date" id="dataFine" class="form-control">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <button id="btnFatturato" class="btn btn-primary">Calcola fatturato</button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <h2>Fatturato:<span id="fatturato"></span></h2>
            <h2>Fatturato medio giornaliero:<span id="fatturato_medio"></span></h2>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <button id="btnFatturatoMedico" class="btn btn-primary">Visualizza Fatturato per Medico</button>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Badge</th>
                <th scope="col">Contributo</th>
            </tr>
        </thead>
        <tbody id="medici">

        </tbody>
    </table>

    <div class="row mt-5">
        <div class="col">
            <h2>Trend di Fatturato nel Tempo</h2>
            <div id="graficoFatturato" style="height: 300px;">
                <canvas id="grafico">

                </canvas>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dataI = document.getElementById("dataInizio");
        const dataF = document.getElementById("dataFine");
        let dataInizio, dataFine;
        dataI.addEventListener("change", function(){
            dataInizio = dataI.value;
        });
        dataF.addEventListener("change", function(){
            dataFine = dataF.value;
        });
        const fatturatoBtn = document.getElementById("btnFatturato");
        fatturatoBtn.addEventListener("click", function(){
            const formData = new FormData();
            formData.append('dataInizio', dataInizio);
            formData.append('dataFine', dataFine);
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../../api/amministratore/visualizzazione_fatturato_logica.php");
            xhr.send(formData);
            xhr.addEventListener("load", function() {
                if (xhr.status === 200) {
                    const fatturato = JSON.parse(xhr.responseText);
                    document.getElementById("fatturato").textContent = fatturato[0] + "$";
                    document.getElementById("fatturato_medio").textContent = fatturato[1] + "$";
                } else {
                    console.error("Errore durante la richiesta AJAX:", xhr.status);
                }
            });
            const formForGraph = new FormData();
            formForGraph.append('dataInizio', dataInizio);
            formForGraph.append('dataFine', dataFine);
            const xhrf = new XMLHttpRequest();
            xhrf.open("POST", "../../api/amministratore/visualizzazione_grafico_fatturato.php");
            xhrf.send(formData);
            xhrf.addEventListener("load", function() {
                if (xhrf.readyState === XMLHttpRequest.DONE) {
                    if (xhrf.status === 200) {
                        const graficoData = JSON.parse(xhrf.responseText);
                        console.log(graficoData);
                        var ctx = document.getElementById('grafico').getContext('2d');
                        const mesi = Array.from(new Set(graficoData.map(item => item.month)));
                        const operazioni = Array.from(new Set(graficoData.map(item => item.nome)));
                        const guadagni = [];
                        for (let i = 0; i < mesi.length; i++) {
                            guadagni[i] = new Array(operazioni.length).fill(0);
                        }
                        graficoData.forEach(item => {
                            const row = mesi.indexOf(item.month);
                            const col = operazioni.indexOf(item.nome);
                            guadagni[row][col] = parseInt(item.totale);
                        });

                        const datasets = [];
                        for (let i = 0; i < operazioni.length; i++) {
                            datasets.push({
                                label: operazioni[i],
                                data: guadagni.map(row => row[i]),
                                fill: false,
                                borderColor: "(100,100,100,0.1)", 
                                tension: 0.1
                            });
                        }

                        const config = {
                            type: 'line',
                            data: {
                                labels: mesi,
                                datasets: datasets
                            },
                            options: {
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Mese'
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Guadagno'
                                        }
                                    }
                                }
                            }
                        };
                        new Chart(ctx, config);

                    } else {
                        console.error("Errore durante la richiesta AJAX:", xhr.status);
                    }
                }
            });
        });
        var btnFatturatoMedico =document.getElementById("btnFatturatoMedico");
        btnFatturatoMedico.addEventListener("click", function(){
            const formData = new FormData();
            formData.append('dataInizio', dataInizio);
            formData.append('dataFine', dataFine);
            formData.append('medici', 1); //è un modo per dire che l'axios post è stato mandato per richiedere informazioni sui medici
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../../api/amministratore/visualizzazione_fatturato_logica.php");
            xhr.send(formData);
            xhr.addEventListener("load", function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const mediciArray = JSON.parse(xhr.responseText);
                        const mediciTabella = document.getElementById("medici");
                        mediciTabella.innerHTML=` `; //mi serve per cancellare le eventuali tabelle precedentemente caricate. 
                        mediciArray.forEach(m => {
                            mediciTabella.innerHTML +=`<td>${m['nome']}</td><td>${m['cognome']}</td><td>${m['nBadge']}</td><td>${m['SUM(f.totale)']}</td>`;
                        });
                    } else {
                        console.error("Errore durante la richiesta AJAX:", xhr.status);
                    }
                }
            });
        })
    });
</script>

</body>
</html>