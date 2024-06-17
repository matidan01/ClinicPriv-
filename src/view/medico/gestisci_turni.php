<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Turni</title>
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
    <h1 class="mb-5">Gestione Turni</h1>
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Aggiungi o Modifica turno</h5>
                    </div>
                    <div class="card-body">
                        <form id="shift-form">
                            <input type="hidden" id="shift-index">
                            <div class="mb-3">
                                <label for="date" class="form-label">Data:</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="start-time" class="form-label">Medico:</label>
                                <input type="time" class="form-control" id="start-time" name="start-time" required>
                            </div>
                            <div class="mb-3">
                                <label for="end-time" class="form-label">Turno:</label>
                                <input type="time" class="form-control" id="end-time" name="end-time" required>
                            </div>
                            <button type="submit" class="btn btn-primary" id="add-shift-btn">Aggiungi Turno</button>
                            <button type="button" class="btn btn-danger" id="cancel-shift-btn" style="display: none;">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Turni</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead> <h5>Data</h5>
                                <tr>
                                    <th>Numero Badge</th>
                                    <th>Medico</th>
                                    <th>Turno</th>
                                </tr>
                            </thead>
                            <tbody id="shift-list"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
</html>
