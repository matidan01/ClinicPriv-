<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

$appuntamenti = [];
$medico_nBadge = isset($_GET['nBadge']) ? mysqli_real_escape_string($con, $_GET['nBadge']) : '';
$data_selezionata = isset($_POST['data']) ? mysqli_real_escape_string($con, $_POST['data']) : '';

// Costruisci la query di base
$query = "SELECT p.idPaziente, p.idPrestazione, p.dataInizio, p.dataFine, p.ora, p.sala,
                paziente.nome AS nome_paziente, paziente.cognome AS cognome_paziente,
                listino.nome AS nome_prestazione
        FROM prestazione p
        JOIN responsabile r ON p.idPrestazione = r.idPrestazione
        JOIN paziente ON p.idPaziente = paziente.idPaziente
        JOIN listino ON p.codicePrestazione = listino.codicePrestazione
        WHERE r.nBadge = ?";


// Aggiungi filtro per data se è stato fornito
if (!empty($data_selezionata)) {
    $query .= " AND p.dataInizio = ?";
}

if ($stmt = mysqli_prepare($con, $query)) {
    if (!empty($data_selezionata)) {
        mysqli_stmt_bind_param($stmt, "ss", $medico_nBadge, $data_selezionata);
    } else {
        mysqli_stmt_bind_param($stmt, "s", $medico_nBadge);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);


    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $appuntamenti[] = $row;
        }
    } else {
        echo "Nessun appuntamento trovato.";
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Errore nella preparazione della query.";
}

// Chiudi la connessione al database
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Appuntamenti</title>
    <!-- CSS -->
    <link rel="stylesheet" href="../../css/righeTabella.css">
    <!-- JS -->
    <script src="../../js/gestione_appuntamenti.js"></script>
    <!-- Link per Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link per Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container py-5">
        <h1 class="mb-5">Visualizza Appuntamenti</h1>

        <!-- Form per visualizzare appuntamenti di un determinato giorno -->
        <form action="" method="post" class="mb-3">
            <div class="row g-3">
                <div class="col-auto">
                    <label for="data" class="col-form-label">Seleziona una data:</label>
                </div>
                <div class="col-auto">
                    <input type="date" id="data" name="data" class="form-control">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Mostra Appuntamenti</button>
                </div>
            </div>
        </form>

        <!-- Form per visualizzare appuntamenti dal giorno corrente in poi -->
        <form action="" method="post" class="mb-3">
            <button type="submit" class="btn btn-secondary">Mostra Tutti gli Appuntamenti</button>
        </form>

        <!-- Tabella degli appuntamenti -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Data Inizio</th>
                    <th scope="col">Data Fine</th>
                    <th scope="col">Ora</th>
                    <th scope="col">Nome Paziente</th>
                    <th scope="col">Cognome Paziente</th>
                    <th scope="col">Nome Prestazione</th>
                    <th scope="col">Sala</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($appuntamenti as $appuntamento) {
                    echo "<tr class='clickable-row' data-href='profilo_appuntamento.php?";
                    if (isset($appuntamento['idPrestazione'])) {
                        echo "idPrestazione=" . urlencode($appuntamento['idPrestazione']);
                    }
                    echo "'>";
                    echo "<td>{$appuntamento['dataInizio']}</td>";
                    echo "<td>{$appuntamento['dataFine']}</td>";
                    echo "<td>{$appuntamento['ora']}</td>";
                    echo "<td>{$appuntamento['nome_paziente']}</td>";
                    echo "<td>{$appuntamento['cognome_paziente']}</td>";
                    echo "<td>{$appuntamento['nome_prestazione']}</td>";
                    echo "<td>{$appuntamento['sala']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>



