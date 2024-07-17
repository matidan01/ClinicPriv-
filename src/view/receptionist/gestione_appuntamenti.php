<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

$appuntamenti = [];

// Prende i valori da poter mostrare nel datalist come suggerimento di input
$pazienti = get_pazienti($con);
$medici = get_medici($con);
$operatori = get_operatori($con);
$prestazioni = get_nomi_prestazioni($con);
$sale = get_sale($con);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['data'])) {
        $data = $_POST['data'];
        $query = "SELECT * FROM vista_appuntamenti WHERE DATE(dataInizio) = ? ORDER BY ora ASC";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "s", $data);
    } else {
        $query = "SELECT * FROM vista_appuntamenti WHERE DATE(dataInizio) >= CURDATE() ORDER BY ora ASC";
        $stmt = mysqli_prepare($con, $query);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $appuntamenti[] = $row;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Appuntamenti</title>
    <!-- css -->
    <link rel="stylesheet" href="../../css/righeTabella.css">
    <!-- js -->
    <script src="../../js/gestione_appuntamenti.js"></script>
    <!-- Link per Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link per Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container py-5">
        <h1 class="mb-5">Gestione Appuntamenti</h1>

        <!-- Form per visualizzare appuntamenti di un determinato giorno -->
        <form action="" method="post" class="mb-3">
            <div class="row g-3">
                <div class="col-auto">
                    <label for="data" class="col-form-label">Seleziona una data:</label>
                </div>
                <div class="col-auto">
                    <input type="date" id="data" name="data" class="form-control">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Mostra Appuntamenti</button>
                </div>
            </div>
        </form>

        <!-- Form per visualizzare appuntamenti dal giorno corrente in poi -->
        <form action="" method="post" class="mb-3">
            <button type="submit" class="btn btn-secondary">Mostra Tutti gli Appuntamenti</button>
        </form>

        <!-- Bottone per aggiungere un nuovo appuntamento -->
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#aggiungiModal">Aggiungi Appuntamento</button>
        
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

    <!-- Modal Aggiungi Appuntamento -->
    <div class="modal fade" id="aggiungiModal" tabindex="-1" aria-labelledby="aggiungiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aggiungiModalLabel">Aggiungi Appuntamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form per aggiungere un nuovo appuntamento -->
                    <form action="../../api/receptionist/aggiungi_appuntamento.php" method="POST">
                        <div class="mb-3">
                            <label for="pazienti" class="form-label">Cliente:</label>
                            <input list="pazienti" name="pazienti" required>
                            <datalist id="pazienti">
                                <?php
                                    foreach($pazienti as $paziente) {
                                        $str = $paziente['idPaziente'] . ' ' . $paziente['nome'] . ' ' . $paziente['cognome'] . ' ' . $paziente['CF'];
                                        echo '<option value="' . $str . '">';
                                    };
                                ?>
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label for="dataInizio" class="form-label">Data Inizio</label>
                            <input type="date" class="form-control" id="dataInizio" name="dataInizio" required>
                        </div>
                        <div class="mb-3">
                            <label for="dataFine" class="form-label">Data Fine</label>
                            <input type="date" class="form-control" id="dataFine" name="dataFine">
                        </div>
                        <div class="mb-3">
                            <label for="ora" class="form-label">Ora</label>
                            <input type="time" class="form-control" id="ora" name="ora" required>
                        </div>
                        <div class="mb-3">
                            <label for="sala" class="form-label">Sala:</label>
                            <input list="sala" name="sala" required>
                            <datalist id="sala">
                                <?php
                                    foreach($sale as $sala) {
                                        $str = $sala['numero'] . ' ' . $sala['tipo'];
                                        echo '<option value="' . $str . '">';
                                    };
                                ?>
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo prestazione:</label>
                            <input list="tipo" name="tipo" required>
                            <datalist id="tipo">
                                <?php
                                    foreach($prestazioni as $prestazione) {
                                        $str = $prestazione['codicePrestazione'] . ' ' . $prestazione['nome'];
                                        echo '<option value="' . $str . '">';
                                    };
                                ?>
                            </datalist>
                        </div>
                        <div id="mediciContainer" class="mb-3">
                            <label for="medici" class="form-label">Medici responsabili:</label>

                            <!-- Bottone per aggiungere medici coinvolti nella prestazione -->
                            <button type="button" class="btn btn-primary" id="aggiungiRigheMedici">+</button>
                        </div>
                        
                        <div id="operatoriContainer" class="mb-3">
                             <label for="operatori" class="form-label">Operatori assistenti:</label>

                             <!-- Bottone per aggiungere operatori sanitari coinvolti nella prestazione -->
                             <button type="button" class="btn btn-primary" id="aggiungiRigheOperatori">+</button>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Salva</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
<script>
    // Aggiunge righe per responsabili nel form di inserimento di un nuovo appuntamento  
    document.getElementById('aggiungiRigheMedici').addEventListener('click', function() {
        var container = document.getElementById('mediciContainer');
        var row = document.createElement('div');
        row.className = 'mb-3';
        row.innerHTML = `
                <input list="medici" name="medici[]">
                <datalist id="medici">
                    <?php
                        foreach($medici as $medico) {
                            $str = $medico['nBadge'] . ' ' . $medico['nome'] . ' ' . $medico['cognome'];
                            echo '<option value="' . $str . '">';
                        };
                    ?>
                </datalist>
        `;
        container.appendChild(row);
    });

    // Aggiunge righe per assistenti nel form di inserimento di un nuovo appuntamento 
    document.getElementById('aggiungiRigheOperatori').addEventListener('click', function() {
        var container = document.getElementById('operatoriContainer');
        var row = document.createElement('div');
        row.className = 'mb-3';
        row.innerHTML = `
                <input list="operatori" name="operatori[]">
                <datalist id="operatori">
                    <?php
                        foreach($operatori as $operatore) {
                            $str = $operatore['nBadge'] . ' ' . $operatore['nome'] . ' ' . $operatore['cognome'];
                            echo '<option value="' . $str . '">';
                        };
                    ?>
                </datalist>
        `;
        container.appendChild(row);
    });

</script>
</html>
