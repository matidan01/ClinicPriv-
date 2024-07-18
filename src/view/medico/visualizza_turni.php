<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

$turni = [];
$nBadge = $_GET['nBadge'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['mese'])) {
        $mese = date("m", strtotime($_POST['mese']));
        $anno = date("Y", strtotime($_POST['mese']));
        $turni = get_turni_medico($con, $nBadge, $mese, $anno);
    } else {
        // Se non viene selezionata una data, visualizza i turni del mese corrente
        $mese = date("m");
        $anno = date("Y");
        $turni = get_turni_medico($con, $nBadge, $mese, $anno);
    }
} else {
    // Se la richiesta non è POST, visualizza i turni del mese corrente
    $mese = date("m");
    $anno = date("Y");
    $turni = get_turni_medico($con, $nBadge, $mese, $anno);
}
function generate_calendar($mese, $anno, $turni) {
    $daysInMonth = date("t", strtotime("$anno-$mese-01"));
    $firstDayOfMonth = date("N", strtotime("$anno-$mese-01")); // 1 (Lun) - 7 (Dom)

    // Header del calendario
    $calendar = '<table class="table table-bordered"><thead><tr>';
    $daysOfWeek = ['Lun', 'Mar', 'Mer', 'Gio', 'Ven', 'Sab', 'Dom'];
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th>$day</th>";
    }
    $calendar .= '</tr></thead><tbody><tr>';

    // Riempie i giorni vuoti prima dell'inizio del mese
    for ($i = 1; $i < $firstDayOfMonth; $i++) {
        $calendar .= '<td></td>';
    }

    // Riempie i giorni del mese
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $date = sprintf("%04d-%02d-%02d", $anno, $mese, $day);
        $turniPerGiorno = array_filter($turni, function($turno) use ($date) {
            return $turno['data'] == $date;
        });

        // Separa i turni per tipo di turno (Mattina, Pomeriggio, Notte)
        $mattinaTurni = [];
        $pomeriggioTurni = [];
        $notteTurni = [];

        foreach ($turniPerGiorno as $turno) {
            switch ($turno['tipoTurno']) {
                case 'M':
                    $mattinaTurni[] = $turno;
                    break;
                case 'P':
                    $pomeriggioTurni[] = $turno;
                    break;
                case 'N':
                    $notteTurni[] = $turno;
                    break;
                default:
                    // Gestione per altri tipi di turno se necessario
                    break;
            }
        }

        // Costruisci la cella del giorno con i turni ordinati per tipo
        $calendar .= '<td>';
        $calendar .= "<strong>$day</strong><br>";

        // Aggiungi prima i turni di Mattina, poi Pomeriggio e infine Notte
        foreach ($mattinaTurni as $turno) {
            $calendar .= htmlspecialchars($turno['nome'] . ' ' . $turno['cognome']) . "<br>Mattina<br>";
        }
        foreach ($pomeriggioTurni as $turno) {
            $calendar .= htmlspecialchars($turno['nome'] . ' ' . $turno['cognome']) . "<br>Pomeriggio<br>";
        }
        foreach ($notteTurni as $turno) {
            $calendar .= htmlspecialchars($turno['nome'] . ' ' . $turno['cognome']) . "<br>Notte<br>";
        }

        $calendar .= '</td>';

        // Nuova riga ogni 7 giorni
        if (($day + $firstDayOfMonth - 1) % 7 == 0) {
            $calendar .= '</tr><tr>';
        }
    }

    // Riempie i giorni vuoti alla fine del mese
    while (($day + $firstDayOfMonth - 1) % 7 != 0) {
        $calendar .= '<td></td>';
        $day++;
    }

    $calendar .= '</tr></tbody></table>';
    return $calendar;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizza Turni</title>
    <!-- css -->
    <link rel="stylesheet" href="../../css/righeTabella.css">
    <!-- js -->
    <script src="../../js/gestione_appuntamenti.js"></script>
    <!-- Link per Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link per Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: center;
            padding: 10px;
        }
        th {
            background-color: #f8f9fa;
        }
        td {
            border: 1px solid #dee2e6;
            vertical-align: top;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="mb-5">Visualizza Turni</h1>

        <!-- Form per visualizzare turni di un determinato mese -->
        <form action="" method="post" class="mb-3">
            <div class="row g-3">
                <div class="col-auto">
                    <label for="mese" class="col-form-label">Seleziona un mese:</label>
                </div>
                <div class="col-auto">
                    <input type="month" id="mese" name="mese" class="form-control">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Visualizza Turni</button>
                </div>
            </div>
        </form>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Turni del Mese</h5>
            </div>
            <div class="card-body">
                <?php echo generate_calendar($mese, $anno, $turni); ?>
            </div>
        </div>
    </div>
</body>
</html>
