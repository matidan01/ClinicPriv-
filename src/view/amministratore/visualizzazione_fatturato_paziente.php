<!doctype html>
<?php
session_start();
include_once("../../includes/connection.php");
include_once("../../includes/functions.php");
include_once("../../includes/database.php");

$pazienti = fatturato_medio_e_totale_clienti($con);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ricercaPaziente'])) {
    $search_term = mysqli_real_escape_string($con, $_POST['ricercaPaziente']);
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
        <h1>Visualizzazione spesa pazienti:</h1>

        <form method="POST">
            <input type="text" id="ricercaPaziente" name="ricercaPaziente" class="form-control mb-4" placeholder="Cerca tra i pazienti...">
            <button type="submit" class="btn btn-primary" id="ric_paz" name="ric_paz">Search</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Spesa totale</th>
                    <th scope="col">Spesa media</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pazienti as $p) {
                    echo "<td>{$p['nome']}</td>";
                    echo "<td>{$p['cognome']}</td>";
                    echo "<td>{$p['spesaTot']}</td>";
                    echo "<td>{$p['spesaMedia']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
  </body>
</html>