<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $dataNascita = $_POST['data_nascita'];
    $luogoNascita = $_POST['luogo_nascita'];
    $recapitoTelefonico = $_POST['telefono'];
    $cf = null;
    if (isset($_POST['cf'])) {
        $cf = $_POST['cf'];
    }
    $note = null;
    if (isset($_POST['note'])) {
        $note = $_POST['note'];
    }

    $idPaziente = get_last_id_paziente($con) + 1;

    error_log("idPaziente = " . $idPaziente . PHP_EOL, 3, "file.log");
    
    $insert = "insert into paziente(idPaziente, nome, cognome, CF, email, dataNascita, luogoNascita, recapitoTelefonico, note)
    values('$idPaziente','$nome','$cognome','$cf','$email','$dataNascita','$luogoNascita','$recapitoTelefonico','$note')";
    $run_insert = mysqli_query($con,$insert);
    
}