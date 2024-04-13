<?php
include_once("../../includes/connection.php");

$clienti = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ricercaCliente'])) {
    $search_term = mysqli_real_escape_string($con, $_POST['ricercaCliente']);
    
    $query = "SELECT * FROM paziente WHERE (nome LIKE '%$search_term%' OR cognome LIKE '%$search_term%' OR 
        CF LIKE '%$search_term%' OR idPaziente LIKE '%$search_term%')";
    $result = mysqli_query($con, $query);

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
    <title>Gestione Clienti</title>
    <!-- Link per Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link per Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <!-- Titolo della pagina -->
        <h1 class="my-4">Gestione Clienti</h1>

        <!-- Bottone "Aggiungi Cliente" -->
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#aggiungiClienteModal">
            Aggiungi Cliente
        </button>

        <!-- Barra di Ricerca -->
        <form method="POST">
            <input type="text" id="ricercaCliente" name="ricercaCliente" class="form-control mb-4" placeholder="Cerca cliente...">
            <button type="submit" class="btn btn-primary" id="s_button" name="s_button">Search</button>
        </form>

        <!-- Tabella dei Clienti -->
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
                <!-- Qui vengono inseriti dinamicamente i dati dei clienti -->
                <?php
                foreach ($clienti as $cliente) {
                    echo "<tr>";
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

    <!-- Modale per Aggiungere Cliente -->
    <div class="modal fade" id="aggiungiClienteModal" tabindex="-1" aria-labelledby="aggiungiClienteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aggiungiClienteModalLabel">Aggiungi Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="aggiungi_cliente.php">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" maxlength="20" required>
                        </div>
                        <div class="mb-3">
                            <label for="cognome" class="form-label">Cognome:</label>
                            <input type="text" class="form-control" id="cognome" name="cognome" maxlength="20" required>
                        </div>
                        <div class="mb-3">
                            <label for="cf" class="form-label">Codice Fiscale:</label>
                            <input type="text" class="form-control" id="cf" name="cf">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_nascita" class="form-label">Data di Nascita:</label>
                            <input type="date" class="form-control" id="data_nascita" name="data_nascita" required>
                        </div>
                        <div class="mb-3">
                            <label for="luogo_nascita" class="form-label">Luogo di Nascita:</label>
                            <input type="text" class="form-control" id="luogo_nascita" name="luogo_nascita" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Recapito Telefonico:</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note:</label>
                            <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Aggiungi Cliente</button>
                    </form>
            </div>
        </div>
    </div>

</body>

</html>
