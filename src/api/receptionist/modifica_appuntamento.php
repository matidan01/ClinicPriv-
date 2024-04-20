<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['dataInizio'])) {

    $id = intval($_POST['id']);
    $dataInizio = $_POST['dataInizio'];
    $dataFine = empty($_POST['dataFine']) ? null : $_POST['dataFine'];
    $ora = $_POST['ora'];
    $sala = explode(" ", $_POST['sala']);
    $numeroSala = intval($sala[0]);

    $update_data_ora = "UPDATE appuntamento
                        SET dataInizio = ?,
                            dataFine = ?,
                            ora = ?
                        WHERE idPrestazione = ?;
                    ";

    $stmt = mysqli_prepare($con, $update_data_ora);
    mysqli_stmt_bind_param($stmt, "sssi", $dataInizio, $dataFine, $ora, $id);
    mysqli_stmt_execute($stmt);

    $update_sala = "UPDATE ospita
                    SET numeroSala = ?
                    WHERE idPrestazione = ?;
                ";
    $stmt = mysqli_prepare($con, $update_sala);
    mysqli_stmt_bind_param($stmt, "ii", $numeroSala, $id);
    mysqli_stmt_execute($stmt);  

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = intval($_POST['id']);
    $medici_responsabili = get_responsabili_intervento($con, $id);
    $operatori_assistenti = get_assistenti_intervento($con, $id);

    foreach($medici_responsabili as $medico) {
        elimina_responsabile($con, $id, $medico);
    }

    foreach($operatori_assistenti as $operatore) {
        elimina_assistente($con, $id, $operatore);
    }

    $medici = [];
    foreach ($_POST['medici'] as $key => $value) {
        $medico = explode(" ", $value);
        $medici[] = $medico[0];
    }

    $operatori = [];
    foreach ($_POST['operatori'] as $key => $value) {
        $operatore = explode(" ", $value);
        $operatori[] = $operatore[0];
    }

    inserisci_responsabili($con, $id, $medici);
    inserisci_assistenti($con, $id, $operatori);

}

header("Location: ../../view/receptionist/profilo_appuntamento.php?idPrestazione=" . urlencode($id));