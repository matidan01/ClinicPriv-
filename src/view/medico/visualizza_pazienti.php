<?php
include_once("../../includes/connection.php");

$nBadge = $_GET['nBadge'];
$clienti = [];

//Memorizza i clienti che rispettano i criteri di ricerca
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ricercaCliente'])) {
    $search_term = "%" . $_POST['ricercaCliente'] . "%";

    $query = "SELECT * FROM paziente WHERE (nome LIKE ? OR cognome LIKE ? OR 
            CF LIKE ? OR idPaziente LIKE ?)";
    
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "ssss", $search_term, $search_term, $search_term, $search_term);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $clienti[] = $row;
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
    <title>Visualizza Pazienti</title>
    <!-- css -->
    <link rel="stylesheet" href="../../css/righeTabella.css">
    <!-- js -->
    <script src="../../js/gestione_clienti.js"></script>
    <!-- Link per Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link per Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="my-4">Pazienti</h1>

        <!-- Barra di ricerca -->
        <form method="POST">
            <input type="text" id="ricercaCliente" name="ricercaCliente" class="form-control mb-4" placeholder="Cerca paziente...">
            <button type="submit" class="btn btn-primary" id="s_button" name="s_button">Cerca</button>
        </form>

        <!-- Tabella dei clienti -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Data di Nascita</th>
                    <th scope="col">Codice Fiscale</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($clienti as $cliente) {
                    echo "<tr class='clickable-row' data-href='profilo_paziente.php?nBadge=".  urlencode($nBadge) ."&idPaziente=" . urlencode($cliente['idPaziente']) . "'>";
                    echo "<td>{$cliente['idPaziente']}</td>";
                    echo "<td>{$cliente['nome']}</td>";
                    echo "<td>{$cliente['cognome']}</td>";
                    echo "<td>{$cliente['dataNascita']}</td>";
                    echo "<td>{$cliente['CF']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>