<?php
include_once ("connection.php");

function get_last_id_paziente($mysqli) {
    $stmt = $mysqli->prepare("SELECT max(idPaziente) FROM paziente");
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc()["max(idPaziente)"];
}

function elimina_dati_paziente($mysqli, $idPaziente) {
    $stmt = $mysqli->prepare("DELETE FROM paziente WHERE idPaziente = ?");
    $stmt->bind_param("i",$idPaziente);
    $stmt->execute();
}