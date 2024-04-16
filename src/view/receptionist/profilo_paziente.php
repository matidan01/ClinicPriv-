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

$get_appuntamenti = "select * from appuntamento where idPaziente ='$id'";
$run_appuntamenti = mysqli_query($con,$get_paziente);
$appuntamenti = mysqli_fetch_array($run_appuntamenti);

$get_id_terapia = "select * from terapia where idPaziente ='$id'";
$run_id_terapia = mysqli_query($con,$get_id_terapia);
$id_terapia = mysqli_fetch_array($run_id_terapia);

?>
<!DOCTYPE html>
<html lang="en">
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
                        <a href="#" class="btn btn-primary">Aggiungi Appuntamento</a>
                        <a href="#" class="btn btn-success">Aggiungi Terapia</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
