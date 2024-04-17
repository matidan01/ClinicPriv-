<?php
include_once("../../includes/connection.php");

/*if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
}*/

$id = isset($_GET['idPaziente']) ? mysqli_real_escape_string($con, $_GET['idPaziente']) : '';

$get_paziente = "select * from paziente where idPaziente ='$id'";
$run_paziente = mysqli_query($con,$get_paziente);
$row = mysqli_fetch_array($run_paziente);

$nome = $row['nome'];
$cognome = $row['cognome'];
$dataNascita = $row['dataNascita'];
$luogoNascita = $row['luogoNascita'];
$cf = $row['CF'];
$recapitoTelefonico = $row['recapitoTelefonico'];
$email = $row['email'];
$note = $row['note'];

$get_indirizzo_paziente = "select * from indirizzo where id ='$id' and tipo='P'";
$run_indirizzo_paziente = mysqli_query($con,$get_indirizzo_paziente);
$row_indirizzo_paziente = mysqli_fetch_array($run_indirizzo_paziente);

$via = $row_indirizzo_paziente['via'];
$citta = $row_indirizzo_paziente['città'];
$numeroCivico = $row_indirizzo_paziente['numeroCivico'];
$nazione = $row_indirizzo_paziente['nazione'];
$provincia = $row_indirizzo_paziente['provincia'];
$cap = $row_indirizzo_paziente['CAP'];

$get_appuntamenti = "select * from appuntamento where idPaziente ='$id'";
$run_appuntamenti = mysqli_query($con,$get_paziente);
$appuntamenti = mysqli_fetch_array($run_appuntamenti);

$get_id_terapia = "select * from terapia where idPaziente ='$id'";
$run_id_terapia = mysqli_query($con,$get_id_terapia);
if (mysqli_num_rows($run_id_terapia) > 0) {
    while($row = mysqli_fetch_assoc($run_id_terapia)) {
        $terapia[] = $row;
    }
} 

?>
<!DOCTYPE html>
<html lang="it">
<head>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <title><?php echo "$nome $cognome"; ?></title>
</head>
<body>
<div class="container">
        <h1 class="mt-4">Profilo Paziente</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
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
                        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#ModificaDatiAnagraficiModal">
                            Modifica Dati Anagrafici
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#aggiungiTerapiaModal">
                    Aggiungi Terapia
                </button>
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
                                    <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#ModificaDataTerapiaModal">
                                        Modifica Data Terapia
                                    </button>
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
</body>
<script>
document.getElementById('aggiungiRighe').addEventListener('click', function() {
    var container = document.getElementById('farmaciContainer');
    var row = document.createElement('div');
    row.className = 'row mb-3';
    row.innerHTML = `
        <div class="col">
            <input type="text" class="form-control" name="nomeFarmaco[]" placeholder="Nome Farmaco" required>
        </div>
        <div class="col">
            <input type="text" class="form-control" name="descrizione[]" placeholder="Descrizione">
        </div>
    `;
    container.appendChild(row);
});
</script>
</html>
