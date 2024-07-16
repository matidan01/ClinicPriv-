<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

// Gestisce l'eliminazione di un appuntamento
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $query = "DELETE p FROM prestazione p
                JOIN fattura f ON p.idPrestazione = f.idPrestazione
                WHERE p.idPrestazione = ? 
                AND f.dataPagamento IS NULL ";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    if($con->affected_rows > 0){
        echo 'OK';
    }else{
        echo 'PROBLEM';
    }   
}