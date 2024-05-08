<?php
    include_once("../../includes/connection.php");
    include_once("../../includes/database.php");

    $fornitori = get_fornitori($con);
    $materiali = get_materiali($con);
    $rifornimenti = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['ricercaDaRicevere'])) {
            $query = "SELECT ordine.idOrdine, ordine.idFornitore, ordine.dataOrdine, ordine.dataConsegna,
                            fornitore.nome AS nome_fornitore,
                            COUNT(materialeordinato.idMateriale) AS num_materiali_ordinati,
                            GROUP_CONCAT(materiale.nome SEPARATOR ', ') AS nomi_materiali,
                            GROUP_CONCAT(materialeordinato.quantita SEPARATOR ', ') AS quantita_materiali,
                            SUM(materiale.prezzo * materialeordinato.quantita) AS totale_ordine
                        FROM ordine
                        LEFT JOIN materialeordinato ON ordine.idOrdine = materialeordinato.idOrdine
                        LEFT JOIN materiale ON materialeordinato.idMateriale = materiale.idMateriale
                        LEFT JOIN fornitore ON ordine.idFornitore = fornitore.idFornitore
                        WHERE ordine.dataConsegna IS NULL
                        GROUP BY ordine.idOrdine, ordine.idFornitore, ordine.dataOrdine, ordine.dataConsegna
                        ORDER BY ordine.dataOrdine DESC;;
                ";
        
            $stmt = mysqli_prepare($con, $query);
        } else {

            $query = "SELECT ordine.idOrdine, ordine.idFornitore, ordine.dataOrdine, ordine.dataConsegna,
                        fornitore.nome AS nome_fornitore, 
                        COUNT(materialeordinato.idMateriale) AS num_materiali_ordinati,
                        GROUP_CONCAT(materiale.nome SEPARATOR ', ') AS nomi_materiali,
                        GROUP_CONCAT(materialeordinato.quantita SEPARATOR ', ') AS quantita_materiali,
                        SUM(materiale.prezzo * materialeordinato.quantita) AS totale_ordine
                    FROM ordine
                    LEFT JOIN materialeordinato ON ordine.idOrdine = materialeordinato.idOrdine
                    LEFT JOIN materiale ON materialeordinato.idMateriale = materiale.idMateriale
                    LEFT JOIN fornitore ON ordine.idFornitore = fornitore.idFornitore
                    GROUP BY ordine.idOrdine, ordine.idFornitore, ordine.dataOrdine, ordine.dataConsegna
                    ORDER BY ordine.dataOrdine DESC;
                ";
            
            $stmt = mysqli_prepare($con, $query);
        } 

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $rifornimenti[] = $row;
            }
        } 

    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Rifornimenti</title>
    <!-- js -->
    <script src="../../js/rifornimenti.js"></script>
    <!-- Link per Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link per Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
     <!-- Link per Axios -->
     <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <div class="container py-5">
        <h1 class="mb-5">Gestione Rifornimenti</h1>
        <form method="POST" >
            <input type="text" id="ricercaDaRicevere" name="ricercaDaRicevere" class="form-control mb-4" hidden>
            <button type="submit" class="btn btn-primary mb-3">Mostra Ordini da Ricevere</button>
        </form>

        <form method="POST" >
            <button type="submit" class="btn btn-primary mb-3">Mostra Ordini</button>
        </form>
        
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#aggiungiOrdineModal">Aggiungi Ordine</button>
        <table class="table table-bordered">
            <thead>
                <tr class="table-info">
                    <th scope="col">ID ordine</th>
                    <th scope="col">ID Fornitore</th>
                    <th scope="col">Nome Fornitore</th>
                    <th scope="col">Materiale</th>
                    <th scope="col">Quantità</th>
                    <th scope="col">Data ordine</th>
                    <th scope="col">Data ricezione</th>
                    <th scope="col">Prezzo totale</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $class = 'table-light';
                    foreach ($rifornimenti as $rifornimento) {
                        $class = $class == 'table-light' ? 'table-active' : 'table-light';
                        $n_materiali = $rifornimento['num_materiali_ordinati'];
                        $materiali = explode(", ", $rifornimento['nomi_materiali']);
                        $quantita = explode(", ", $rifornimento['quantita_materiali']);
                        echo "<tr class='clickable-row " . $class . "'>";
                        echo "<td rowspan='{$n_materiali}'>{$rifornimento['idOrdine']}</td>";
                        echo "<td rowspan='{$n_materiali}'>{$rifornimento['idFornitore']}</td>";
                        echo "<td rowspan='{$n_materiali}'>{$rifornimento['nome_fornitore']}</td>";
                        echo "<td>{$materiali[0]}</td>";
                        echo "<td>{$quantita[0]}</td>";
                        echo "<td rowspan='{$n_materiali}'>{$rifornimento['dataOrdine']}</td>";
                        if ($rifornimento['dataConsegna'] == null) {
                            echo "<td rowspan='{$n_materiali}'><button type='button' class='btn btn-primary aggiungiConsegna' value=" . $rifornimento['idOrdine'] . ">Aggiungi Consegna</button></td>";
                        } else {
                            echo "<td rowspan='{$n_materiali}'>{$rifornimento['dataConsegna']}</td>";
                        }
                        echo "<td rowspan='{$n_materiali}'>{$rifornimento['totale_ordine']}</td>";
                        echo "</tr>";
                        for($i = 1; $i < $n_materiali; $i++) {
                            echo "<tr class='clickable-row " . $class . "'>";
                            echo "<td>{$materiali[$i]}</td>";
                            echo "<td>{$quantita[$i]}</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Aggiungi Ordine -->
    <div class="modal fade" id="aggiungiOrdineModal" tabindex="-1" aria-labelledby="aggiungiOrdineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aggiungiOrdineModalLabel">Aggiungi Ordine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../api/receptionist/aggiungi_rifornimento.php" method="POST">
                        <div class="mb-3">
                            <label for="fornitore" class="form-label">Fornitore:</label>
                            <input list="fornitori" name="fornitore" required>
                            <datalist id="fornitori">
                                <?php
                                    foreach($fornitori as $fornitore) {
                                        $str = $fornitore['idFornitore'] . ' ' . $fornitore['nome'];
                                        echo '<option value="' . $str . '">';
                                    };
                                ?>
                            </datalist>
                        </div>
                        <button type="button" class="btn btn-success" id="aggiungiRigheMateriali" onclick="aggiungiRighe()">+</button>
                        <div class='row'>
                            <div id="materialeContainer" class="col-6">
                                <label for="materiali" class="form-label">Materiale:</label>
                            </div>
                            
                            <div id="quantitaContainer" class="col-6">
                                <label for="quantita" class="form-label">Quantità:</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Salva</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
</body>

</html>
