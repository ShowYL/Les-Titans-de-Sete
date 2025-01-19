<?php
require_once 'JoueurController.php';

header('Content-Type: application/json'); // s'assurer que la réponse est JSON

if (isset($_GET['id'])) { // vérifier si l'ID est fourni
    $id = $_GET['id'];
    $controller = new JoueurController();
    $result = $controller->deleteJoueur($id);
    $controller->closeConnection();

    if ($result == "present") { 
        echo json_encode(['error' => 'Joueur présent dans une sélection, vous ne pouvez pas le supprimer.']); // si le joueur est présent dans une sélection
    } else {
        echo json_encode(['message' => 'Suppression réussie.']);
    }
} else {
    echo json_encode(['error' => 'ID not provided']); // si l'ID n'est pas fourni
}
?>