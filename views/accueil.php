<?php
// views/accueil.php

require_once '../controllers/MatchController.php';
require_once '../controllers/AccueilController.php';

if(!isset($_COOKIE['auth']) || $_COOKIE['auth']!='true'){
    header('location: login.php');
    exit();
}

$controller = new AccueilController();
$stats = $controller->getMatchStats();
$total = $stats['total'];
$won = $stats['won'];
$draw = $stats['draw'];
$lost = $stats['lost'];

$wonPercentage = $total > 0 ? ($won / $total) * 100 : 0;
$drawPercentage = $total > 0 ? ($draw / $total) * 100 : 0;
$lostPercentage = $total > 0 ? ($lost / $total) * 100 : 0;

$table = $controller->getTableHTML();


$controller->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../components/headCode.php'; ?>
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
                <div class="stats-container">
                    <h2 class="card-title "> Statistique du club </h2>
                    <div class="cards-container">
                        <div class="card">
                            <h3>Total de matchs</h3>
                            <p><?php echo $total; ?></p>
                        </div>
                        <div class="card">
                            <h3>Matchs gagnés</h3>
                            <p><?php echo $won; ?> (<?php echo number_format($wonPercentage, 2); ?>%)</p>
                        </div>
                        <div class="card">
                            <h3>Matchs nuls</h3>
                            <p><?php echo $draw; ?> (<?php echo number_format($drawPercentage, 2); ?>%)</p>
                        </div>
                        <div class="card">
                            <h3>Matchs perdus</h3>
                            <p><?php echo $lost; ?> (<?php echo number_format($lostPercentage, 2); ?>%)</p>
                        </div>
                    </div>
                </div>
                <div class="table-container">
                <h2 class="card-title"> Liste des joueurs </h2>
                    <?php
                    // Afficher la table générée par le composant modeleTable
                    echo $table;
                    ?>
                </div>
            </div>
            <?php include '../components/footer.php'; ?>   
        </div>
    </div>
</body>
</html>