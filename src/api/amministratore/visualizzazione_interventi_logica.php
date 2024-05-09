<?php
include_once("../../includes/connection.php");
include_once("../../includes/functions.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
    if(isset($_POST['chirurghi'])){
        $chirurghi = interventi_per_chirurgo($_POST['dataInizio'], $_POST['dataFine'], $con);
        $chirurghiJSON = json_encode($chirurghi);
        header('Content-Type: application/json');
        echo $chirurghiJSON;
        exit();
    }else{
        $interventi = calcola_interventi_e_prestazioni_tra_date($_POST['dataInizio'], $_POST['dataFine'], $con);
        $interventiJSON = json_encode($interventi);
        echo $interventiJSON;
    }    
}
?>