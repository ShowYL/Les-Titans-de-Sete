<?php
require_once 'selectionController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new selectionController();
    $selection = $controller->getSelection($id);
    $controller->closeConnection();
    if ($selection) {
        echo json_encode($selection);
    } else {
        echo json_encode(['error' => 'Selection not found']);
    }
} else {
    echo json_encode(['error' => 'ID not provided']);
}
?>