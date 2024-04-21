<?php
include_once ("connection.php");
include_once("functions.php");

function get_last_id_paziente($mysqli) {
    $stmt = $mysqli->prepare("SELECT max(idPaziente) FROM paziente");
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()["max(idPaziente)"];
}

function get_last_id_terapia($mysqli) {
    $stmt = $mysqli->prepare("SELECT max(idTerapia) FROM terapia");
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()["max(idTerapia)"];
}

function elimina_dati_paziente($mysqli, $idPaziente) {
    $stmt = $mysqli->prepare("DELETE FROM paziente WHERE idPaziente = ?");
    $stmt->bind_param("i",$idPaziente);
    $stmt->execute();
}

function tutto_personale($mysqli){
    $stmt = $mysqli->prepare("
    SELECT nBadge, nome, cognome, CF, emailAziendale, dataNascita, luogoNascita, recapitoTelefonico, inizioRapporto, fineRapporto, 'Receptionist' as tipologia 
    FROM receptionist 
    UNION SELECT nBadge, nome, cognome, CF, emailAziendale, dataNascita, luogoNascita, recapitoTelefonico, inizioRapporto, fineRapporto, tipologia 
    FROM medico 
    UNION SELECT nBadge, nome, cognome, CF, emailAziendale, dataNascita, luogoNascita, recapitoTelefonico, inizioRapporto, fineRapporto, tipologia 
    FROM operatore
");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function tutto_personale_ancora_assunto($mysqli){
    $stmt = $mysqli->prepare("SELECT nBadge, nome, cognome, CF, emailAziendale, dataNascita, luogoNascita, recapitoTelefonico, inizioRapporto, fineRapporto, tipologia  FROM medico WHERE fineRapporto IS NULL UNION 
    SELECT nBadge, nome, cognome, CF, emailAziendale, dataNascita, luogoNascita, recapitoTelefonico, inizioRapporto, fineRapporto, tipologia FROM operatore WHERE fineRapporto IS NULL 
    UNION SELECT nBadge, nome, cognome, CF, emailAziendale, dataNascita, luogoNascita, recapitoTelefonico, inizioRapporto, fineRapporto, 'Receptionist' as tipologia FROM receptionist WHERE fineRapporto IS NULL");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function termina_contratto($mysqli, $nBadge){
    if(strpos($nBadge, "O") !== false){
        $table = "operatore";
    }else if(strpos($nBadge, "M") !== false){
       $table = "medico";
    }else if(strpos($nBadge, "R") !== false){
        $table = "receptionist";
    }else{
        echo "badge selezionato invalido.";
    }
    $stmt = $mysqli->prepare("UPDATE $table SET fineRapporto = CURRENT_DATE() WHERE nBadge = ?");
    $stmt->bind_param("s", $nBadge);
    $stmt->execute();
}

function get_max_badge_number($tableName, $mysqli){
    $stmt = $mysqli->prepare("SELECT nBadge FROM $tableName");
    $stmt->execute();
    $badges = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $maxVal = 0;
    foreach($badges as $b){
        $num = (integer)substr($b['nBadge'], 1);
        if($num > $maxVal){
            $maxVal = $num;
        }
    }
    return $maxVal+1;
}

function assumi_personale($mysqli, $ruolo, $tipologia, $nome, $cognome, $CF, $email, $dataNascita, $luogoNascita, $telefono, $pw, $inizioRapporto){
    $stmt = $mysqli->prepare("INSERT INTO $ruolo (`nBadge`, `tipologia`, `nome`, `cognome`, `CF`, `emailAziendale`, 
    `dataNascita`, `luogoNascita`, `recapitoTelefonico`, `password`, `inizioRapporto`, finerapporto) VALUES ('?', 
    '?', '?', '?', '?', '?', '?', '?', '?', '?', '', NULL)");
    $nBadge = create_badge($ruolo, $mysqli);
    $stmt->prepare("ssssssssiss", $nBadge, $tipologia, $nome, $cognome, $CF, $email, $dataNascita, $luogoNascita, $telefono, $pw, $inizioRapporto);
    $stmt->execute();
}