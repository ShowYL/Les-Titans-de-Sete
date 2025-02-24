<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Titants de Sete</title>
    <link rel="stylesheet" href="../style/login.css">
    <link rel="icon" href="../images/logo-black-version-background-full.png" type="image/x-icon">
    </style>
</head>
<body>
    <section class="card"><div>
        <h1>Création de compte</h1>
        <form action="../controllers/createAccount.php" method="POST">
            <table>
                <tr><td><label for="nomUtilisteur">Nom d'utilisateur :</label></td></tr><tr><td><input type="text" name="nomUtilisateur" id="email" placeholder="nomUtilisateur" required></td></tr>
                <tr><td><label for="password">Mot de passe :</label></td></tr><tr><td><input type="password" name="password" id="password" placeholder="Mot de passe" required></td></tr>
                <tr><td><button type="submit">Créez le compte</button></td></tr>
                <tr><td><p>Vous avez déjà un compte ? <a href="login.php">Connectez-vous!</a></p></td></tr>
            </table>
        </form>
    </div></section>
</body>
</html>