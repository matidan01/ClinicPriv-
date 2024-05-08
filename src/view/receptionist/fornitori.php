<?php
include_once("../../includes/connection.php");
$fornitori = [];
$query = "SELECT *
            FROM fornitore
        ";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $fornitori[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazzino Clinica</title>
    <!-- css -->
    <link rel="stylesheet" href="../../css/righeTabella.css">
    <!-- Link per Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link per Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <h1>fornitori</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID Fornitore</th>
                <th scope="col">Nome</th>
                <th scope="col">Recapito Telefonico</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($fornitori as $fornitore) {
                    echo "<tr class='clickable-row'>";
                    echo "<td>{$fornitore['idFornitore']}</td>";
                    echo "<td>{$fornitore['nome']}</td>";
                    echo "<td>{$fornitore['recapitoTelefonico']}</td>";
                    echo "<td>{$fornitore['email']} $</td>";
                    echo "</tr>";
                }
                ?>
        </tbody>
    </table>
</div>

</body>
</html>
