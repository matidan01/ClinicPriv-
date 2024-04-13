<?php
include_once ("connection.php");

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
            return false; // Invalid type
    }
    $stmt = $mysqli->prepare("SELECT password FROM $table WHERE $colonna=?");
    print("$table");
    $stmt->bind_param("i", $badgeNumber);
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

function print_home(){
    switch($_SESSION["type"]){
        case 0:
            print_home_medico();
            break;
        case 1:
            print_home_operatore();
            break;
        case 2:
            print_home_receptionist();
            break;
        case 3:
            print_home_amministratore();
            break;
        default:
            print("Problemi di autenticazione rilevati");
    }
}

function print_home_amministratore(){
    echo("
        <button>Assunzione personale</button>
        <button>Termine contratto con personale</button>
        <button>Visualizzazione dati fatturato</button>
        <button>Visualizzazione dati fatturato</button>
        <button>Visualizzazione dati interventi</button>
        <button>Visualizzazione grafico fatture</button>
        <button>Visualizzazione dati personale</button>
    ");
}

