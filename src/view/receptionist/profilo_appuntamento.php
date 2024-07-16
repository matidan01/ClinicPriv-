<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

// Ottiene l'id dell'appuntamento da visualizzare attraverso metodo get
$id = isset($_GET['idPrestazione']) ? mysqli_real_escape_string($con, $_GET['idPrestazione']) : '';

// Prende i valori da poter mostrare nel datalist come suggerimento di input
$sale = get_sale($con);
$medici = get_medici($con);
$operatori = get_operatori($con);

// Memorizza tutte le informazioni relative all'appuntamento
$get_appuntamento = "SELECT prestazione.idPrestazione, prestazione.codicePrestazione, 
                prestazione.idPaziente, prestazione.dataInizio, prestazione.dataFine, prestazione.ora, listino.nome,
                paziente.nome AS nome_paziente, paziente.cognome AS cognome_paziente, paziente.CF,
                GROUP_CONCAT(DISTINCT CONCAT(medico.nome, ' ', medico.cognome) SEPARATOR ', ') AS medici_coinvolti,
                GROUP_CONCAT(DISTINCT CONCAT(operatore.nome, ' ', operatore.cognome) SEPARATOR ', ') AS operatori_coinvolti,
                prestazione.sala AS numeroSala
                FROM prestazione
                INNER JOIN paziente ON prestazione.idPaziente = paziente.idPaziente
                LEFT JOIN responsabile ON prestazione.idPrestazione = responsabile.idPrestazione
                LEFT JOIN assistente ON prestazione.idPrestazione = assistente.idPrestazione
                LEFT JOIN listino ON prestazione.codicePrestazione = listino.codicePrestazione
                LEFT JOIN medico ON responsabile.nBadge = medico.nBadge
                LEFT JOIN operatore ON assistente.nBadge = operatore.nBadge
                WHERE prestazione.idPrestazione = ?
                ";

$stmt = mysqli_prepare($con, $get_appuntamento);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Appuntamento</title>
    <!-- js -->
    <script src="../../js/profilo_appuntamento.js"></script>
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
    <h1 class="mb-5">Dettagli Appuntamento</h1>
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        $appuntamento = mysqli_fetch_assoc($result);
        ?>
        <!-- Visualizzazione dettaglio appuntamento -->
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Informazioni Appuntamento</h5>
                <p><strong>Data Inizio:</strong> <?php echo $appuntamento['dataInizio']; ?></p>
                <p><strong>Data Fine:</strong> <?php echo $appuntamento['dataFine']; ?></p>
                <p><strong>Ora:</strong> <?php echo $appuntamento['ora']; ?></p>
                <p><strong>Nome Paziente:</strong> <?php echo $appuntamento['nome_paziente']; ?></p>
                <p><strong>Cognome Paziente:</strong> <?php echo $appuntamento['cognome_paziente']; ?></p>
                <p><strong>Codice Fiscale:</strong> <?php echo $appuntamento['CF']; ?></p>
                <p><strong>Nome Prestazione:</strong> <?php echo $appuntamento['nome']; ?></p>
                <p><strong>Sala:</strong> <?php echo $appuntamento['numeroSala']; ?></p>
                <p><strong>Medici:</strong> <?php echo $appuntamento['medici_coinvolti']; ?></p>
                <p><strong>Operatori:</strong> <?php echo $appuntamento['operatori_coinvolti']; ?></p>
            </div>
        </div>

        <!-- Bottone per modificare i dati dell'appuntamento riguardanti la sala, data e ora--> 
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modificaDataModal">Modifica data o sala</button>

        <!-- Bottone per modificare i dati dell'appuntamento riguardanti i medici e gli operatori coinvolti -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modificaMediciOperatoriModal">Modifica responsabili e assistenti</button>

        <!-- Bottone per pagare l'appuntamento' -->
        <button type="button" class="btn btn-primary" onclick="riceviCosto()">Paga prestazione</button>
        
        <!-- Bottone per eliminare l'appuntamento (possibile solo se non è stato pagato) -->
        <button type="button" class="btn btn-danger" onclick="deleteAppointment()">Elimina</button>

        <!-- Modal per modificare data, ora e sala -->
        <div class="modal fade" id="modificaDataModal" tabindex="-1" aria-labelledby="modificaDataModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modificaDataModalLabel">Modifica Appuntamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <form action="../../api/receptionist/modifica_appuntamento.php" method="POST">
                            <div class="modal-body">
                                <input type="text" class="form-control" id="id" name="id" value= <?php echo $id?> hidden>
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
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                                <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal per modificare medici e operatori coinvolti nella prestazione -->
        <div class="modal fade" id="modificaMediciOperatoriModal" tabindex="-1" aria-labelledby="modificaMediciOperatoriModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modificaMediciOperatoriModalLabel">Modifica Appuntamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../../api/receptionist/modifica_appuntamento.php" method="POST">
                        <div class="modal-body">
                            <input type="text" class="form-control" id="id" name="id" value= <?php echo $id?> hidden>
                            <div id="mediciContainer" class="mb-3">
                                <label for="medici" class="form-label">Medici responsabili:</label>
                                <button type="button" class="btn btn-primary" id="aggiungiRigheMedici">+</button>
                            </div>
                            
                            <div id="operatoriContainer" class="mb-3">
                                <label for="operatori" class="form-label">Operatori assistenti:</label>
                                <button type="button" class="btn btn-primary" id="aggiungiRigheOperatori">+</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                            <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
    } else {
        echo "<p>Nessun appuntamento trovato.</p>";
    }
    ?>
</div>
<script>
    // Aggiunge righe per responsabili nel form di modifica di un nuovo appuntamento
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

    // Aggiunge righe per responsabili nel form di modifica di un nuovo appuntamento
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
</body>
</html>
