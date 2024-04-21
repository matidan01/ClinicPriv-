<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {

    $idPrestazione = intval($_POST['id']);

    $numeroFattura = get_last_numero_fattura($con) + 1;

    $costo = get_costo($con, $idPrestazione);

    $insert_fattura_query = "INSERT INTO `fattura`(`idPrestazione`, `numeroFattura`, `totale`, `data`, `ora`) VALUES (?, ?, ?, CURDATE(), CURTIME())";
    $insert_fattura_stmt = mysqli_prepare($con, $insert_fattura_query);
    
    mysqli_stmt_bind_param($insert_fattura_stmt, 'iis', $idPrestazione, $numeroFattura, $costo);
    
    $result = mysqli_stmt_execute($insert_fattura_stmt);

    if($result) {
        echo json_encode('OK');
    } else {
        echo json_encode('PROBLEM');
    }
    
}