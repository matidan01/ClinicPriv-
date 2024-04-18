<!doctype html>
<?php
session_start();
include_once("../../includes/connection.php");
include_once("../../includes/functions.php");
include_once("../../includes/database.php");

$personale = tutto_personale($con);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ricercaPersonale'])) {
    $search_term = mysqli_real_escape_string($con, $_POST['ricercaPersonale']);
    
    $stmt = $con->prepare("SELECT * FROM operatore WHERE (nome LIKE '%$search_term%' OR cognome LIKE '%$search_term%' OR 
    CF LIKE '%$search_term%' OR nBadge LIKE '%$search_term%') UNION SELECT * FROM medico WHERE (nome LIKE '%$search_term%' OR cognome LIKE '%$search_term%' OR 
    CF LIKE '%$search_term%' OR nBadge LIKE '%$search_term%') UNION SELECT * FROM receptionist  WHERE (nome LIKE '%$search_term%' OR cognome LIKE '%$search_term%' OR 
    CF LIKE '%$search_term%' OR nBadge LIKE '%$search_term%')");
    $stmt->execute();
    $personale = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

}
?>
<html lang="en">
  <head>
    <title>Clinic Privè</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" type="text/css" href="../css/index.css">-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <div class="container">
        <h1 class="my-4">Visualizzazione dati personale</h1>

        <form method="POST">
            <input type="text" id="ricercaCliente" name="ricercaPersonale" class="form-control mb-4" placeholder="Cerca nel personale...">
            <button type="submit" class="btn btn-primary" id="ric_pers" name="ric_pers">Search</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Badge</th>
                    <th scope="col">Tipologia</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Codice Fiscale</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Data di Nascita</th>
                    <th scope="col">Luogo di Nascita</th>
                    <th scope="col">Recapito telefonico</th>
                    <th scope="col">Data inizio rapporto</th>
                    <th scope="col">Data fine rapporto</th>
                </tr>
            </thead>
            <tbody>
                <!-- Qui vengono inseriti dinamicamente i dati dei clienti -->
                <?php
                foreach ($personale as $p) {
                    /*echo "<tr class='clickable-row' data-href='profilo_personale.php?idPersonale=" . urlencode($cliente['idPaziente']) . "'>";*/
                    echo "<td>{$p['nBadge']}</td>";
                    echo "<td>{$p['tipologia']}</td>";
                    echo "<td>{$p['nome']}</td>";
                    echo "<td>{$p['cognome']}</td>";
                    echo "<td>{$p['CF']}</td>";
                    echo "<td>{$p['emailAziendale']}</td>";
                    echo "<td>{$p['dataNascita']}</td>";
                    echo "<td>{$p['luogoNascita']}</td>";
                    echo "<td>{$p['recapitoTelefonico']}</td>";
                    echo "<td>{$p['inizioRapporto']}</td>";
                    echo "<td>{$p['fineRapporto']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
  </body>
</html>