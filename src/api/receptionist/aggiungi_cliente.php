<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

// Gestisce l'inserimento o la modifica di un paziente
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Memorizza i dati anagrafici del paziente da inserire/modificare
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $dataNascita = $_POST['data_nascita'];
    $luogoNascita = $_POST['luogo_nascita'];
    $recapitoTelefonico = $_POST['telefono'];
    $cf = isset($_POST['cf']) ? $_POST['cf'] : null;
    $note = isset($_POST['note']) ? $_POST['note'] : null;

    // Se viene specifica 'modifica' allora farà un update altrimenti un inserimento
    if(isset($_POST['modifica'])) {
        $idPaziente = $_POST['modifica'];
        $update_paziente_query = "UPDATE paziente SET nome = ?, cognome = ?, CF = ?, email = ?, dataNascita = ?, luogoNascita = ?, recapitoTelefonico = ?, note = ? WHERE idPaziente = ?";
        $stmt_update_paziente = mysqli_prepare($con, $update_paziente_query);
        mysqli_stmt_bind_param($stmt_update_paziente, "ssssssisi", $nome, $cognome, $cf, $email, $dataNascita, $luogoNascita, $recapitoTelefonico, $note, $idPaziente);
        $run_paziente = mysqli_stmt_execute($stmt_update_paziente);
    } else {
        $idPaziente = get_last_id_paziente($con) + 1;
        $insert_paziente_query = "INSERT INTO paziente(idPaziente, nome, cognome, CF, email, dataNascita, luogoNascita, recapitoTelefonico, note) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_insert_paziente = mysqli_prepare($con, $insert_paziente_query);
        mysqli_stmt_bind_param($stmt_insert_paziente, "issssssis", $idPaziente, $nome, $cognome, $cf, $email, $dataNascita, $luogoNascita, $recapitoTelefonico, $note);
        $run_paziente = mysqli_stmt_execute($stmt_insert_paziente);
    }

    // Se l'inserimento/modifica è andata a buon fine allora memorizza i dati per inserire/modificare indirizzo
    if($run_paziente) {
        $tipo = 'P';
        $citta = $_POST['citta'];
        $via = $_POST['via'];
        $numeroCivico = $_POST['numeroCivico'];
        $cap = $_POST['cap'];
        $provincia = $_POST['provincia'];
        $nazione = $_POST['nazione'];

        if(isset($_POST['modifica'])) {
            $update_indirizzo_query = "UPDATE indirizzo SET città = ?, via = ?, numeroCivico = ?, CAP = ?, provincia = ?, nazione = ? WHERE id = ? AND tipo = ?";                
            $stmt_update_indirizzo = mysqli_prepare($con, $update_indirizzo_query);
            mysqli_stmt_bind_param($stmt_update_indirizzo, "ssiissis", $citta, $via, $numeroCivico, $cap, $provincia, $nazione, $idPaziente, $tipo);
            $run_indirizzo = mysqli_stmt_execute($stmt_update_indirizzo);
        } else {
            $insert_indirizzo_query = "INSERT INTO indirizzo(id, tipo, città, via, numeroCivico, CAP, provincia, nazione) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt_insert_indirizzo = mysqli_prepare($con, $insert_indirizzo_query);
            mysqli_stmt_bind_param($stmt_insert_indirizzo, "isssiiss", $idPaziente, $tipo, $citta, $via, $numeroCivico, $cap, $provincia, $nazione);
            $run_indirizzo = mysqli_stmt_execute($stmt_insert_indirizzo);
        }

        header("Location: ../../view/receptionist/profilo_paziente.php?idPaziente=" . urlencode($idPaziente));
    }
}
