<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");

/*include_once("../includes/database.php");*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $badgeNumber = $_POST["badge_number"];
    $password = $_POST["password"];
    $type = $_POST["type"];
    print($type);

    if (check_login($badgeNumber, $password, $type, $con) == true) {
        header("Location: ../view/home.php");
    } else {
        $_SESSION['login_error'] = 'Numbero badge, password e/o tipo di login selezionato errato/i';
        header("Location: ../view/login.php");
        close_connection($con);
    }
}