<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    $medici_responsabili = get_responsabili_intervento($con, $id);
    $operatori_assistenti = get_assistenti_intervento($con, $id);

    foreach($medici_responsabili as $medico) {
        elimina_responsabile($con, $id, $medico);
    }

    foreach($operatori_assistenti as $operatore) {
        elimina_assistente($con, $id, $operatore);
    }

    $query = "DELETE FROM ospita
            WHERE idPrestazione = ?
            ";  
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);  

    $query = "DELETE FROM appuntamento
            WHERE idPrestazione = ?
            ";  
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);  
   
}