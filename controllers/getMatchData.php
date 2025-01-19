<?php
require_once 'MatchController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new MatchController();
    $match = $controller->getMatch($id);
    $controller->closeConnection();
    if ($match) {
        echo json_encode($match);
    } else {
        echo json_encode(['error' => 'Match not found']);
    }
} else {
    echo json_encode(['error' => 'ID not provided']);
}

?>