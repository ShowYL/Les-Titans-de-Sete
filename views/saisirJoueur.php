<?php 
require_once '../controllers/JoueurController.php';

$controller = new JoueurController();
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
                    <h2 class="card-title">Ajouter un Joueur</h2>
                    <form method="POST" action="../controllers/JoueurController.php">
                        <div class="form-group">
                            <label for="licence">Licence:</label>
                            <input type="text" id="licence" name="licence" required>
                        <div class="form-group">
                            <label for="nom">Nom:</label>
                            <input type="text" id="nom" name="nom" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom:</label>
                            <input type="text" id="prenom" name="prenom" required>
                        </div>
                        <div class="form-group">
                            <label for="taille">Taille:</label>
                            <input type="number" id="taille" name="taille" required>
                        </div>
                        <div class="form-group">
                            <label for="poids">Poids:</label>
                            <input type="number" id="poids" name="poids" required>
                        </div>
                        <div class="form-group">
                            <label for="date_naissance">Date de naissance:</label>
                            <input type="date" id="date_naissance" name="date_naissance" required>
                        </div>
                        <div class="form-group">
                            <label for="statut">Statut:</label>
                            <input type="text" id="statut" name="statut" required>
                        </div>
                        <button type="submit">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
