<?php
require_once 'selectionController.php';

header('Content-Type: application/json');
ini_set('display_errors', 0);
ini_set('log_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'edit') {
    // Retrieve and sanitize POST data
    $idJoueur = isset($_POST['ID_Joueur']) ? intval($_POST['ID_Joueur']) : null;
    $idMatch = isset($_POST['ID_Match']) ? intval($_POST['ID_Match']) : null;
    $titulaire = isset($_POST['Titulaire']) ? intval($_POST['Titulaire']) : null;
    $poste = isset($_POST['Poste']) ? trim($_POST['Poste']) : '';
    $selectionId = isset($_POST['id']) ? intval($_POST['id']) : null; // Ensure you have a hidden 'id' field in your form

    if ($idJoueur && $idMatch && $selectionId !== null) {
        $controller = new selectionController();
        $result = $controller->updateSelection($selectionId, $idJoueur, $idMatch, $titulaire, $poste);
        $controller->closeConnection();

        if ($result === true) {
            echo json_encode(['success' => true, 'message' => 'Selection modifiée avec succès.']);
        } else {
            echo json_encode(['success' => false, 'error' => $result]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Données invalides fournies.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Requête non valide.']);
}
?>