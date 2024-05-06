<?php
include_once ("connection.php");
include_once("database.php");
include_once("connection.php");

function check_login($badgeNumber, $password, $type, $mysqli){
    $colonna = "nBadge";
    switch($type){
        case 0:
            $table = "medico";
            break;
        case 1:
            $table = "operatore";
            break;
        case 2:
            $table = "receptionist";
            break;
        case 3:
            $table = "amministratore";
            $colonna = "idAmministratore";
            break;
        default:
            return false; 
    }
    $stmt = $mysqli->prepare("SELECT password FROM $table WHERE $colonna=?");
    print("$table");
    $stmt->bind_param("s", $badgeNumber);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    /*if(password_verify($password, $row['password']) == true){*/
    if($row["password"] == $password){
        $_SESSION['type'] = $type;
        return true;
    }else{
        return false;
    }
} 

function go_to_home($badgeNumber){
    switch($_SESSION["type"]){
        case 0:
            header("Location: ../view/medico/home_medico.php?badgeN=$badgeNumber");
            break;
        case 1:
            header("Location: ../view/operatore/home_operatore.php?badgeN=$badgeNumber");
            break;
        case 2:
            header("Location: ../view/receptionist/home_receptionist.php");
            break;
        case 3:
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

function stampa_tabella_dati_personale($con){
    $personale = tutto_personale($con);
}
