<?php
require_once '../controllers/MatchController.php';

if(!isset($_COOKIE['auth']) || $_COOKIE['auth']!='true'){
    header('location: login.php');
    exit();
}
$controller = new MatchController();
$tableHTML = $controller->getTableHTML();

$formHTML = $controller->getForm(true);
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
                <div class="table-container">
                <h2 class="card-title">Match</h2>
                <?php echo $tableHTML; ?>
                </div>
            </div>
            <?php include '../components/footer.php'; ?>
        </div>
    </div>
    <?php echo $formHTML; ?>
</body>
</html>