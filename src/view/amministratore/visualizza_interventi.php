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
    <title>Interventi Clinica Chirurgica</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container mt-5">
    <h1>Visualizzazione interventi</h1>

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
            <button id="btnInterventi" class="btn btn-primary">Numero di interventi e prestazioni nel periodo scelto:</button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <h2>Interventi totali:<span id="interventi"></span></h2>
            <h2>Visite totali:<span id="visite"></span></h2>
            <h2>Ricoveri totali:<span id="ricoveri"></span></h2>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <button id="btnInterventiChirurgo" class="btn btn-primary">Numero di interventi per chirurgo:</button>
        </div><br><br>
    </div>
    <div class="row mt-3">
        <h2>Media interventi per chirurgo:<span id="media"></span></h2>
    </div>
        <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Cognome</th>
                <th scope="col">Badge</th>
                <th scope="col">Interventi</th>
            </tr>
        </thead>
        <tbody id="chirurghi">

        </tbody>
    </table>
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
        const interventiBtn = document.getElementById("btnInterventi");
        interventiBtn.addEventListener("click", function(){
            const formData = new FormData();
            formData.append('dataInizio', dataInizio);
            formData.append('dataFine', dataFine);
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../../api/amministratore/visualizzazione_interventi_logica.php");
            xhr.send(formData);
            xhr.addEventListener("load", function() {
                if (xhr.status === 200) {
                    const interventiInfo = JSON.parse(xhr.responseText);
                    document.getElementById("interventi").textContent = interventiInfo[0]["COUNT(idPrestazione)"];
                    document.getElementById("visite").textContent = interventiInfo[0]["COUNT(idPrestazione)"];
                    document.getElementById("ricoveri").textContent = interventiInfo[0]["COUNT(idPrestazione)"];
                } else {
                    console.error("Errore durante la richiesta AJAX:", xhr.status);
                }
            });
        });
        var btnInterventiChirurgo = document.getElementById("btnInterventiChirurgo");
        btnInterventiChirurgo.addEventListener("click", function(){
            const formData = new FormData();
            formData.append('dataInizio', dataInizio);
            formData.append('dataFine', dataFine);
            formData.append('chirurghi', 1); //è un modo per dire che l'axios post è stato mandato per richiedere informazioni sui chirurghi
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "../../api/amministratore/visualizzazione_interventi_logica.php");
            xhr.send(formData);
            xhr.addEventListener("load", function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        const chirurghiArray = JSON.parse(xhr.responseText);
                        const chirurghiTabella = document.getElementById("chirurghi");
                        chirurghiTabella.innerHTML=` `; //serve per cancellare le eventuali tabelle precedentemente caricate.
                        nChirurghi = 0;
                        nInterventi = 0; 
                        chirurghiArray.forEach(c => {
                            nChirurghi = nChirurghi+1;
                            nInterventi = nInterventi + c['nOperazioni'];
                            chirurghiTabella.innerHTML +=`<td>${c['nome']}</td><td>${c['cognome']}</td><td>${c['nBadge']}</td><td>${c['nOperazioni']}</td>`;
                        });
                        document.getElementById("media").innerHTML = parseFloat((nInterventi / nChirurghi).toPrecision(3)); //arrotondo alla seconda cifra decimale. 
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