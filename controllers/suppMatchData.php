<?php
require_once 'MatchController.php';

header('Content-Type: application/json'); // s'assurer que la réponse est JSON

if (isset($_GET['id'])) { // vérifier si l'ID est fourni
    $id = $_GET['id'];
    $controller = new MatchController();
    $match = $controller->deleteMatch($id);
    echo $match;
    $controller->closeConnection();
    if ($match == "date" ) {
        echo json_encode(['error' => 'La date du match est passée, vous ne pouvez pas supprimer ce match.']); // si la date du match est passée
    } else {
        echo json_encode(['message' => 'Suppression réussie.']); // si le match est supprimé avec succès
    }
} else {
    echo json_encode(['error' => 'ID not provided']); // si l'ID n'est pas fourni
}

?>