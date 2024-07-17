<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

var_dump($_POST);
// Gestisce l'inserimento di un nuovo ordine 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Memorizza in array i materiali da ordinare e le relative quantità
    $materiali = array();
    $quantita = array();

    foreach ($_POST['materiali'] as $key => $value) {
        $materiale = explode(" ", $value);
        $materiali[] = $materiale[0];
    }

    foreach ($_POST['quantita'] as $key => $value) {
        $q = explode(" ", $value);
        $quantita[] = $q[0];
    }

    // Memorizza le informazioni riguardanti il fornitore e effettua l'inserimento
    if(count($materiali) > 0 && count($materiali) == count($quantita)) {
        
        $fornitore = explode(" ", $_POST['fornitore']);
        $idFornitore = intval($fornitore[0]);

        $receptionist = $_POST['receptionist'];

        $idOrdine = get_last_id_ordine($con) + 1;

        $insert_rifornimento_query = "INSERT INTO `ordine`(`idOrdine`, `idFornitore`, `dataOrdine`, `dataConsegna`, `nBadge`) VALUES (?, ?, CURDATE(), NULL, ?)";
        $stmt_insert_rifornimento = mysqli_prepare($con, $insert_rifornimento_query);
        mysqli_stmt_bind_param($stmt_insert_rifornimento, "iss", $idOrdine, $idFornitore, $receptionist);
        $run_rifornimento = mysqli_stmt_execute($stmt_insert_rifornimento);

        $insert_materiale_query = "INSERT INTO `rifornimento`(`idOrdine`, `idMateriale`, `quantita`) VALUES (?, ?, ?)";
        $stmt_insert_materiale = mysqli_prepare($con, $insert_materiale_query);

        // Prepara la query per incrementare numero_ordini
        $update_numero_ordini_query = "UPDATE `materiale` SET `numero_ordini` = `numero_ordini` + 1 WHERE `idMateriale` = ?";
        $stmt_update_numero_ordini = mysqli_prepare($con, $update_numero_ordini_query);

        for($i = 0; $i < count($materiali); $i++) {
            // Inserisci il materiale nel rifornimento
            mysqli_stmt_bind_param($stmt_insert_materiale, "iis", $idOrdine, $materiali[$i], $quantita[$i]);
            $run_materiale = mysqli_stmt_execute($stmt_insert_materiale);

            // Incrementa numero_ordini per questo materiale
            mysqli_stmt_bind_param($stmt_update_numero_ordini, "i", $materiali[$i]);
            $run_update_numero_ordini = mysqli_stmt_execute($stmt_update_numero_ordini);
        }

        // Chiudi gli statement
        mysqli_stmt_close($stmt_insert_materiale);
        mysqli_stmt_close($stmt_update_numero_ordini);
    }

    header("Location: ../../view/receptionist/rifornimenti.php");
}
