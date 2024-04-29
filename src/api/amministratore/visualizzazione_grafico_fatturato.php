<?php
include_once("../../includes/connection.php");
include_once("../../includes/functions.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $datiFatturato = divisione_fatturato_per_mese_e_prestazione($_POST['dataInizio'], $_POST['dataFine'], $con);
    $datiFatturatoJSON = json_encode($datiFatturato);
    header('Content-Type: application/json');
    echo $datiFatturatoJSON;  
}
?>