<?php
require_once 'selectionController.php';

header('Content-Type: application/json');
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['joueurId']) && isset($_GET['matchId'])) {
    $joueurId = $_GET['joueurId'];
    $matchId = $_GET['matchId'];

    $controller = new selectionController();
    $selection = $controller->getSelectionByPlayerAndMatch($joueurId, $matchId);
    $controller->closeConnection();

    if ($selection) {
        echo json_encode($selection);
    } else {
        echo json_encode(['error' => 'Selection not found']);
    }
} else {
    echo json_encode(['error' => 'JoueurId and MatchId are required']);
}
?>