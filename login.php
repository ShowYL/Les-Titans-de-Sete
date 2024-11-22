<?php
// login.php

session_start();

$valid_email = 'user@example.com';
$valid_password = '123';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === $valid_email && $password === $valid_password) {
        $_SESSION['loggedin'] = true;
        header('Location: acceuil.php');
        exit();
    } else {
        $error = 'Invalid email or password';
    }
}
?>

