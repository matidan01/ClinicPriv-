<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $numeroFattura = get_last_numero_fattura($con) + 1;

    if ($_POST['risorsa'] == 'appuntamento') {    
        $costo = $_POST['costo'];    
        if(inserisci_fattura($con, $id, $numeroFattura, $costo)) {
            echo json_encode('OK');
        } else {
            echo json_encode('PROBLEM');
        }
    } else if ($_POST['risorsa'] == 'profilo') {  
        //DA MODIFICARE, DEVE PRENDERE GLI ELEMENTI SELEZIONATI DAL CHECKBOX E AGGIUNGERE LA FATTURA

        inserisci_fattura($mysqli, $row['idPrestazione'], $numeroFattura, $row['costo']);

        echo json_encode('OK');
    }

    
    
}