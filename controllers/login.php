<?php
require_once 'AccountController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomUtilisateur = $_POST['nomUtilisateur'];
    $password = $_POST['password'];

    $controller = new AccountController();
    $error = $controller->login($nomUtilisateur, $password);

    if (isset($error)) {
        echo $error;
    }
}
?>