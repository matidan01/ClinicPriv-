<?php
include_once ("connection.php");

function check_login($badgeNumber, $password, $type, $mysqli){
    switch($type){
        case 0:
            $table = "Medico";
        case 1:
            $table = "Operatore";
        case 2:
            $table = "Receptionist";
        case 3:
            $table = "Amministratore";
    }
    $stmt = $mysqli->prepare("SELECT Password FROM ? WHERE Badge=?");
    $stmt->bind_param("is", $badgeNumber, $table);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    if(password_verify($password, $row['Password']) == true){
        $_SESSION['type'] = $type;
        return true;
    }else{
        return false;
    }
} 
