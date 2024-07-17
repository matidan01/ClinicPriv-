<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" type="text/css" href="../css/login.css">-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <!-- NAVIGATION BAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="#">Clinic Privè</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#gestione_appuntamenti">Gestione Appuntamenti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gestione_pazienti">Gestione Pazienti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gestione_magazzino">Gestione Magazzino</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gestione_rifornimenti">Rifornimenti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#visualizza_fornitori">Visualizza Fornitori</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- MENU' PRINCIPALE -->
    <section class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title" id="gestione_appuntamenti">Gestione Appuntamenti</h2>
                            <p class="card-text">Gestisci gli appuntamenti dei pazienti.</p>
                            <a href="gestione_appuntamenti.php" class="btn btn-primary">Vai alla gestione</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title" id="gestione_pazienti">Gestione Pazienti</h2>
                            <p class="card-text">Gestisci i dati dei pazienti.</p>
                            <a href="gestione_clienti.php" class="btn btn-primary">Vai alla gestione</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
            <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title" id="gestione_magazzino">Gestione magazzino</h2>
                            <p class="card-text">Aggiorna i dati del magazzino</p>
                            <a href="magazzino.php" class="btn btn-primary">Vai alla gestione</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title" id="gestione_rifornimenti">Rifornimenti</h2>
                            <p class="card-text">Effetua nuovi ordini e aggiorna quelli precedenti</p>
                            <a href="rifornimenti.php" class="btn btn-primary">Vai alla gestione</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">Visualizza Fornitori</h2>
                            <p class="card-text">Visualizza i dati dei fornitori.</p>
                            <a href="fornitori.php" class="btn btn-primary">Vai alla gestione</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>