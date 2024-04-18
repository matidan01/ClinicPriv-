<?php
    include_once("../../includes/connection.php");
    include_once("../../includes/database.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $badge = $_POST['badge'];
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        termina_contratto($con, $badge);
    }
?>