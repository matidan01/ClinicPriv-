<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idPaziente = $_POST['id'];
    $patologia = $_POST['patologia'];
    $nBadgeMedico = $_POST['nBadge'];
    $descrizione = $_POST['descrizione'];

    inserisci_diagnosi($con, $idPaziente, $nBadgeMedico, $idPatologia, $descrizione);


    header("Location: ../../view/receptionist/profilo_paziente.php?nBadge=$nBadge&idPaziente=$idPaziente");
}




