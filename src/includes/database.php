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

function get_last_id_appuntamento($mysqli) {
    $stmt = $mysqli->prepare("SELECT max(idPrestazione) FROM appuntamento");
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()["max(idPrestazione)"];
}

function get_last_numero_fattura($mysqli) {
    $stmt = $mysqli->prepare("SELECT max(numeroFattura) FROM fattura");
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()["max(numeroFattura)"];
}

function get_sale($mysqli) {
    $sale = [];
    $query = "SELECT numero, tipo
            FROM sala
            "; 
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $sale[] = $row;
        }
    } 
    return $sale;
}

function get_nomi_prestazioni($mysqli) {
    $prestazioni = [];
    $query = "SELECT codicePrestazione, nome
            FROM listino
                ";  
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $prestazioni[] = $row;
        }
    } 
    return $prestazioni;
}

function get_medici($mysqli) {
    $medici = [];
    $query = "SELECT nBadge, nome, cognome
            FROM medico
                ";  
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $medici[] = $row;
        }
    } 
    return $medici;
}

function get_operatori($mysqli) {
    $operatori = [];
    $query = "SELECT nBadge, nome, cognome, CF
            FROM operatore
            "; 
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $operatori[] = $row;
        }
    } 
    return $operatori;
}

function get_pazienti($mysqli) {
    $pazienti = [];
    $query = "SELECT idPaziente, nome, cognome, CF
            FROM paziente
                ";  
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $pazienti[] = $row;
        }
    } 
    return $pazienti;
}

function elimina_responsabile($mysqli, $idPrestazione, $nBadge) {
    $query = "DELETE FROM responsabile
            WHERE idPrestazione = ? AND nBadge = ?
            ";  
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "ii", $idPrestazione, $nBadge);
    mysqli_stmt_execute($stmt);  
}

function elimina_assistente($mysqli, $idPrestazione, $nBadge) {
    $query = "DELETE FROM assistente
            WHERE idPrestazione = ? AND nBadge = ?
            ";  
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "ii", $idPrestazione, $nBadge);
    mysqli_stmt_execute($stmt);  
}

function get_responsabili_intervento($mysqli, $idPrestazione) {
    $medici = [];
    $query = "SELECT nBadge FROM responsabile
            WHERE idPrestazione = ?
            ";  
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "i", $idPrestazione);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $medici[] = $row['nBadge'];
        }
    } 
    return $medici; 
}

function get_assistenti_intervento($mysqli, $idPrestazione) {
    $operatori = [];
    $query = "SELECT nBadge FROM assistente
            WHERE idPrestazione = ?
            ";  
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "i", $idPrestazione);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $operatori[] = $row['nBadge'];
        }
    } 
    return $operatori; 
}

function inserisci_fattura($mysqli, $idPrestazione, $numeroFattura, $costo) {
    $insert_fattura_query = "INSERT INTO `fattura`(`idPrestazione`, `numeroFattura`, `totale`, `data`, `ora`) VALUES (?, ?, ?, CURDATE(), CURTIME())";
    $insert_fattura_stmt = mysqli_prepare($mysqli, $insert_fattura_query);
    mysqli_stmt_bind_param($insert_fattura_stmt, 'iis', $idPrestazione, $numeroFattura, $costo);
    return mysqli_stmt_execute($insert_fattura_stmt);
}

function inserisci_assistenti($con, $idPrestazione, $operatori) {
    $insert_assistente_query = "INSERT INTO `assistente`(`idPrestazione`, `nBadge`) VALUES (?, ?)";
    $insert_assistente_stmt = mysqli_prepare($con, $insert_assistente_query);
    mysqli_stmt_bind_param($insert_assistente_stmt, 'is', $idPrestazione, $nBadge);
    mysqli_stmt_execute($insert_assistente_stmt);

    foreach($operatori as $nBadge) {
        mysqli_stmt_execute($insert_assistente_stmt);
    }
}

function inserisci_responsabili($con, $idPrestazione, $medici) {
    $insert_responsabile_query = "INSERT INTO `responsabile`(`idPrestazione`, `nBadge`) VALUES (?, ?)";
    $insert_responsabile_stmt = mysqli_prepare($con, $insert_responsabile_query);
    mysqli_stmt_bind_param($insert_responsabile_stmt, 'is', $idPrestazione, $nBadge);
    mysqli_stmt_execute($insert_responsabile_stmt);

    foreach($medici as $nBadge) {
        mysqli_stmt_execute($insert_responsabile_stmt);
    }
}

function get_costo($mysqli, $idPrestazione) {
    $query = "SELECT appuntamento.idPrestazione, appuntamento.codicePrestazione, listino.costo
                FROM appuntamento 
                LEFT JOIN listino ON appuntamento.codicePrestazione = listino.codicePrestazione
                WHERE appuntamento.idPrestazione = ?;
            ";  
    $stmt = mysqli_prepare($mysqli, $query);
    mysqli_stmt_bind_param($stmt, "i", $idPrestazione);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    return $row['costo']; 
}

