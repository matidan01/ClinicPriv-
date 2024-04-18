<!doctype html>
<?php
session_start();
include_once("../../includes/connection.php");
include_once("../../includes/functions.php");
include_once("../../includes/database.php");

$personale = tutto_personale_ancora_assunto($con);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ricercaPersonale'])) {
    $search_term = mysqli_real_escape_string($con, $_POST['ricercaPersonale']);
    
    $stmt = $con->prepare("SELECT * FROM operatore WHERE ((nome LIKE '%$search_term%' OR cognome LIKE '%$search_term%' OR 
    CF LIKE '%$search_term%' OR nBadge LIKE '%$search_term%') AND fineRapporto IS NULL ) UNION SELECT * FROM medico WHERE ((nome LIKE '%$search_term%' OR cognome LIKE '%$search_term%' OR 
    CF LIKE '%$search_term%' OR nBadge LIKE '%$search_term%') AND fineRapporto IS NULL ) UNION SELECT * FROM receptionist  WHERE ((nome LIKE '%$search_term%' OR cognome LIKE '%$search_term%' OR 
    CF LIKE '%$search_term%' OR nBadge LIKE '%$search_term%') AND fineRapporto IS NULL )");
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
        <h1 class="my-4">Terminazione contratto</h1>
        <h2>Selezionare il personale con cui si vuole terminare il cotratto lavorativo.</h2>
        <form method="POST">
            <input type="text" id="ricercaCliente" name="ricercaPersonale" class="form-control mb-4" placeholder="Cerca nel personale...">
            <button type="submit" class="btn btn-primary" id="ric_pers" name="ric_pers">Search</button>
        </form>

        <h3><?php
        echo date('Y-m-d');
        ?></h3>

        

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Badge</th>
                    <th scope="col">tipologia</th>
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
                    echo "<tr class='clickable-row'>";
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
<script>
    // Aggiungi un gestore di eventi per il clic sulle righe della tabella
    document.addEventListener("DOMContentLoaded", function() {
        const rows = document.querySelectorAll(".clickable-row"); // Seleziona tutte le righe cliccabili
        rows.forEach(row => {
            row.addEventListener("click", function() {
                const badge = row.cells[0].innerText; 
                const nome = row.cells[2].innerText; 
                const cognome = row.cells[3].innerText;
                
                const conferma = confirm("Vuoi terminare il contratto con " + cognome + " " + nome + " " + badge + " ?");
                if(conferma){
                    const formData = new FormData();
                    formData.append('badge', badge);
                    formData.append('nome', nome);
                    formData.append('cognome', cognome);
                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", "../../api/amministratore/termina_contratto.php");
                    xhr.send(formData);
                }
            });
        });
    });
</script>