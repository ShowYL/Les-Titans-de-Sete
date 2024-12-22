var modal = document.getElementById("myModal");
var btn = document.getElementById("addBtn");
var span = document.getElementsByClassName("close")[0];
var form = document.getElementById("dynamicForm");
var formActionInput = document.getElementById("formAction");
var idInput = document.getElementById("id");
var originalFormAction = form.getAttribute('action');
var editBtn = document.getElementById("edit-button");

btn.onclick = function() {
  form.setAttribute('action', originalFormAction); // Reset to original action
  formActionInput.value = "add";
  idInput.value = ''; // Clear the ID field when adding a new match or player
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
  form.setAttribute('action', originalFormAction); // Reset to original action
  formActionInput.value = "add"; // Reset to add

  // Clear all input fields in the form
  var inputs = form.querySelectorAll('input, select, textarea');
  for (var i = 0; i < inputs.length; i++) {
    if (inputs[i].type === 'hidden') continue; // Skip hidden inputs
    inputs[i].value = '';
  }
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    form.setAttribute('action', originalFormAction); // Reset to original action
    formActionInput.value = "add"; // Reset to add

    // Clear all input fields in the form
    var inputs = form.querySelectorAll('input, select, textarea');
    for (var i = 0; i < inputs.length; i++) {
      if (inputs[i].type === 'hidden') continue; // Skip hidden inputs (id field)
      inputs[i].value = '';
    }
  }
}

editBtn.onclick = () => {
    var selectedRows = document.querySelectorAll('#table-search tr.selected');
    if (selectedRows.length === 1) {
        var row = selectedRows[0];
        var cells = row.cells;
        var id = cells[0].textContent;// Get the ID of the selected row

        if (cells.length == 6) { // for match data
            fetch(`../controllers/getMatchData.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Log the response data
                    // Set the input fields to the data fetched from the server
                    if (data && !data.error) {
                        document.getElementById('id').value = data.ID_Match;
                        document.getElementById('date').value = data.Date_Match;
                        document.getElementById('heure').value = data.Heure_Match;
                        document.getElementById('adversaire').value = data.Equipe_Adverse;
                        document.getElementById('lieu').value = data.Lieu;
                        document.getElementById('resultat').value = data.Résultat;
                        form.setAttribute('action', "../controllers/editMatchController.php"); // Set the form action to editMatchController.php
                        formActionInput.value = "edit"; // Set the form action to edit
                        modal.style.display = "block"; // Display the modal
                    } else {
                        alert('Error: ' + (data.error || 'Unknown error'));
                    }
                })
                .catch(error => console.error('Error fetching match data:', error));
        } else if (cells.length == 8) { // for player data
            fetch(`../controllers/getJoueurData.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Log the response data
                    // Set the input fields to the data fetched from the server
                    if (data && !data.error) {
                        document.getElementById('id').value = data.ID_Joueur;
                        document.getElementById('licence').value = data.Licence;
                        document.getElementById('nom').value = data.Nom;
                        document.getElementById('prenom').value = data.Prenom;
                        document.getElementById('taille').value = data.Taille;
                        document.getElementById('poids').value = data.Poids;
                        document.getElementById('date_naissance').value = data.Date_Naissance;
                        document.getElementById('statut').value = data.Statut;
                        document.getElementById('commentaire').value = data.Commentaire;
                        form.setAttribute('action', "../controllers/editJoueurController.php"); // Set the form action to editJoueurController.php
                        formActionInput.value = "edit"; // Set the form action to edit
                        modal.style.display = "block"; // Display the modal
                    } else {
                        alert('Error: ' + (data.error || 'Unknown error')); // Display an error message
                    }
                })
                .catch(error => console.error('Error fetching player data:', error)); // 
        }


    } else {
        alert('Veuillez sélectionner une seule ligne à modifier.');
    }
}