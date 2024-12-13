<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Démarrer la session

// $valid_email = 'user@example.com';
// $valid_password = '123';

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $email = $_POST['nomUtilisateur'];
//     $password = $_POST['password'];

//     if ($email === $valid_email && $password === $valid_password) {
//         $_SESSION['loggedin'] = true;
//         header('Location: acceuil.php');
//         exit();
//     } else {
//         $error = 'Invalid email or password';
//     }
// }


require 'db_lestitansdesete.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['nomUtilisateur'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM User WHERE Nom_Utilisateur = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['ID_User'];
            header('Location: acceuil.php');
            exit();
        } else {
            $error = 'Invalid email or password';
        }
    } else {
        $error = 'Invalid email or password';
    }

    $stmt->close();
    $conn->close();
}
?>
