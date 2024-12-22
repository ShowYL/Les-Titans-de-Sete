<?php
require 'JoueurController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ids'])) {
        $ids = json_decode($_POST['ids'], true);
        $controller = new JoueurController();
        foreach ($ids as $id) {
            $error = $controller->supprimerJoueur($id);
            if (isset($error)) {
                echo $error;
                exit();
            }
        }
    }
    header('Location: ../views/joueur.php');
}
?>