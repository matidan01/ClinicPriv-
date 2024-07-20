<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medico = $_GET['nBadge'];
    $nBadge = explode(' - ', $medico)[0];
    $data = $_POST['date'];
    $tipoTurno = $_POST['shift'];
    $tipoTurno = substr($tipoTurno, 0, 1);

    // Controlla se il turno esiste già
    if (turno_esistente($con, $nBadge, $data, $tipoTurno)) {
        echo "Errore: Il turno esiste già.";
    } else {
        // Chiama la funzione per inserire il turno del medico
        if (inserisci_turno_medico($con, $nBadge, $data, $tipoTurno)) {
            header("Location: ../../view/medico/gestisci_turni.php?nBadge=$nBadge");
        } else {
            echo "Errore nell'inserimento del turno.";
        }
    }
}

function turno_esistente($mysqli, $nBadge, $data, $tipoTurno) {
    $check_turno_query = "SELECT * FROM `turnomedico` WHERE `nBadge` = ? AND `data` = ? AND `tipoTurno` = ?";
    $check_turno_stmt = mysqli_prepare($mysqli, $check_turno_query);
    mysqli_stmt_bind_param($check_turno_stmt, 'sss', $nBadge, $data, $tipoTurno);
    mysqli_stmt_execute($check_turno_stmt);
    $result = mysqli_stmt_get_result($check_turno_stmt);
    return mysqli_num_rows($result) > 0;
}
?>
