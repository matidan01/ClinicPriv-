<?php
include_once("../../includes/connection.php");

$materiali = [];

// Vengono visualizzati tutti i materiali presenti in magazzino e le informazioni relative 
// Specifica anche se il materiale è stato inserito in ordini che non sono ancora stati consegnati
$query = "SELECT 
            m.idMateriale, 
            m.nome, 
            m.quantita, 
            m.prezzo, 
            m.numero_ordini
        FROM 
            materiale m
            LEFT JOIN rifornimento r ON m.idMateriale = r.idMateriale
            LEFT JOIN ordine o ON r.idOrdine = o.idOrdine
        GROUP BY 
            m.idMateriale
        ";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $materiali[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazzino Clinica</title>
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
    <h1>Magazzino Clinica</h1>

    <!-- Bottone per aggiungere un nuovo materiale -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#nuovoMaterialeModal">
        Nuovo Materiale
    </button>

    <!-- Bottone per aggiornare quanità di un materiale in magazzino -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#aggiornaMaterialeModal">
        Aggiorna quantità Materiale
    </button>

    <!-- Tabella del magazzino -->
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID Materiale</th>
                <th scope="col">Nome</th>
                <th scope="col">Quantità</th>
                <th scope="col">Prezzo Unitario</th>
                <th scope="col">Numero Ordini</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($materiali as $materiale) {
                    echo "<tr class='clickable-row' data-bs-toggle='modal' data-bs-target='#dettaglioModal'>";
                    echo "<td>{$materiale['idMateriale']}</td>";
                    echo "<td>{$materiale['nome']}</td>";
                    echo "<td>{$materiale['quantita']}</td>";
                    echo "<td>{$materiale['prezzo']} $</td>";
                    echo "<td>{$materiale['numero_ordini']}</td>";
                    echo "</tr>";
                }
                ?>
        </tbody>
    </table>
</div>

<!-- Modal per inserire un nuovo materiale -->
<div class="modal fade" id="nuovoMaterialeModal" tabindex="-1" aria-labelledby="nuovoMaterialeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nuovoMaterialeModalLabel">Nuovo Materiale</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../../api/receptionist/aggiungi_materiale.php">
                    <div class="mb-3">
                        <label for="nomeMateriale" class="form-label">Nome Materiale</label>
                        <input type="text" class="form-control" name="nomeMateriale" id="nomeMateriale" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantitaMateriale" class="form-label">Quantità Materiale</label>
                        <input type="number" class="form-control" name="quantitaMateriale" id="quantitaMateriale" required>
                    </div>
                    <div class="mb-3">
                        <label for="prezzoMateriale" class="form-label">Prezzo Materiale</label>
                        <input type="number" class="form-control" name="prezzoMateriale" id="prezzoMateriale" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Aggiungi Materiale</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal aggiornare la quantità di un materiale in magazzino -->
<div class="modal fade" id="aggiornaMaterialeModal" tabindex="-1" aria-labelledby="aggiornaMaterialeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aggiornaMaterialeModalLabel">Aggiorna Quantità Materiale</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="../../api/receptionist/aggiungi_materiale.php">
                    <div class="mb-3">
                        <label for="idMateriale" class="form-label">ID Materiale</label>
                        <input class="form-control" list="materiale" name="idMateriale" required>
                        <datalist id="materiale">
                            <?php
                                foreach($materiali as $materiale) {
                                    $str = $materiale['idMateriale'] . ' - ' . $materiale['nome'];
                                    echo '<option value="' . $str . '">';
                                };
                            ?>
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="quantitaMateriale" class="form-label">Quantità Materiale</label>
                        <input type="number" class="form-control" name="quantitaMateriale" id="quantitaMateriale" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Aggiorna Materiale</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
