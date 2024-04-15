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
    
    $insert = "insert into paziente(idPaziente, nome, cognome, CF, email, dataNascita, luogoNascita, recapitoTelefonico, note)
    values('$idPaziente','$nome','$cognome','$cf','$email','$dataNascita','$luogoNascita','$recapitoTelefonico','$note')";
    $run_insert_paziente = mysqli_query($con,$insert);

    if($run_insert_paziente) {
        $tipo = 'P';
        $citta = $_POST['citta'];
        $via = $_POST['via'];
        $numeroCivico = $_POST['numeroCivico'];
        $cap = $_POST['cap'];
        $provincia = $_POST['provincia'];
        $nazione = $_POST['nazione'];

        $insert = "insert into indirizzo(id, tipo, città, via, numeroCivico, CAP, provincia, nazione)
        values('$idPaziente','$tipo','$citta','$via','$numeroCivico','$cap','$provincia','$nazione')";
        $run_insert_indirizzo = mysqli_query($con,$insert);
        if($run_insert_indirizzo) {
            header("Location: ../../view/receptionist/profilo_paziente.php?idPaziente=" . urlencode($idPaziente));
        } else {
            elimina_dati_paziente($con, $idPaziente);
        }
    }
    
}