<?php
require_once '../controllers/JoueurController.php';


if(!isset($_COOKIE['auth']) || $_COOKIE['auth']!='true'){
    header('location: login.php');
    exit();
}

$controller = new JoueurController();
$tableHTML = $controller->getTableHTML();
$formHTML = $controller->getForm();


$controller->closeConnection();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Titants de Sete</title>
    <link rel="stylesheet" href="../style/table.css">
    <link rel="stylesheet" href="../style/global-Style.css">
    <link rel="stylesheet" href="../style/headerfooter-style.css">
    <link rel="stylesheet" href="../style/popups.css">
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
                <div class="table-container">
                    <h2 class="card-title">Joueur</h2>
                    <?php echo $tableHTML; ?>
                </div>
            </div>
        </div>
</div>

<?php echo $formHTML; ?>
</body>
</html>