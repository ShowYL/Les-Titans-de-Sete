<?php

if(!isset($_COOKIE['auth']) || $_COOKIE['auth']!='true'){
    header('location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Titants de Sete</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="../style/global-Style.css">
    <link rel="stylesheet" href="../style/headerfooter-style.css">
    <link rel="icon" href="../images/logo-black-version-background-full.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class='leftBar'>
        <?php include '../components/nav.php'; ?>
        </div>
        <div class='right-content'>
            <div class='topBar'>
                <?php include '../components/header.php'; ?>
            </div>
            <div class='main-content'>
                <h2 class="card-title ">Accueil</h2>
            </div>
        </div>
    </div>
</body>
</html>
