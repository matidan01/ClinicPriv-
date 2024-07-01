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
    $dosi = array();
    $descrizioni = array();

    foreach ($_POST['nomeFarmaco'] as $key => $value) {
         // Memorizza i dati da inserire nella tabella 'appuntamento'
        $str = explode(" ", $value);
        $farmaci[] = $str[0];
        $dose[] = $str[1];
        $descrizioni[] = $_POST['descrizione'][$key];
    }

    // Effettua l'inserimento
    if(count($farmaci) > 0) {
        $insert_terapia_query = "INSERT INTO `terapia`(`idPaziente`, `dataScadenza`, `idMedico`) VALUES (?, ?, ?)";
        $insert_terapia_stmt = mysqli_prepare($con, $insert_terapia_query);
        mysqli_stmt_bind_param($insert_terapia_stmt, 'iss', $idPaziente, $dataScadenza, $idMedico);
        mysqli_stmt_execute($insert_terapia_stmt);

        if(mysqli_affected_rows($con) > 0) {

            $idTerapia = get_last_id_terapia($con);
            $insert_prescrizione_query = "INSERT INTO `prescrizione`(`idTerapia`, `nomeFarmaco`, `descrizione`, `dose`) VALUES (?, ?, ?, ?)";
            $insert_prescrizione_stmt = mysqli_prepare($con, $insert_prescrizione_query);
            mysqli_stmt_bind_param($insert_prescrizione_stmt, 'isss', $idTerapia, $nomeFarmaco, $descrizione, $d);

            for($i = 0; $i < count($farmaci); $i++) {
                $nomeFarmaco = $farmaci[$i];
                $d = $dose[$i];
                $descrizione = $descrizioni[$i];
                mysqli_stmt_execute($insert_prescrizione_stmt);
            }
        }
    }

    header("Location: ../../view/receptionist/profilo_paziente.php?idPaziente=" . urlencode($idPaziente));
}


