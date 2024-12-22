<?php
require_once 'MatchController.php';

$controller = new MatchController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ids']) && is_array($_POST['ids'])) {
        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            $error = $controller->deleteMatch($id);
            if (isset($error)) {
                echo $error;
            }
        }
    }
}

$controller->closeConnection();

?>