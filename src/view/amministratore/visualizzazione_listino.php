<!doctype html>
<?php
session_start();
include_once("../../includes/connection.php");
include_once("../../includes/functions.php");
include_once("../../includes/database.php");

$listino = tutto_listino($con);
?>
<html lang="en">
  <head>
    <title>Clinic Privè</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <div class="container">
        <h1 class="my-4">Visualizzazione listino</h1>

        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#aggiungiPrestazioneAListinoModal">
            Aggiungi al listino
        </button>

        <div class="modal fade" id="aggiungiPrestazioneAListinoModal" tabindex="-1" aria-labelledby="aggiungiPrestazioneAListinoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aggiungiPrestazioneAListinoLabel">Aggiungi al listino</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="../../api/amministratore/aggiungi_a_listino.php">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" class="form-control" id="nome" name="nome" maxlength="20" required>
                        </div>
                        <div class="mb-3">
                            <label for="costo" class="form-label">Costo:</label>
                            <input type="text" class="form-control" id="costo" name="costo" maxlength="20" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo:</label>
                                <select class="form-select" id="tipo" name="tipo" required>
                                    <option value="intervento_chirurgico">Intervento chirurgico</option>
                                    <option value="visita">Visita</option>
                                    <option value="esame">Esame</option>
                                </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Aggiungi al Listino</button>
                    </form>
                </div>
            </div>
            </div>
    </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Codice Prestazione</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Costo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listino as $l) {
                    echo "<td>{$l['codicePrestazione']}</td>";
                    echo "<td>{$l['nome']}</td>";
                    echo "<td>{$l['costo']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
  </body>
</html>