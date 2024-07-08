<?php
    include_once("../../includes/connection.php");
    include_once("../../includes/database.php");

    $appuntamenti = [];
    $pazienti = get_pazienti($con);
    $medici = get_medici($con);
    $operatori = get_operatori($con);
    $prestazioni = get_nomi_prestazioni($con);
    $sale = get_sale($con);
    $nBadge = $_GET['badgeN'];

        if(isset($_GET['data'])) {
            $data = $_GET['data'];
        
            $query = "SELECT DISTINCT prestazione.idPrestazione, prestazione.idPaziente, prestazione.dataInizio,
            prestazione.dataFine, prestazione.ora, listino.nome, paziente.nome AS nome_paziente, paziente.cognome AS cognome_paziente,
            paziente.CF, medici.medici_coinvolti, operatori.operatori_coinvolti, prestazione.sala AS numeroSala
                    FROM prestazione
                    INNER JOIN paziente ON prestazione.idPaziente = paziente.idPaziente
                    LEFT JOIN responsabile ON prestazione.idPrestazione = responsabile.idPrestazione
                    LEFT JOIN assistente ON prestazione.idPrestazione = assistente.idPrestazione
                    LEFT JOIN listino ON prestazione.codicePrestazione = listino.codicePrestazione
                    LEFT JOIN 
                        (SELECT idPrestazione, GROUP_CONCAT(DISTINCT CONCAT(medico.nome, ' ', medico.cognome) SEPARATOR ', ') AS medici_coinvolti
                        FROM medico
                        INNER JOIN responsabile ON medico.nBadge = responsabile.nBadge
                        GROUP BY idPrestazione) AS medici ON prestazione.idPrestazione = medici.idPrestazione
                    LEFT JOIN 
                        (SELECT idPrestazione, GROUP_CONCAT(DISTINCT CONCAT(operatore.nome, ' ', operatore.cognome) SEPARATOR ', ') AS operatori_coinvolti
                        FROM operatore
                        INNER JOIN assistente ON operatore.nBadge = assistente.nBadge
                        GROUP BY idPrestazione) AS operatori ON prestazione.idPrestazione = operatori.idPrestazione
                    WHERE 
                        DATE(prestazione.dataInizio) = ?
                        AND assistente.nBadge = ?
                    ORDER BY 
                        prestazione.ora ASC;
                ";
        
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "ss", $data, $nBadge);
        } else {
            $query = "SELECT DISTINCT prestazione.idPrestazione, prestazione.idPaziente, prestazione.dataInizio,
            prestazione.dataFine, prestazione.ora, listino.nome, paziente.nome AS nome_paziente, paziente.cognome AS cognome_paziente,
            paziente.CF, medici.medici_coinvolti, operatori.operatori_coinvolti, prestazione.sala AS numeroSala
                    FROM prestazione
                    INNER JOIN paziente ON prestazione.idPaziente = paziente.idPaziente
                    LEFT JOIN responsabile ON prestazione.idPrestazione = responsabile.idPrestazione
                    LEFT JOIN assistente ON prestazione.idPrestazione = assistente.idPrestazione
                    LEFT JOIN listino ON prestazione.codicePrestazione = listino.codicePrestazione
                    LEFT JOIN 
                        (SELECT idPrestazione, GROUP_CONCAT(DISTINCT CONCAT(medico.nome, ' ', medico.cognome) SEPARATOR ', ') AS medici_coinvolti
                        FROM medico
                        INNER JOIN responsabile ON medico.nBadge = responsabile.nBadge
                        GROUP BY idPrestazione) AS medici ON prestazione.idPrestazione = medici.idPrestazione
                    LEFT JOIN 
                        (SELECT idPrestazione, GROUP_CONCAT(DISTINCT CONCAT(operatore.nome, ' ', operatore.cognome) SEPARATOR ', ') AS operatori_coinvolti
                        FROM operatore
                        INNER JOIN assistente ON operatore.nBadge = assistente.nBadge
                        GROUP BY idPrestazione) AS operatori ON prestazione.idPrestazione = operatori.idPrestazione
                    WHERE 
                        DATE(prestazione.dataInizio) >= CURDATE()
                        AND assistente.nBadge = ?
                    ORDER BY 
                        prestazione.ora ASC;
        ";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, "s", $nBadge);
        } 

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $appuntamenti[] = $row;
            }
        } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appuntamenti</title>
    <!-- Link per Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link per Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<style>
    .clickable-row:hover {
        cursor: pointer;
        background-color: #f0f0f0; 
    }
</style>
<body>
    <div class="container py-5">
        <h1 class="mb-5">Appuntamenti:</h1>
        <form action="" method="get" class="mb-3">
            <div class="row g-3">
                <div class="col-auto">
                    <label for="data" class="col-form-label">Seleziona una data:</label>
                </div>
                <div class="col-auto">
                    <input type="date" id="data" name="data" class="form-control">
                </div>
                <div class="col-auto">
                    <input type="hidden" id="badgeN" name="badgeN" value=<?php print_r("$nBadge")?>>
                    <button type="submit" class="btn btn-primary">Mostra Appuntamenti per Giorno</button>
                </div>
            </div>
        </form>
        <!-- Tabella degli appuntamenti -->
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
                    echo "<td>{$appuntamento['CF']}</td>";
                    echo "<td>{$appuntamento['nome']}</td>";
                    echo "<td>{$appuntamento['medici_coinvolti']}</td>";
                    echo "<td>{$appuntamento['operatori_coinvolti']}</td>";
                    echo "<td>{$appuntamento['numeroSala']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    
    document.addEventListener("DOMContentLoaded", function() {
        const rows = document.querySelectorAll(".clickable-row"); 
        rows.forEach(row => {
            row.addEventListener("click", function() {
                const url = row.getAttribute("data-href"); 
                if (url) {
                    window.location.href = url; 
                }
            });
        });
    });

</script>
</html>
