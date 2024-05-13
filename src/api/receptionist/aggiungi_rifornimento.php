<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

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

        $idOrdine = get_last_id_ordine($con) + 1;

        $insert_rifornimento_query = "INSERT INTO `ordine`(`idOrdine`, `idFornitore`, `dataOrdine`, `dataConsegna`) VALUES (?, ?, CURDATE(), NULL)";
        $stmt_insert_rifornimento = mysqli_prepare($con, $insert_rifornimento_query);
        mysqli_stmt_bind_param($stmt_insert_rifornimento, "is", $idOrdine, $idFornitore);
        $run_rifornimento = mysqli_stmt_execute($stmt_insert_rifornimento);

        $insert_materiale_query = "INSERT INTO `materialeordinato`(`idOrdine`, `idMateriale`, `quantita`) VALUES (?, ?, ?)";
        $stmt_insert_materiale = mysqli_prepare($con, $insert_materiale_query);

        for($i = 0; $i < count($materiali); $i++) {
            mysqli_stmt_bind_param($stmt_insert_materiale, "iis", $idOrdine, $materiali[$i], $quantita[$i]);
            $run_materiale = mysqli_stmt_execute($stmt_insert_materiale);
        }
    }

    header("Location: ../../view/receptionist/rifornimenti.php");
}
