<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Titants de Sete</title>
    <link rel="stylesheet" href="../table.css">
    <link rel="stylesheet" href="../global-Style.css">
    <link rel="stylesheet" href="../headerfooter-style.css">
    <link rel="stylesheet" href="../body_style.css">
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
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>License</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Taille</th>
                                <th>Poids</th>
                                <th>Date de naissance</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox" checked></td>
                                <td><a href="#">IN/1001/23</a></td>
                                <td>Pierre</td>
                                <td>jean</td>
                                <td>170</td>
                                <td></td>
                                <td>2022-01-23</td>
                                <td>Actif</td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" checked></td>
                                <td><a href="#">IN/1002/23</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><a href="#">IN/1004/23</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><a href="#">IN/1004/23</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><a href="#">IN/1004/23</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><a href="#">IN/1004/23</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td><a href="#">IN/1004/23</a></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
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