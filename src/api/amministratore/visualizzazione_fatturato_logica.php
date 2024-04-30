<?php
include_once("../../includes/connection.php");
include_once("../../includes/functions.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['medici'])){
        $medici = fatturato_per_medico($_POST['dataInizio'], $_POST['dataFine'], $con);
        $mediciJSON = json_encode($medici);
        header('Content-Type: application/json');
        echo $mediciJSON;
        exit();
    }else{
        $fatturato = calcola_fatturato_tra_date($_POST['dataInizio'], $_POST['dataFine'], $con);
        if ($fatturato != NULL){
            echo " $fatturato" . "€";
        }
        else {
            echo "$fatturato";
        }
        
    }    
}
?>