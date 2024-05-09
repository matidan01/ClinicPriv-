<?php
include_once("../../includes/connection.php");
include_once("../../includes/functions.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $fatturato_mensile = get_fatturato_mensile($con);
    $f_m = array();
    for($i=1;$i<=12;$i++){
        array_push($f_m, 0);
    }
    foreach($fatturato_mensile as $f){
        $f_m[$f['mese']] = $f['totale'];
    }
    $f_mJSON = json_encode($f_m);
    header('Content-Type: application/json');
    echo $f_mJSON;  
}
?>