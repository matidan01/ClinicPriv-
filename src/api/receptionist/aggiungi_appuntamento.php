<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

// Gestisci l'inserimento di un nuovo appuntamento
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Memorizza i dati da inserire nella tabella 'prestazione'
    $paziente = explode(" ", $_POST['pazienti']);
    $idPaziente = intval($paziente[0]);

    $dataInizio = $_POST['dataInizio'];
    $dataFine = empty($_POST['dataFine']) ? null : $_POST['dataFine'];
    $ora = $_POST['ora'];

    $idPrestazione = get_last_id_appuntamento($con) + 1;

    $prestazione = explode(" ", $_POST['tipo']); 
    $codicePrestazione = $prestazione[0];

    $insert_appuntamento_query = "INSERT INTO `prestazione`(`idPaziente`, `idPrestazione`, `dataInizio`, `dataFine`, `codicePrestazione`, `ora`) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_insert_appuntamento = mysqli_prepare($con, $insert_appuntamento_query);
    mysqli_stmt_bind_param($stmt_insert_appuntamento, "iissss", $idPaziente, $idPrestazione, $dataInizio, $dataFine, $codicePrestazione, $ora);
    $run_appuntamento = mysqli_stmt_execute($stmt_insert_appuntamento);

    // Memorizza i dati da inserire nella tabella 'ospita'
    $sala = explode(" ", $_POST['sala']);
    $numeroSala = intval($sala[0]);

    $insert_sala_query = "INSERT INTO `ospita`(`numeroSala`, `idPrestazione`) VALUES (?, ?)";
    $stmt_insert_sala = mysqli_prepare($con, $insert_sala_query);
    mysqli_stmt_bind_param($stmt_insert_sala, "ii", $numeroSala, $idPrestazione);
    $run_sala = mysqli_stmt_execute($stmt_insert_sala);

    // Memorizza i dati da inserire nella tabella 'assistente' e 'responsabile' (array di dimensioni variabili) 
    $mediciResponsabili = array();
    $operatoriAssistenti = array();

    foreach ($_POST['medici'] as $key => $value) {
        $medico = explode(" ", $value);
        $medici[] = $medico[0];
    }

    foreach ($_POST['operatori'] as $key => $value) {
        $operatore = explode(" ", $value);
        $operatori[] = $operatore[0];
    }

    inserisci_responsabili($con, $idPrestazione, $medici);
    inserisci_assistenti($con, $idPrestazione, $operatori);
    inserisci_fattura($con, $idPrestazione);

    // Rimanda al profilo dell'appuntamento
    header("Location: ../../view/receptionist/profilo_appuntamento.php?idPrestazione=" . urlencode($idPrestazione));

}
