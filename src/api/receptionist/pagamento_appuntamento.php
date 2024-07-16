<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

// Gestisce il pagamento di appuntamenti
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Pagamento di un singolo appuntamento
    if (isset($_POST['risorsa'])) {   
        $id = intval($_POST['id']);     
        if(!is_pagato($con, $id)) {
            paga_fattura($con, $id);
            echo json_encode('OK');
        } else {
            echo json_encode('PROBLEM');
        }

    // Pagamento di molteplici appuntamenti
    } else if (isset($_POST['numero'])) { 
        $numero = $_POST['numero'];
        for ($i = 1; $i <= $numero*2; $i = $i+2) {
            paga_fattura($con, $_POST[$i]);
        }

        echo json_encode('OK');
    }

}