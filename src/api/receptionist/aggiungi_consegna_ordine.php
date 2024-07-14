<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

// Gestisce la consegna di un ordine
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $idOrdine = $_POST['idOrdine'];

    // Aggiorna la data di consegna impostandola al giorno corrente
    $insert_data_query = "UPDATE `ordine` SET `dataConsegna` = CURDATE() WHERE `idOrdine`= ?";
    $stmt_insert_data = mysqli_prepare($con, $insert_data_query);
    mysqli_stmt_bind_param($stmt_insert_data, "i", $idOrdine);
    $run_data = mysqli_stmt_execute($stmt_insert_data);

    // Aggiorna in automatico le quantità dei materiali
    $modify_quantita_query = "UPDATE materiale m
                                JOIN (
                                    SELECT rif.idMateriale, rif.quantita
                                    FROM rifornimento rif
                                    WHERE rif.idOrdine = ?
                                ) AS materiale_ordine ON m.idMateriale = materiale_ordine.idMateriale
                                SET m.quantita = m.quantita + materiale_ordine.quantita;
                            ";
    $stmt_modify_quantita = mysqli_prepare($con, $modify_quantita_query);
    mysqli_stmt_bind_param($stmt_modify_quantita, "i", $idOrdine);
    $run_modify_quantita = mysqli_stmt_execute($stmt_modify_quantita);

}
