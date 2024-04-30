<?php
include_once("../../includes/connection.php");
include_once("../../includes/functions.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    assumi_personale($con, $_POST['ruolo'], $_POST['tipologia'], $_POST['nome'], $_POST['cognome'],$_POST['CF'],
    $_POST['email'],$_POST['dob'], $_POST['luogoNascita'], $_POST['phone'], $_POST['password'], $_POST['dir']);
    }
    
    ?>