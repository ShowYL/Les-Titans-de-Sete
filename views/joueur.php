<?php

if(!isset($_COOKIE['auth']) || $_COOKIE['auth']!='true'){
    header('location: ../index.php');
    exit();
}

require_once '../controllers/JoueurController.php';

$controller = new JoueurController();
$tableHTML = $controller->getTableHTML();

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
</head>
<body>
<div class="container">
        <div class='leftBar'>
        <?php include '../components/nav.php'; ?>
        </div>
        <div class='right-content'>
            <div class='topBar'>
                <div class='test'> 
                    <h1>Les Titants de Sete</h1>
                </div>
            </div>
            <div class='main-content'>
                <div class="table-container">
                    <h2 class="card-title">Joueur</h2>
                    <div class="toolbar">
                        <button class="action-btn">Action ▾</button>
                        <input type="text" placeholder="Search..." class="search-input">
                        <button class="filter-btn">Filters ▾</button>
                        <label><input type="checkbox"> Quick filter</label>
                        <button class="add-btn">Add new</button>
                    </div>
                    <?php echo $tableHTML; ?>
                    
                    <div class="pagination">
                        <span>Rows per page: 
                            <select>
                                <option>10</option>
                                <option>20</option>
                                <option>50</option>
                            </select>
                        </span>
                        <span>1 - 10 of ....</span>
                        <button>⏮</button>
                        <button>◀</button>
                        <button>▶</button>
                        <button>⏭</button>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>