<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPaziente = $_GET['id'];
    $patologia = $_POST['patologia'];
    $idPatologia = explode('-', $patologia)[0];
    $nBadgeMedico = $_GET['nBadge'];
    $descrizione = $_POST['descrizione'];


    inserisci_diagnosi($con, $idPaziente, $idPatologia, $descrizione);


    header("Location: ../../view/medico/profilo_paziente.php?nBadge=$nBadgeMedico&idPaziente=$idPaziente");
}




