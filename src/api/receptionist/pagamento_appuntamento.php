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
        $query = "SELECT appuntamento.idPrestazione, listino.costo as costo
                    FROM appuntamento
                    INNER JOIN listino ON appuntamento.codicePrestazione = listino.codicePrestazione
                    LEFT JOIN fattura ON appuntamento.idPrestazione = fattura.idPrestazione
                    WHERE appuntamento.idPaziente = ?
                    AND fattura.idPrestazione IS NULL
                ";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                inserisci_fattura($con, $row['idPrestazione'], $numeroFattura, $row['costo']);
            }
        } 

        echo json_encode('OK');
    }

    
    
}