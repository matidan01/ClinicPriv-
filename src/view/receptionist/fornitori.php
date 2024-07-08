<?php
include_once("../../includes/connection.php");

// Memorizza nel vettore fornitori tutti i fornitori presenti nel database
//DOMANDA: COME MAI IL FORNITORE HA UN VARCHAR COME ID? LO FACCIAMO INCREMENTALE?
$fornitori = [];
$query = "SELECT *
            FROM fornitore
        ";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $fornitori[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettaglio Fornitori</title>
    <!-- css -->
    <link rel="stylesheet" href="../../css/righeTabella.css">
    <!-- Link per Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link per Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <h1>Fornitori</h1>
    <!-- Bottone per aggiungere nuovo fornitore -->
    <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#aggiungiFornitoreModal">Aggiungi Fornitore</button>
    
    <!-- Tabella di tutti i fornitori nel database con dati memorizzati -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID Fornitore</th>
                <th scope="col">Nome</th>
                <th scope="col">Recapito Telefonico</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($fornitori as $fornitore) {
                    echo "<tr class='clickable-row'>";
                    echo "<td>{$fornitore['idFornitore']}</td>";
                    echo "<td>{$fornitore['nome']}</td>";
                    echo "<td>{$fornitore['recapitoTelefonico']}</td>";
                    echo "<td>{$fornitore['email']}</td>";
                    echo "</tr>";
                }
                ?>
        </tbody>
    </table>
</div>

<!-- Modal Aggiungi Fornitore -->
<div class="modal fade" id="aggiungiFornitoreModal" tabindex="-1" aria-labelledby="aggiungiFornitoreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aggiungiFornitoreModalLabel">Aggiungi Fornitore</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form per aggiungere un nuovo fornitore -->
                <form action="../../api/receptionist/aggiungi_fornitore.php" method="POST">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Fornitore:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="tel" class="form-label">Recapito Telefonico</label>
                        <input type="number" class="form-control" id="tel" name="tel" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Salva</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
