<?php
require_once 'selectionController.php';

header('Content-Type: application/json');

if (isset($_POST['ID_Joueur']) && isset($_POST['ID_Match'])) {
    $idJoueur = $_POST['ID_Joueur'];
    $idMatch = $_POST['ID_Match'];
    
    $controller = new selectionController();
    $result = $controller->deleteSelectionByPlayerAndMatch($idJoueur, $idMatch);
    $controller->closeConnection();

    if ($result === true) {
        echo json_encode(['success' => true, 'message' => 'Suppression réussie.']);
    } else {
        echo json_encode(['success' => false, 'error' => 'Erreur lors de la suppression.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'ID_Joueur et ID_Match requis']);
}
?>