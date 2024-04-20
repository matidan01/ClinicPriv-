<?php
include_once ("connection.php");

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

