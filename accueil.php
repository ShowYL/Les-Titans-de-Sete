<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Titants de Sete</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="global-Style.css">
    <link rel="stylesheet" href="headerfooter-style.css">
    <link rel="stylesheet" href="body_style.css">
</head>
<body>
    <div class="container">
        <div class='leftBar'>
        <?php include './components/nav.php'; ?>
        </div>
        <div class='right-content'>
            <div class='topBar'>
                <!-- créer un composant header pour la div test plus tard!  -->
                <div class='test'> 
                    <h1>Les Titants de Sete</h1>
                </div>
            </div>
            <div class='main-content'>
                <!-- <?php include 'joueur.php'; ?> -->
                <?php include 'match.php'; ?>
            </div>
        </div>
    </div>
</body>
</html>
