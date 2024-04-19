<?php
    include_once("../../includes/connection.php");
    $appuntamenti = [];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['data'])) {
            $data = $_POST['data'];
        
            $query = "SELECT appuntamento.idPaziente, appuntamento.dataInizio, appuntamento.dataFine, appuntamento.ora, listino.nome,
                        paziente.nome AS nome_paziente, paziente.cognome AS cognome_paziente, paziente.CF,
                        GROUP_CONCAT(DISTINCT CONCAT(medico.nome, ' ', medico.cognome) SEPARATOR ', ') AS medici_coinvolti,
                        GROUP_CONCAT(DISTINCT CONCAT(operatore.nome, ' ', operatore.cognome) SEPARATOR ', ') AS operatori_coinvolti
                    FROM appuntamento
                    INNER JOIN paziente ON appuntamento.idPaziente = paziente.idPaziente
                    LEFT JOIN responsabile ON appuntamento.idPrestazione = responsabile.idPrestazione
                    LEFT JOIN assistente ON appuntamento.idPrestazione = assistente.idPrestazione
                    LEFT JOIN listino ON appuntamento.codicePrestazione = listino.codicePrestazione
                    LEFT JOIN medico ON responsabile.nBadge = medico.nBadge
                    LEFT JOIN operatore ON assistente.nBadge = operatore.nBadge
                    WHERE DATE(appuntamento.dataInizio) = ?
                    ORDER BY appuntamento.ora ASC;
                ";
        
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "s", $data);
        } else {
            $query = "SELECT appuntamento.idPaziente, appuntamento.dataInizio, appuntamento.dataFine, appuntamento.ora, listino.nome,
                        paziente.nome AS nome_paziente, paziente.cognome AS cognome_paziente, paziente.CF,
                        GROUP_CONCAT(DISTINCT CONCAT(medico.nome, ' ', medico.cognome) SEPARATOR ', ') AS medici_coinvolti,
                        GROUP_CONCAT(DISTINCT CONCAT(operatore.nome, ' ', operatore.cognome) SEPARATOR ', ') AS operatori_coinvolti
                    FROM appuntamento
                    INNER JOIN paziente ON appuntamento.idPaziente = paziente.idPaziente
                    LEFT JOIN responsabile ON appuntamento.idPrestazione = responsabile.idPrestazione
                    LEFT JOIN assistente ON appuntamento.idPrestazione = assistente.idPrestazione
                    LEFT JOIN listino ON appuntamento.codicePrestazione = listino.codicePrestazione
                    LEFT JOIN medico ON responsabile.nBadge = medico.nBadge
                    LEFT JOIN operatore ON assistente.nBadge = operatore.nBadge
                    WHERE DATE(appuntamento.dataInizio) >= CURDATE()
                    ORDER BY appuntamento.ora ASC;
                ";
       
            $stmt = mysqli_prepare($con, $query);
        } 

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $appuntamenti[] = $row;
            }
        } else {
            echo "No results found";
        }

    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Appuntamenti</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .clickable-row:hover {
            cursor: pointer;
            background-color: #f0f0f0; 
        }
</style>
<body>
    <div class="container py-5">
        <h1 class="mb-5">Gestione Appuntamenti</h1>
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
        <form action="" method="post" class="mb-3">
            <button type="submit" class="btn btn-secondary">Mostra Tutti gli Appuntamenti</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Data Fine</th>
                    <th scope="col">Ora</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Codice Fiscale</th>
                    <th scope="col">Nome prestazione</th>
                    <th scope="col">Medici</th>
                    <th scope="col">Operatori</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($appuntamenti as $appuntamento) {
                    echo "<tr class='clickable-row' data-href=''>";
                    echo "<td>{$appuntamento['dataInizio']}</td>";
                    echo "<td>{$appuntamento['dataFine']}</td>";
                    echo "<td>{$appuntamento['ora']}</td>";
                    echo "<td>{$appuntamento['nome_paziente']}</td>";
                    echo "<td>{$appuntamento['cognome_paziente']}</td>";
                    echo "<td>{$appuntamento['CF']}</td>";
                    echo "<td>{$appuntamento['nome']}</td>";
                    echo "<td>{$appuntamento['medici_coinvolti']}</td>";
                    echo "<td>{$appuntamento['operatori_coinvolti']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
