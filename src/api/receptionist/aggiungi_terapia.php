<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Memorizza i dati singoli
    $idPaziente = $_POST['id'];
    $dataScadenza = $_POST['dataScadenza'];
    $idMedico = $_POST['idMedico'];
    if($idMedico == '') {
        $idMedico = NULL;
    }

    // Memorizza i dati di farmaci e relative descrizioni in array 
    $farmaci = array();
    $descrizioni = array();

    foreach ($_POST['nomeFarmaco'] as $key => $value) {
        $farmaci[] = $value;
        $descrizioni[] = $_POST['descrizione'][$key];
    }

    // Effettua l'inserimento
    if(count($farmaci) > 0) {
        $idTerapia = get_last_id_terapia($con) + 1;
        $insert_terapia_query = "INSERT INTO `terapia`(`idTerapia`,`idPaziente`, `dataScadenza`, `idMedico`) VALUES (?, ?, ?, ?)";
        $insert_terapia_stmt = mysqli_prepare($con, $insert_terapia_query);
        mysqli_stmt_bind_param($insert_terapia_stmt, 'iiss', $idTerapia, $idPaziente, $dataScadenza, $idMedico);
        mysqli_stmt_execute($insert_terapia_stmt);

        if(mysqli_affected_rows($con) > 0) {

            $insert_prescrizione_query = "INSERT INTO `prescrizione`(`idTerapia`, `nomeFarmaco`, `descrizione`) VALUES (?, ?, ?)";
            $insert_prescrizione_stmt = mysqli_prepare($con, $insert_prescrizione_query);
            mysqli_stmt_bind_param($insert_prescrizione_stmt, 'iss', $idTerapia, $nomeFarmaco, $descrizione);

            for($i = 0; $i < count($farmaci); $i++) {
                $nomeFarmaco = $farmaci[$i];
                $descrizione = $descrizioni[$i];
                mysqli_stmt_execute($insert_prescrizione_stmt);
            }
        }
    }

    header("Location: ../../view/receptionist/profilo_paziente.php?idPaziente=" . urlencode($idPaziente));
}


