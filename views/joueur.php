<?php

if(!isset($_COOKIE['auth']) || $_COOKIE['auth']!='true'){
    header('location: login.php');
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
    <link rel="stylesheet" href="../style/popups.css">
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
                        <button class="add-btn" id="addBtn">Add new</button>
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
</div>

<!-- The Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Ajouter un Joueur</h2>
    <form method="POST" action="../controllers/JoueurController.php">
        <div class="form-group">
            <label for="licence">Licence:</label>
            <input type="text" id="licence" name="licence" required>
        </div>
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
        <div class="form-group">
            <label for="commentaire">Commentaire:</label>
            <textarea id="commentaire" name="commentaire"></textarea>
        </div>
        <button type="submit">Ajouter</button>
    </form>
  </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("addBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
</script>
</body>
</html>