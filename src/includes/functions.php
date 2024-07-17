<?php
include_once ("connection.php");
include_once("database.php");
include_once("connection.php");

function check_login($badgeNumber, $password, $type, $mysqli){
    $colonna = "nBadge";
    switch($type){
        case 'M':
            $table = "medico";
            break;
        case 'O':
            $table = "operatore";
            break;
        case 'R':
            $table = "receptionist";
            break;
        case 'A':
            $table = "amministratore";
            $colonna = "idAmministratore";
            break;
        default:
            return false; 
    }
    $stmt = $mysqli->prepare("SELECT $colonna FROM $table WHERE $colonna = ? AND password = ?");
    $stmt->bind_param("ss", $badgeNumber, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
} 

function go_to_home($type, $nBadge){
    switch($type){
        case 'M':
            header("Location: ../view/medico/home_medico.php?badgeN=" . urldecode($nBadge));
            break;
        case 'O':
            header("Location: ../view/operatore/home_operatore.php?badgeN=" . urldecode($nBadge));
            break;
        case 'R':
            header("Location: ../view/receptionist/home_receptionist.php");
            break;
        case 'A':
            header("Location: ../view/amministratore/home_amministratore.php");
            break;
        default:
            print("Problemi di autenticazione rilevati");
    }
}

function create_badge($ruolo, $mysqli){
    $num = get_max_badge_number($ruolo, $mysqli);
    switch($ruolo){
        case "medico": 
            $badge = "M"."$num";
            break;
        case "operatore":
            $badge = "O"."$num";
            break;
        case "receptionist":
            $badge = "R"."$num";
            break;
        default:
            print("Errore nella creazione del badge.");
    }
    return $badge;
}

function create_codicePrestazione($tipo, $con){
    switch($tipo){
        case "intervento_chirurgico":
            $num = get_max_codicePrestazione("I", $con);
            $badge = "I"."$num";
            break;
        case "visita":
            $num = get_max_codicePrestazione("V", $con);
            $badge = "V"."$num";
            break;
        case "esame":
            $num = get_max_codicePrestazione("E", $con);
            $badge = "E"."$num";
            break;
        default:
            print("Errore nella creazione del badge.");
    }
    return $badge;
}