function tutto_personale($mysqli){
    $stmt = $mysqli->prepare("SELECT nBadge, nome, cognome, CF, emailAziendale, dataNascita, luogoNascita, recapitoTelefonico, inizioRapporto, fineRapporto, 'Receptionist' as tipologia 
                            FROM receptionist 
                            UNION SELECT nBadge, nome, cognome, CF, emailAziendale, dataNascita, luogoNascita, recapitoTelefonico, inizioRapporto, fineRapporto, tipologia 
                            FROM medico 
                            UNION SELECT nBadge, nome, cognome, CF, emailAziendale, dataNascita, luogoNascita, recapitoTelefonico, inizioRapporto, fineRapporto, tipologia 
                            FROM operatore");
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
    if($ruolo != "receptionist"){
        $stmt = $mysqli->prepare("INSERT INTO $ruolo (`nBadge`, `tipologia`, `nome`, `cognome`, `CF`, `emailAziendale`, 
        `dataNascita`, `luogoNascita`, `recapitoTelefonico`, `password`, `inizioRapporto`, finerapporto) VALUES (?, 
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL)");
        $nBadge = create_badge($ruolo, $mysqli);
        $stmt->bind_param("ssssssssiss", $nBadge, $tipologia, $nome, $cognome, $CF, $email, $dataNascita, $luogoNascita, $telefono, $pw, $inizioRapporto);
        $stmt->execute();
    }else{
        $stmt = $mysqli->prepare("INSERT INTO $ruolo (`nBadge`, `nome`, `cognome`, `CF`, `emailAziendale`, 
        `dataNascita`, `luogoNascita`, `recapitoTelefonico`, `password`, `inizioRapporto`, finerapporto) VALUES (?, 
        ?, ?, ?, ?, ?, ?, ?, ?, ?, NULL)");
        $nBadge = create_badge($ruolo, $mysqli);
        $stmt->bind_param("sssssssiss", $nBadge, $nome, $cognome, $CF, $email, $dataNascita, $luogoNascita, $telefono, $pw, $inizioRapporto);
        $stmt->execute();
    }
}

function calcola_fatturato_tra_date($dataInizio, $dataFine, $mysqli){
    $stmt = $mysqli->prepare("SELECT SUM(totale) as s
                      FROM fattura
                      WHERE dataPagamento >= ?
                      AND dataPagamento <= ?");
    $stmt->bind_param("ss", $dataInizio, $dataFine);
    $stmt->execute();
    $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $res[0]["s"];
}

function fatturato_per_medico($dataInizio, $dataFine, $mysqli){
    $stmt = $mysqli->prepare("SELECT m.nome, m.cognome, m.nBadge, SUM(f.totale)
                            FROM fattura AS f 
                            JOIN appuntamento AS a ON f.idPrestazione= a.codicePrestazione
                            JOIN responsabile AS r on a.idPrestazione = r.idPrestazione
                            RIGHT OUTER JOIN medico AS m ON m.nBadge = r.nBadge
                            AND f.dataPagamento >= ?
                            AND f.dataPagamento <= ?
                            GROUP BY m.nBadge");
    $stmt->bind_param("ss", $dataInizio, $dataFine);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function divisione_fatturato_per_mese_e_prestazione($dataInizio, $dataFine, $mysqli){
    $stmt = $mysqli->prepare("SELECT SUM(l.costo) AS totale, l.nome, MONTH(f.dataPagamento) AS month
                            FROM fattura AS f
                            JOIN appuntamento AS a ON f.idPrestazione = a.idPrestazione
                            JOIN listino AS l ON a.codicePrestazione = l.codicePrestazione
                            AND f.dataPagamento >= ?
                            AND f.dataPagamento <= ?
                            GROUP BY l.nome, MONTH(f.dataPagamento)
                            ORDER BY MONTH(f.dataPagamento)");
    $stmt->bind_param("ss", $dataInizio, $dataFine);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

function medici_receptionist_operatori_in_impiego($mysqli){
    $medici_operatori_receptionist = [0,0,0];
    $stmt = $mysqli->prepare("SELECT COUNT(nBadge) as medici
                            FROM medico
                            WHERE fineRapporto IS NULL");
    $stmt->execute();
    $medici_operatori_receptionist[0]= $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['medici'];
    $stmt = $mysqli->prepare("SELECT COUNT(nBadge) as operatori
                            FROM operatore
                            WHERE fineRapporto IS NULL");
    $stmt->execute();
    $medici_operatori_receptionist[1]=$stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['operatori'];
    $stmt = $mysqli->prepare("SELECT COUNT(nBadge) as receptionist
                            FROM receptionist
                            WHERE fineRapporto IS NULL");
    $stmt->execute();
    $medici_operatori_receptionist[2]=$stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['receptionist'];
    return $medici_operatori_receptionist;
    
}

