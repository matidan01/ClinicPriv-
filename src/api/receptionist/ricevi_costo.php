<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    if ($_POST['risorsa'] == 'appuntamento') {

        echo get_costo($con, $id);

    } else if($_POST['risorsa'] == 'profilo') {

        $query = "SELECT SUM(listino.costo) AS totale_prestazioni
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
        
        echo json_encode(mysqli_fetch_assoc($result)['totale_prestazioni']);

    }
}