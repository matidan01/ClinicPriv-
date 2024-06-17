<!doctype html>
<?php
session_start();
include_once("../../includes/connection.php");
include_once("../../includes/functions.php");
include_once("../../includes/database.php");
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
    <div class="container">
        <h1 class="my-4">Assunzione</h1>
        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#aggiungiPersonaleModal">
            Assumi Personale
        </button>
        <div class="modal fade" id="aggiungiPersonaleModal" tabindex="-1" aria-labelledby="aggiungiPersonaleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assumiPersonale">Assumi Personale</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../api/amministratore/assunzione_personale.php" method="POST">
                        <div class="mb-3">
                            <label for="ruolo" class="form-label">Ruolo</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="medico" name="ruolo" value="medico" required>
                                <label for="medico">Medico</label><br>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="opertore" name="ruolo" value="operatore" required>
                                <label for="operatore">Operatore</label><br>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" id="receptionist" name="ruolo" value="receptionist" required>
                                <label for="receptionist">Receptionist</label><br>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome" value="" required><br>
                        </div>
                        <div class="mb-3">
                            <label for="cognome" class="form-label">Cognome</label>
                            <input type="text" class="form-control" id="cognome" name="cognome" value="" required><br> 
                        </div>
                        <div class="mb-3">
                            <label for="tipologia" class="form-label">Tipologia (solo per medico e operatore)</label>
                            <input type="text" class="form-control" id="tipologia" name="tipologia" value=""><br>
                        </div>
                        <div class="mb-3">
                            <label for="CF" class="form-label">CF</label>
                            <input type="text" class="form-control" id="CF" name="CF" value="" required><br>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail aziendale</label>
                            <input type="text" class="form-control" id="email" name="email" value="" required><br>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Data di nascita</label>
                            <input type="date" id="dob" name="dob" required><br>
                        </div>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Luogo di nascita</label>
                            <input type="text" class="form-control" id="luogoNascita" name="luogoNascita" value="" required><br>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Numero di cellulare</label>
                        <input type="tel" id="phone" name="phone" value="" required><br>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text"  class="form-control" id="password" name="password" value="" required><br>
                        </div>
                        <div class="mb-3">
                            <label for="nome" class="form-label">Data inizio rapporto</label>
                            <input type="date" id="dir" name="dir" required><br>
                        </div>
                        <input type="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>