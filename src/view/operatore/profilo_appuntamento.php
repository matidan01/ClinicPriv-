<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");
/*if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
}*/

$id = isset($_GET['idPrestazione']) ? mysqli_real_escape_string($con, $_GET['idPrestazione']) : '';
$sale = get_sale($con);
$medici = get_medici($con);
$operatori = get_operatori($con);

$get_appuntamento = "SELECT prestazione.idPrestazione, prestazione.codicePrestazione, 
                prestazione.idPaziente, prestazione.dataInizio, prestazione.dataFine, prestazione.ora, listino.nome,
                paziente.nome AS nome_paziente, paziente.cognome AS cognome_paziente, paziente.CF,
                GROUP_CONCAT(DISTINCT CONCAT(medico.nome, ' ', medico.cognome) SEPARATOR ', ') AS medici_coinvolti,
                GROUP_CONCAT(DISTINCT CONCAT(operatore.nome, ' ', operatore.cognome) SEPARATOR ', ') AS operatori_coinvolti,
                ospita.numeroSala
                FROM prestazione
                INNER JOIN paziente ON prestazione.idPaziente = paziente.idPaziente
                LEFT JOIN responsabile ON prestazione.idPrestazione = responsabile.idPrestazione
                LEFT JOIN assistente ON prestazione.idPrestazione = assistente.idPrestazione
                LEFT JOIN listino ON prestazione.codicePrestazione = listino.codicePrestazione
                LEFT JOIN medico ON responsabile.nBadge = medico.nBadge
                LEFT JOIN operatore ON assistente.nBadge = operatore.nBadge
                LEFT JOIN ospita ON prestazione.idPrestazione = ospita.idPrestazione
                WHERE prestazione.idPrestazione = ?
                ";

$stmt = mysqli_prepare($con, $get_appuntamento);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Appuntamento</title>
    <!-- Link per Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link per Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- Link per Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<div class="container py-5">
    <h1 class="mb-5">Dettagli Appuntamento</h1>

    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        $appuntamento = mysqli_fetch_assoc($result);
        ?>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Informazioni Appuntamento</h5>
                <p><strong>Data Inizio:</strong> <?php echo $appuntamento['dataInizio']; ?></p>
                <p><strong>Data Fine:</strong> <?php echo $appuntamento['dataFine']; ?></p>
                <p><strong>Ora:</strong> <?php echo $appuntamento['ora']; ?></p>
                <p><strong>Nome Paziente:</strong> <?php echo $appuntamento['nome_paziente']; ?></p>
                <p><strong>Cognome Paziente:</strong> <?php echo $appuntamento['cognome_paziente']; ?></p>
                <p><strong>Codice Fiscale:</strong> <?php echo $appuntamento['CF']; ?></p>
                <p><strong>Nome Prestazione:</strong> <?php echo $appuntamento['nome']; ?></p>
                <p><strong>Sala:</strong> <?php echo $appuntamento['numeroSala']; ?></p>
                <p><strong>Medici:</strong> <?php echo $appuntamento['medici_coinvolti']; ?></p>
                <p><strong>Operatori:</strong> <?php echo $appuntamento['operatori_coinvolti']; ?></p>
            </div>
        </div>
        <?php } ?>
</body>
</html>
