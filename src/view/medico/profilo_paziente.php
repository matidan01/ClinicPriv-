<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

// Prende l'idPaziente del cliente da visualizzare attraverso un get
$nBadge = $_GET['nBadge'];
$id = $_GET['idPaziente'];


// Debugging
if (empty($id) || empty($nBadge)) {
    die("ID Paziente o Numero Badge non forniti.");
}

// Memorizza tutti i dati anagrafici del paziente
$get_paziente = "SELECT * FROM paziente WHERE idPaziente = ?";
$stmt = mysqli_prepare($con, $get_paziente);
if ($stmt === false) {
    die('Errore nella preparazione della query: ' . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if ($result === false) {
    die('Errore nell\'esecuzione della query: ' . mysqli_error($con));
}

$row = mysqli_fetch_array($result);
mysqli_free_result($result); // Libera il risultato

if (!$row) {
    die('Nessun paziente trovato con l\'ID fornito.');
}

$nome = $row['nome'];
$cognome = $row['cognome'];
$dataNascita = $row['dataNascita'];
$luogoNascita = $row['luogoNascita'];
$cf = $row['CF'];
$recapitoTelefonico = $row['recapitoTelefonico'];
$email = $row['email'];
$note = $row['note'];

// Memorizza tutti i dati relativi l'indirizzo del paziente
$get_indirizzo_paziente = "SELECT * FROM indirizzo WHERE id = ?";
$stmt = mysqli_prepare($con, $get_indirizzo_paziente);
if ($stmt === false) {
    die('Errore nella preparazione della query: ' . mysqli_error($con));
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$run_indirizzo_paziente = mysqli_stmt_get_result($stmt);
if ($run_indirizzo_paziente === false) {
    die('Errore nell\'esecuzione della query: ' . mysqli_error($con));
}

$row_indirizzo_paziente = mysqli_fetch_array($run_indirizzo_paziente);
mysqli_free_result($run_indirizzo_paziente); // Libera il risultato

if (!$row_indirizzo_paziente) {
    die('Nessun indirizzo trovato per il paziente.');
}

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
                    <p><strong>ID:</strong> <?php echo $id ?></p>
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

            <!-- Bottone per aggiungere diagnosi al paziente -->
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#aggiungiDiagnosiModal">
                Aggiungi Diagnosi
            </button>

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
                            <datalist id="farmaci">
                                        <?php foreach ($farmaci as $f): ?>
                                            <option value="<?php echo $f['nome'] . ' - ' . $f['dose']; ?>">
                                            </option>
                                        <?php endforeach; ?>
                                    </datalist>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modale per Aggiungere Diagnosi -->
            <div class="modal fade" id="aggiungiDiagnosiModal" tabindex="-1" aria-labelledby="aggiungiDiagnosiModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="aggiungiDiagnosiModalLabel">Aggiungi Diagnosi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formDiagnosi" method="POST" action="../../api/medico/aggiungi_diagnosi.php?nBadge=<?php print_r($nBadge); ?>&id=<?php print_r($id) ?>">
                                <button type="submit" class="btn btn-primary">Aggiungi Diagnosi</button>
                                <div class="row mb-3">
                                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                                    <input type="hidden" name="nBadge" id="nBadge" value="<?php echo $nBadge ?>">
                                </div>
                                <div class="col">
                                    <input list="patologie" class="form-control" id="patologia" name="patologia" required>
                                    <datalist id="patologie">
                                        <?php foreach ($patologie as $p): ?>
                                            <option value="<?php echo $p['idPatologia'] . ' - ' . $p['nomePatologia']; ?>">
                                            </option>
                                        <?php endforeach; ?>
                                    </datalist>
                                </div>
                                <div class="col">
                                    <label for="descrizione" class="form-label">Dettagli:</label>
                                    <input type="text" class="form-control" id="descrizione" name="descrizione">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

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

            <!-- Visualizza le diagnosi del paziente -->
            <?php if (!empty($diagnosi)): ?>
                <div class="row p-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Diagnosi del Paziente</h5>
                            <?php foreach ($diagnosi as $d): ?>
                                <div class="mb-3 p-1 border">
                                    <p><strong>Patologia:</strong> <?php echo $d['nomePatologia'] ?></p>
                                    <p><strong>Dettagli:</strong> <?php echo $d['descrizione'] ?></p>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p>Nessuna diagnosi trovata per questo paziente.</p>
            <?php endif ?>
</div>
</body>
</html>
