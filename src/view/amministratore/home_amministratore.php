<!doctype html>
<?php
session_start();
include_once("../../includes/connection.php");
include_once("../../includes/functions.php");
?>
<html lang="en">
  <head>
    <title>Clinic Privè</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" type="text/css" href="../css/index.css">-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
  <nav class='navbar navbar-expand-lg navbar-dark bg-secondary'>
    <div class='container'>
        <div class='collapse navbar-collapse' id='navbarNav'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item'>
                    <a class='nav-link' href='#assunzione-personale'>Assunzione personale</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#termine-contratto-con-personale'>Termine contratto con personale</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#visualizzazione-dati-fatturato'>Visualizzazione dati fatturato</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#visualizzazione-dati-interventi'>Visualizzazione dati interventi</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#visualizzazione-grafico-fatture'>Visualizzazione grafico fatture</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#visualizzazione-dati-personale'>Visualizzazione dati personale</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<section class='py-4'>
    <div class='container'>
        <div class='row'>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h2 class='card-title'>Assunzione personale</h2>
                        <p class='card-text'>Gestisci l'assunzione del personale.</p>
                        <a href='assunzione_personale.php' class='btn btn-primary'>Vai alla gestione</a>
                    </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h2 class='card-title'>Termine contratto con personale</h2>
                        <p class='card-text'>Gestisci il termine di un contratto col personale.</p>
                        <a href='termina_contratto.php' class='btn btn-primary'>Vai alla gestione</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='row mt-4'>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h2 class='card-title'>Visualizzazione dati fatturato</h2>
                        <p class='card-text'>Visualizza i dati di fatturato.</p>
                        <a href='visualizzazione_fatturato.php' class='btn btn-primary'>Vai alla visualizzazione</a>
                    </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h2 class='card-title'>Visualizzazione dati interventi</h2>
                        <p class='card-text'>Visualizza i dati degli interventi</p>
                        <a href='visualizza_interventi.php' class='btn btn-primary'>Vai alla visualizzazione</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='row mt-4'>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h2 class='card-title'>Visualizzazione grafico fatture</h2>
                        <p class='card-text'>Visualizza il grafico delle fatture</p>
                        <a href='visualizzazione_grafico_fatture.php' class='btn btn-primary'>Vai alla visualizzazione</a>
                    </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h2 class='card-title'>Visualizzazione dati personale</h2>
                        <p class='card-text'>Visualizza i dati del personale.</p>
                        <a href='visualizzazione_dati_personale.php' class='btn btn-primary'>Vai alla visualizzazione</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='row mt-4'>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h2 class='card-title'>Visualizzazione fatturato paziente</h2>
                        <p class='card-text'>Visualizza il fatturato medio e totale relativo ad un pazientepaziente</p>
                        <a href='visualizzazione_fatturato_paziente.php' class='btn btn-primary'>Vai alla visualizzazione</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
</body>
</html>