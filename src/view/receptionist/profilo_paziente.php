<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

// DA VEDERE PER ACCEDERE SOLO SE HAI LA SESSIONE DA RECEPTIONIST
/*if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
}*/

// Prende l'idPaziente del cliente da visualizzare attraverso un get
$id = isset($_GET['idPaziente']) ? mysqli_real_escape_string($con, $_GET['idPaziente']) : '';

// Memorizza tutti i dati anagrafici del paziente
$get_paziente = "select * from paziente where idPaziente = ?";
$stmt = mysqli_prepare($con, $get_paziente);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_array($result);

$nome = $row['nome'];
$cognome = $row['cognome'];
$dataNascita = $row['dataNascita'];
$luogoNascita = $row['luogoNascita'];
$cf = $row['CF'];
$recapitoTelefonico = $row['recapitoTelefonico'];
$email = $row['email'];
$note = $row['note'];

// Memorizza tutti i dati relativi l'indirizzo del paziente
$get_indirizzo_paziente = "select * from indirizzo where id = ?";
$stmt = mysqli_prepare($con, $get_indirizzo_paziente);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$run_indirizzo_paziente = mysqli_stmt_get_result($stmt);
$row_indirizzo_paziente = mysqli_fetch_array($run_indirizzo_paziente);

$via = $row_indirizzo_paziente['via'];
$citta = $row_indirizzo_paziente['città'];
$numeroCivico = $row_indirizzo_paziente['numeroCivico'];
$nazione = $row_indirizzo_paziente['nazione'];
$provincia = $row_indirizzo_paziente['provincia'];
$cap = $row_indirizzo_paziente['CAP'];

// Memorizza tutte le diagnosi del paziente
$get_diagnosi = "SELECT d.idPaziente, d.descrizione, p.nomePatologia 
                FROM diagnosi d 
                JOIN patologia p ON d.idPatologia = p.idPatologia
                WHERE d.idPaziente = ?";
