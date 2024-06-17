<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nBadge = $_POST['nBadge'];
    $data = $_POST['data'];
    $tipoTurno = $_POST['tipoTurno'];

    inserisci_turno($con, $nBadge, $data, $tipoTurno);


    header("Location: ../../view/receptionist/gestisci_turni.php?nBadge=$nBadge&idPaziente=$idPaziente");
}