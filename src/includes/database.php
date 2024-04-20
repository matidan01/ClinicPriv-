<?php
include_once ("connection.php");

function get_last_id_paziente($mysqli) {
    $stmt = $mysqli->prepare("SELECT max(idPaziente) FROM paziente");
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()["max(idPaziente)"];
}

function get_last_id_terapia($mysqli) {
    $stmt = $mysqli->prepare("SELECT max(idTerapia) FROM terapia");
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()["max(idTerapia)"];
}

function get_last_id_appuntamento($mysqli) {
    $stmt = $mysqli->prepare("SELECT max(idPrestazione) FROM appuntamento");
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()["max(idPrestazione)"];
}

