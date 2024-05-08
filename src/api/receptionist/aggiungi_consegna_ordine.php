<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idOrdine = $_POST['idOrdine'];

    $insert_data_query = "UPDATE `ordine` SET `dataConsegna` = CURDATE() WHERE `idOrdine`= ?";
    $stmt_insert_data = mysqli_prepare($con, $insert_data_query);
    mysqli_stmt_bind_param($stmt_insert_data, "i", $idOrdine);
    $run_data = mysqli_stmt_execute($stmt_insert_data);

}
