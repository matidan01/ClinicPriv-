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
        $fatturati = calcola_fatturato_totale_e_medio_tra_date($_POST['dataInizio'], $_POST['dataFine'], $con);
        $fatturato_giornaliero = $fatturati['media'];
        $toReturn = [$fatturati['totale'], $fatturato_giornaliero];
        $toReturnJSON = json_encode($toReturn);
        if ($fatturati != NULL){
            echo " $toReturnJSON";
        }
        else {
            echo "$fatturati";
        }
        
    }    
}
?>