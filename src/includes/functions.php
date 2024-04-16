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
            return false; 
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

function go_to_home(){
    switch($_SESSION["type"]){
        case 0:
            header("Location: #");
            break;
        case 1:
            header("Location: #");
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
