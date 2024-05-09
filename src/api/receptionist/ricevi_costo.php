<?php
include_once("../../includes/connection.php");
include_once("../../includes/database.php");

// Gestisce l'invio del prezzo di una specifica tipologia di prestazione
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    echo get_costo($con, $id);
}