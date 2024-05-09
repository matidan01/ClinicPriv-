<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if(isset($_POST['nomeMateriale'])) {
        $nome = $_POST['nomeMateriale'];
        $quantita = $_POST['quantitaMateriale'];
        $prezzo = $_POST['prezzoMateriale'];

        $insert_materiale_query = "INSERT INTO `materiale`(`nome`, `quantita`, `prezzo`) VALUES (?, ?, ?)";
        $stmt_insert_materiale = mysqli_prepare($con, $insert_materiale_query);
        mysqli_stmt_bind_param($stmt_insert_materiale, "sii", $nome, $quantita, $prezzo);
        $run_materiale = mysqli_stmt_execute($stmt_insert_materiale);
    } else if (isset($_POST['idMateriale'])) {
        $id = $_POST['idMateriale'];
        $quantita = $_POST['quantitaMateriale'];

        $insert_materiale_query = "UPDATE `materiale` SET `quantita`=? WHERE `idMateriale` = ?";
        $stmt_insert_materiale = mysqli_prepare($con, $insert_materiale_query);
        mysqli_stmt_bind_param($stmt_insert_materiale, "ii", $quantita, $id);
        $run_materiale = mysqli_stmt_execute($stmt_insert_materiale);
    }
    

    header("Location: ../../view/receptionist/magazzino.php");
}
