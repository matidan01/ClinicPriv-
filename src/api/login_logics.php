<?php
session_start();
include_once("../includes/connection.php");
include_once("../includes/functions.php");

/*include_once("../includes/database.php");*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $badgeNumber = $_POST["badge_number"];
    $password = $_POST["password"];
    $type = substr($badgeNumber, 0, 1);

    if (check_login($badgeNumber, $password, $type, $con) == true) {
        go_to_home($type);
    } else {
        header("Location: ../view/login.php");
    }
}