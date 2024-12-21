<?php
if(!isset($_COOKIE['auth']) || $_COOKIE['auth']!='true'){
    header('location: login.php');
    exit();
}
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
                <h2 class="card-title">Selection</h2>
                </div>
            </div>
        </div>
    </div>
</body>
</html>