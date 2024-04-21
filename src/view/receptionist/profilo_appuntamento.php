<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");
/*if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
}*/

$id = isset($_GET['idPrestazione']) ? mysqli_real_escape_string($con, $_GET['idPrestazione']) : '';
$sale = get_sale($con);
$medici = get_medici($con);
$operatori = get_operatori($con);

$get_appuntamento = "SELECT appuntamento.idPrestazione, appuntamento.codicePrestazione, 
                appuntamento.idPaziente, appuntamento.dataInizio, appuntamento.dataFine, appuntamento.ora, listino.nome,
                paziente.nome AS nome_paziente, paziente.cognome AS cognome_paziente, paziente.CF,
                GROUP_CONCAT(DISTINCT CONCAT(medico.nome, ' ', medico.cognome) SEPARATOR ', ') AS medici_coinvolti,
                GROUP_CONCAT(DISTINCT CONCAT(operatore.nome, ' ', operatore.cognome) SEPARATOR ', ') AS operatori_coinvolti,
                ospita.numeroSala
                FROM appuntamento
                INNER JOIN paziente ON appuntamento.idPaziente = paziente.idPaziente
                LEFT JOIN responsabile ON appuntamento.idPrestazione = responsabile.idPrestazione
                LEFT JOIN assistente ON appuntamento.idPrestazione = assistente.idPrestazione
                LEFT JOIN listino ON appuntamento.codicePrestazione = listino.codicePrestazione
                LEFT JOIN medico ON responsabile.nBadge = medico.nBadge
                LEFT JOIN operatore ON assistente.nBadge = operatore.nBadge
                LEFT JOIN ospita ON appuntamento.idPrestazione = ospita.idPrestazione
                WHERE appuntamento.idPrestazione = ?
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

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modificaDataModal">Modifica data o sala</button>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modificaMediciOperatoriModal">Modifica responsabili e assistenti</button>

        <button type="button" class="btn btn-primary" onclick="pagaPrestazione()">Paga prestazione</button>

        <button type="button" class="btn btn-danger" onclick="confirmDelete()">Elimina</button>

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

        
        <div class="alert alert-danger mt-3" role="alert" id="deleteAlert" style="display: none;">
            <form action='' method='POST'>
                Sei sicuro di voler eliminare questo appuntamento?
                <button type="button" class="btn btn-danger" onclick="deleteAppointment()">Elimina</button>
                <button type="button" class="btn btn-secondary" onclick="cancelDelete()">Annulla</button>
            </form>
        </div>

        <?php
    } else {
        echo "<p>Nessun appuntamento trovato.</p>";
    }
    ?>

</div>

<script>
    function confirmDelete() {
        document.getElementById('deleteAlert').style.display = 'block';
    }

    function cancelDelete() {
        document.getElementById('deleteAlert').style.display = 'none';
    }

    function pagaPrestazione() {
        window.confirm('Conferma il pagamento?');
        let data = new FormData();
        data.append('id', document.getElementById('id').value);
        axios.post('../../api/receptionist/pagamento_appuntamento.php', data)
        .then(function (response) {
            if(response.data == 'OK') {
                alert('Pagamento effettuato!');
            } else {
                alert('Mi dispiace, qualcosa è andato storto!');
            }
        })
        .catch(function (error) {
            console.error(error);
        });
       
    }

    function deleteAppointment() {
        let data = new FormData();
        data.append('id', document.getElementById('id').value);
        axios.post('../../api/receptionist/elimina_appuntamento.php', data)
        .then(function (response) {
            if(response.data == 'OK') {
                alert('Cancellazione effettuata!');
                window.location.href = "gestione_appuntamenti.php";
            } else {
                alert('Appuntamento già pagato non si può cancellare');
            }
        })
        .catch(function (error) {
            console.error(error);
        });
        

    }

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
