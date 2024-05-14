<?php
include_once("../../includes/connection.php");
include_once("../../includes/functions.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
    if(!contenuto_in_listino($_POST['nome'], $con)){
        aggiungi_a_listino($_POST['nome'], $_POST['costo'], $_POST['tipo'], $con);
    }
    header("Location: ../../view/amministratore/visualizzazione_listino.php");
}    