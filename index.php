<?php

if(isset($_COOKIE['auth']) && $_COOKIE['auth']=='true'){
    header('location: views/accueil.php');
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Titants de Sete</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <section class="card"><div>
        <h1>Login</h1>
        <form  method="POST" action="../controllers/loginController.php">
            <table>
                <tr><td><label for="nomUtilisteur">Nom d'utilisateur :</label></td></tr><tr><td><input type="text" name="nomUtilisateur" id="email" placeholder="nomUtilisateur" required></td></tr>
                <tr><td><label for="password">Mot de passe :</label></td></tr><tr><td><input type="password" name="password" id="password" placeholder="Mot de passe" required></td></tr>
                <tr><td><button type="submit">Connexion</button></td></tr>
                <tr><td><p>Vous n'avez pas de compte ? <a href="views/createAccount.html">Créez-en un!</a></p></td></tr>
            </table>
        </form>
    </div></section>
</body>
</html>