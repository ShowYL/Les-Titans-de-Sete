<?php
require_once 'AccountController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomUtilisateur = $_POST['nomUtilisateur'];
    $password = $_POST['password'];

    $accountController = new AccountController();
    $error = $accountController->login($nomUtilisateur, $password);

    if (isset($error)) {
        header('Location: ../views/login.php');
        exit();
    }
}
?>