$stmt = mysqli_prepare($con, $get_diagnosi);
if ($stmt === false) {
    die('Errore nella preparazione della query: ' . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$diagn = mysqli_stmt_get_result($stmt);

$diagnosi = [];
if ($diagn === false) {
    die('Errore nell\'esecuzione della query: ' . mysqli_error($con));
}

if (mysqli_num_rows($diagn) > 0) {
    while($row = mysqli_fetch_assoc($diagn)) {
        $diagnosi[] = $row;
    }
}
mysqli_free_result($diagn); // Libera il risultato

// Memorizza tutte le terapie del paziente
$get_id_terapia = "SELECT * FROM terapia WHERE idPaziente = ?";
$stmt = mysqli_prepare($con, $get_id_terapia);
if ($stmt === false) {
    die('Errore nella preparazione della query: ' . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$terapia = [];
if ($result === false) {
    die('Errore nell\'esecuzione della query: ' . mysqli_error($con));
}

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $terapia[] = $row;
    }
}
mysqli_free_result($result); // Libera il risultato

// Memorizza tutte le patologie disponibili
$get_patologie = "SELECT idPatologia, nomePatologia FROM patologia";
$result_patologie = mysqli_query($con, $get_patologie);
if ($result_patologie === false) {
    die('Errore nell\'esecuzione della query: ' . mysqli_error($con));
}

$patologie = [];
if (mysqli_num_rows($result_patologie) > 0) {
    while ($row = mysqli_fetch_assoc($result_patologie)) {
        $patologie[] = $row;
    }
}
mysqli_free_result($result_patologie); // Libera il risultato

// Memorizza tutti i dati relativi gli appuntamenti del paziente da pagare
$prestazioni_da_pagare = get_appuntamenti_non_pagati($con, $id);

$farmaci = get_farmaci($con);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- js -->
    <script src="../../js/profilo_paziente.js"></script>
     <!-- Link per Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link per Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- Link per Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <title><?php echo "$nome $cognome"; ?></title>
</head>
<body>
<div class="container">
        <h1 class="mt-4">Profilo Paziente</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Visualizza tutti i dati del paziente -->
                        <h5 class="card-title">Informazioni Paziente</h5>
                        <p><strong>ID:</strong><?php echo $id ?></p>
                        <p><strong>Nome:</strong> <?php echo $nome ?></p>
                        <p><strong>Cognome:</strong> <?php echo $cognome ?></p>
                        <p><strong>Codice Fiscale:</strong> <?php echo $cf ?></p>
                        <p><strong>Email:</strong> <?php echo $email ?></p>
                        <p><strong>Recapito Telefonico:</strong> <?php echo $recapitoTelefonico ?></p>
                        <p><strong>Data di Nascita:</strong> <?php echo $dataNascita ?></p>
                        <p><strong>Luogo di Nascita:</strong> <?php echo $luogoNascita ?></p>
                        <p><strong>Note:</strong> <?php echo $note ?></p>
                        <p><strong>Indirizzo:</strong> Via <?php echo $via . " " . $numeroCivico . ", " . $citta . " " . $cap . " (" . $provincia . "), " . $nazione ?> </p>

                        <!-- Bottone per modificare i dati del paziente -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modificaClienteModal">
                            Modifica Dati Anagrafici
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Bottone per aggiungere la terapia al paziente -->
                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#aggiungiTerapiaModal">
                    Aggiungi Terapia
                </button>

                <!-- Visualizza i dati sulle terapie del paziente--> 
                <?php if (!empty($terapia)): ?>
                    <?php foreach ($terapia as $t): ?>
                        <?php 
                            $id_terapia = $t['idTerapia'];
                            $get_farmaci = "SELECT * FROM prescrizione WHERE idTerapia = '$id_terapia'";
                            $run_farmaci = mysqli_query($con, $get_farmaci);
                            $farmaci = array(); 
                            if (mysqli_num_rows($run_farmaci) > 0) {
                                while($row = mysqli_fetch_assoc($run_farmaci)) {
                                    $farmaci[] = $row;
                                }
                            }
                        ?>
                        <div class="row mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Terapia <?php echo $id_terapia?></h5>
                                    <p><strong>Data di scadenza:</strong><?php echo $t['dataScadenza'] ?></p>
                                    <p><strong>Medico:</strong> <?php echo $t['idMedico'] ?></p>
                                    <?php if (!empty($farmaci)): ?>
                                        <?php foreach ($farmaci as $f): ?>
                                            <p><strong>Farmaco:</strong><?php echo $f['nomeFarmaco'] ?></p>
                                            <strong>Descrizione:</strong> <?php echo $f['descrizione'] ?></p>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <p>Nessuna terapia trovata per questo paziente.</p>
                <?php endif ?>
            </div>
        </div>
    </div>

    <!-- Bottone per visualizzare gli appuntamenti di pagare -->
    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#pagamentoModal">Paga prestazione</button>

    <!-- Modale per Aggiungere Terapia -->
    <div class="modal fade" id="aggiungiTerapiaModal" tabindex="-1" aria-labelledby="aggiungiTerapiaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="aggiungiTerapiaModalLabel">Aggiungi Terapia</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formTerapia" method="POST" action="../../api/medico/aggiungi_terapia.php?nBadge=<?php echo $nBadge ?>">
                                <button type="submit" class="btn btn-primary">Aggiungi Terapia</button>
                                <div class="row mb-3">
                                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                                    <div class="col">
                                        <label for="dataScadenza" class="form-label">Data Scadenza:</label>
                                        <input type="date" class="form-control" id="dataScadenza" name="dataScadenza" required>
                                    </div>
                                    <div class="col">
                                        <label for="idMedico" class="form-label">Numero Badge Medico:</label>
                                        <input type="text" class="form-control" id="idMedico" name="idMedico">
                                    </div>
                                </div>
                                <p>Farmaci:</p>
                                <div id="farmaciContainer"></div>
                            </form>
                            <!-- Bottone "+" per aggiungere righe -->
                            <button type="button" class="btn btn-primary" id="aggiungiRighe">+</button>
                        </div>
                    </div>
                </div>
            </div>

            
    <!-- Modale per pagare prestazioni -->
    <div class="modal fade" id="pagamentoModal" tabindex="-1" aria-labelledby="pagamentoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pagamentoModalLabel">Pagamento delle Prestazioni</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formPagamento" method="POST">
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome Prestazione</th>
                                        <th scope="col">Data Esecuzione</th>
                                        <th scope="col">Costo</th>
                                        <th scope="col">Pagamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($prestazioni_da_pagare as $index => $p): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo $p['nome']; ?></td>
                                            <td><?php echo $p['dataInizio']; ?></td>
                                            <td>$<?php echo $p['costo']; ?></td>
                                            <td>
                                                <input type="checkbox" id="<?php echo $p['idPrestazione']; ?>" name="prestazioni[]" value="<?php echo $p['costo']; ?>" onchange="aggiornaTotale()">
                                                <label for="<?php echo 'prestazione_' . $p['idPrestazione']; ?>"></label>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- Visualizza il totale degli appuntamenti selezionate-->
                        <p>Totale: <span id="totale">$0.00</span></p>

                        <button type="button" class="btn btn-primary" onclick="inviaPrestazioniSelezionate()">Esegui pagamento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- Modale per Modificare Cliente -->
    <div class="modal fade" id="modificaClienteModal" tabindex="-1" aria-labelledby="modificaClienteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modificaClienteModalLabel">Modifica Dati Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../api/receptionist/aggiungi_cliente.php">
                        <input type="hidden" id="modifica" name="modifica" value="<?php echo $id; ?>">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" maxlength="20" value="<?php echo $nome?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="cognome" class="form-label">Cognome:</label>
                            <input type="text" class="form-control" id="cognome" name="cognome" maxlength="20" value="<?php echo $cognome?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="cf" class="form-label">Codice Fiscale:</label>
                            <input type="text" class="form-control" id="cf" value="<?php echo $cf?>" name="cf">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="data_nascita" class="form-label">Data di Nascita:</label>
                            <input type="date" class="form-control" id="data_nascita" name="data_nascita" value="<?php echo $dataNascita?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="luogo_nascita" class="form-label">Luogo di Nascita:</label>
                            <input type="text" class="form-control" id="luogo_nascita" name="luogo_nascita" value="<?php echo $luogoNascita?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Recapito Telefonico:</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $recapitoTelefonico?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note:</label>
                            <textarea class="form-control" id="note" name="note" rows="3" value="<?php echo $note?>"></textarea>
                        </div>
                        <p>Indirizzo:</p>
                        <div class="mb-3">
                            <label for="via" class="form-label">Via:</label>
                            <input type="text" class="form-control" id="via" name="via" value="<?php echo $via?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="numeroCivico" class="form-label">Numero Civico:</label>
                            <input type="number" class="form-control" id="numeroCivico" name="numeroCivico" value="<?php echo $numeroCivico?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="citta" class="form-label">Città:</label>
                            <input type="text" class="form-control" id="citta" name="citta" value="<?php echo $citta?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="cap" class="form-label">CAP:</label>
                            <input type="number" class="form-control" id="cap" name="cap" value="<?php echo $cap?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="provincia" class="form-label">Provincia:</label>
                            <input type="text" class="form-control" id="provincia" name="provincia" maxlength="2" value="<?php echo $provincia?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nazione" class="form-label">Nazione:</label>
                            <input type="text" class="form-control" id="nazione" name="nazione" value="<?php echo $nazione?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Modifica Cliente</button>
                    </form>
            </div>
        </div>
    </div>
    </div>

     <!-- Modale per Aggiungere Terapia -->
     <div class="modal fade" id="aggiungiTerapiaModal" tabindex="-1" aria-labelledby="aggiungiTerapiaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aggiungiTerapiaModalLabel">Aggiungi Terapia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formTerapia" method="POST" action="../../api/receptionist/aggiungi_terapia.php">
                        <button type="submit" class="btn btn-primary">Aggiungi Terapia</button>
                        <div class="row mb-3">
                            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                            <div class="col">
                                <label for="dataScadenza" class="form-label">Data Scadenza:</label>
                                <input type="date" class="form-control" id="dataScadenza" name="dataScadenza" required>
                            </div>
                        </div>
                        <p>Farmaci:</p>
                        <div id="farmaciContainer"></div>
                        <datalist id="farmaci">
                            <?php
                                foreach($farm as $farmaco) {
                                    $str = $farmaco['nome'] . ' ' . $farmaco['dose'];
                                    echo '<option value="' . $str . '">';
                                };
                            ?>
                        </datalist>
                    </form>
                    <!-- Bottone "+" per aggiungere righe -->
                    <button type="button" class="btn btn-primary" id="aggiungiRighe">+</button>
            </div>
        </div>
    </div>

</body>
</html>
