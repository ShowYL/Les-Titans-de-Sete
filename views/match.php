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
                <?php include '../components/header.php'; ?>
            </div>
            <div class='main-content'>
                <div class="table-container">
                <h2 class="card-title">Match</h2>
                    <div class="toolbar">
                        <button class="action-btn">Action ▾</button>
                        <input type="text" placeholder="Search..." class="search-input">
                        <button class="filter-btn">Filters ▾</button>
                        <label><input type="checkbox"> Quick filter</label>
                        <button class="add-btn">Add new</button>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Date rencontre</th>
                                <th>Heure</th>
                                <th>Adversaire</th>
                                <th>Lieu</th>
                                <th>Résultat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" checked></td>
                                <td>2022-01-23</td>
                                <td>17:30</td>
                                <td>St-paul</td>
                                <td>Domicile</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" checked></td>
                                <td>2022-01-23</td>
                                <td></td>
                                <td></td>
                                <td>Exterieur</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>2022-01-23</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>2022-01-23</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>