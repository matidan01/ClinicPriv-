<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");


// Prende l'idPaziente del cliente da visualizzare attraverso un get
$id = isset($_GET['idPaziente']) ? mysqli_real_escape_string($con, $_GET['idPaziente']) : '';
$nBadge = $_GET['nBadge'];

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
$get_indirizzo_paziente = "select * from indirizzo where id ='$id' and tipo='P'";
$run_indirizzo_paziente = mysqli_query($con,$get_indirizzo_paziente);
$row_indirizzo_paziente = mysqli_fetch_array($run_indirizzo_paziente);

$via = $row_indirizzo_paziente['via'];
$citta = $row_indirizzo_paziente['città'];
$numeroCivico = $row_indirizzo_paziente['numeroCivico'];
$nazione = $row_indirizzo_paziente['nazione'];
$provincia = $row_indirizzo_paziente['provincia'];
$cap = $row_indirizzo_paziente['CAP'];

$get_diagniosi = "select * from diagnosi where idPaziente = ?";
$stmt = mysqli_prepare($con, $get_diagniosi);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$resultD = mysqli_stmt_get_result($stmt);

$get_patologia = "select p.* from patologia p where idPaziente = ? and p.nomePatologia not in (select d.nomePatologia
                        from diagnosi d
                        where d.idPaziente = ?)";
$stmt = mysqli_prepare($con, $get_patologia);
mysqli_stmt_bind_param($stmt, "ii", $id, $id);
mysqli_stmt_execute($stmt);
$resultP = mysqli_stmt_get_result($stmt);

// Memorizza tutti i dati relativi la terapia del paziente
$get_id_terapia = "select * from terapia where idPaziente = ?";
$stmt = mysqli_prepare($con, $get_id_terapia);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $terapia[] = $row;
    }
} 






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
                    </div>
                </div>
            </div>
            <div class="col-md-3">
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
            <div class="col-md-3">
                <!-- Visualizza i dati sulle diagnosi del paziente--> 
                <?php if (!empty($resultD)): ?>
                    <?php foreach ($resultD as $d): ?>
                        <div class="row mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Diagnosi:</h5>
                                    <p><strong><?php echo $d['nomePatologia'] ?></strong></p>
                                    <p><strong>Medico:</strong> <?php echo $d['idMedico'] ?></p>
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


</body>
</html>
