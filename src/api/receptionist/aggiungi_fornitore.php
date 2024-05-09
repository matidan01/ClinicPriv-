<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idFornitore = get_last_id_fornitore($con) + 1;
    $nome = $_POST['nome'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];

    $insert_fornitore_query = "INSERT INTO `fornitore`(`idFornitore`, `nome`, `recapitoTelefonico`, `email`) VALUES (?, ?, ?, ?)";
    $stmt_insert_fornitore = mysqli_prepare($con, $insert_fornitore_query);
    mysqli_stmt_bind_param($stmt_insert_fornitore, "isis", $idFornitore, $nome, $tel, $email);
    $run_data = mysqli_stmt_execute($stmt_insert_fornitore);

}
