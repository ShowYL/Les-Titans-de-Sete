<?php
require_once 'MatchController.php';

header('Content-Type: application/json'); // s'assurer que la réponse est JSON

if (isset($_GET['id'])) { // vérifier si l'ID est fourni
    $id = $_GET['id'];
    $controller = new MatchController();
    $match = $controller->deleteMatch($id);
    $controller->closeConnection();
    if ($match) {
        echo json_encode(['message' => 'Suppression réussie.']);
    } else {
        echo json_encode(['error' => 'Match not found']);
    }
} else {
    echo json_encode(['error' => 'ID not provided']); // si l'ID n'est pas fourni
}

?>