<?php
require_once 'JoueurController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new JoueurController();
    $player = $controller->getJoueur($id);
    $controller->closeConnection();
    if ($player) {
        echo json_encode($player);
    } else {
        echo json_encode(['error' => 'Player not found']);
    }
} else {
    echo json_encode(['error' => 'ID not provided']);
}

?>