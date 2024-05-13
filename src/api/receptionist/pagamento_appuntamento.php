<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

// Gestisce il pagamento di appuntamenti
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroFattura = get_last_numero_fattura($con) + 1;

    // Pagamento di un singolo appuntamento
    if (isset($_POST['risorsa'])) {   
        $id = intval($_POST['id']); 
        $costo = $_POST['costo'];    
        if(inserisci_fattura($con, $id, $numeroFattura, $costo)) {
            echo json_encode('OK');
        } else {
            echo json_encode('PROBLEM');
        }

    // Pagamento di molteplici appuntamenti
    } else if (isset($_POST['numero'])) { 
        $numero = $_POST['numero'];
        for ($i = 1; $i <= $numero*2; $i = $i+2) {
            inserisci_fattura($con, $_POST[$i], $numeroFattura, $_POST[$i+1]);
        }

        echo json_encode('OK');
    }

}