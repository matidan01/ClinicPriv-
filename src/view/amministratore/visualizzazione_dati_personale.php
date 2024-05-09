<!doctype html>
<?php
session_start();
include_once("../../includes/connection.php");
include_once("../../includes/functions.php");
include_once("../../includes/database.php");

$personale = tutto_personale($con);
$numeri_personale = medici_receptionist_operatori_in_impiego($con);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ricercaPersonale'])) {
    $search_term = mysqli_real_escape_string($con, $_POST['ricercaPersonale']);
    
    $stmt = $con->prepare("SELECT nBadge, nome, cognome, CF, emailAziendale, dataNascita, luogoNascita, recapitoTelefonico, inizioRapporto, fineRapporto FROM operatore WHERE (nome LIKE '%$search_term%' OR cognome LIKE '%$search_term%' OR 
    CF LIKE '%$search_term%' OR nBadge LIKE '%$search_term%') UNION SELECT nBadge, nome, cognome, CF, emailAziendale, dataNascita, luogoNascita, recapitoTelefonico, inizioRapporto, fineRapporto FROM medico WHERE (nome LIKE '%$search_term%' OR cognome LIKE '%$search_term%' OR 
    CF LIKE '%$search_term%' OR nBadge LIKE '%$search_term%') UNION SELECT nBadge, nome, cognome, CF, emailAziendale, dataNascita, luogoNascita, recapitoTelefonico, inizioRapporto, fineRapporto FROM receptionist  WHERE (nome LIKE '%$search_term%' OR cognome LIKE '%$search_term%' OR 
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <div class="container">
        <h1 class="my-4">Visualizzazione dati personale</h1>
        <h4>Attualmente sono in impiego: <?php echo $numeri_personale[0]+$numeri_personale[1]+$numeri_personale[2]?> dipendenti</h4>

        <div class="quantita_personale">
            <div class="medici_qt">
                <p>Medici: <?php echo $numeri_personale[0]?></p>
            </div>
            <div class="receptionist_qt">
                <p>Receptionist: <?php echo $numeri_personale[1]?></p>
            </div>
            <div class="operatori_qt">
                <p>Operatori: <?php echo $numeri_personale[2]?></p>
            </div>
        </div>

        <form method="POST">
            <input type="text" id="ricercaPersonale" name="ricercaPersonale" class="form-control mb-4" placeholder="Cerca nel personale...">
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
                <?php
                foreach ($personale as $p) {
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