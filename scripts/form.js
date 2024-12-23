const modal = document.getElementById("myModal");
const btn = document.getElementById("addBtn");
const span = document.getElementsByClassName("close")[0];
const form = document.getElementById("dynamicForm");
const formActionInput = document.getElementById("formAction");
const idInput = document.getElementById("id");
const originalFormAction = form.getAttribute('action');
const editBtn = document.getElementById("edit-button");

btn.onclick = function() {
  form.setAttribute('action', originalFormAction); // remettre à l'action originale
  formActionInput.value = "add";
  idInput.value = ''; // supprimer l'id de la ligne selectionnée
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
  form.setAttribute('action', originalFormAction); // remettre à l'action originale
  formActionInput.value = "add"; // Reset to add

  // supprimer les valeurs des champs du formulaire
  const inputs = form.querySelectorAll('input, select, textarea');
  for (let i = 0; i < inputs.length; i++) {
    if (inputs[i].type === 'hidden') continue; // Skip hidden inputs
    inputs[i].value = '';
  }
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    form.setAttribute('action', originalFormAction); // remettre à l'action originale
    formActionInput.value = "add"; // Reset to add

    // supprimer les valeurs des champs du formulaire
    const inputs = form.querySelectorAll('input, select, textarea');
    for (let i = 0; i < inputs.length; i++) {
      if (inputs[i].type === 'hidden') continue; // Skip hidden inputs
      inputs[i].value = '';
    }
  }
}

editBtn.onclick = () => {
    const selectedRows = document.querySelectorAll('#table-search tr.selected');
    if (selectedRows.length === 1) {
        const row = selectedRows[0];
        const cells = row.cells;
        const id = cells[0].textContent; // recupérer l'id de la ligne selectionnée
        const type = row.getAttribute('data-type'); // recupérer le type de la ligne selectionnée (match ou joueur)

        if (type === 'match') { // pour les données du match
            fetch(`../controllers/getMatchData.php?id=${id}`)
                .then(response => response.json()) // récupérer la réponse du serveur
                .then(data => {
                    console.log(data); 
                    // Mettre les données du match dans les champs du formulaire
                    if (data && !data.error) {
                        document.getElementById('id').value = data.ID_Match;
                        document.getElementById('date').value = data.Date_Match;
                        document.getElementById('heure').value = data.Heure_Match;
                        document.getElementById('adversaire').value = data.Equipe_Adverse;
                        document.getElementById('lieu').value = data.Lieu;
                        document.getElementById('resultat').value = data.Résultat;
                        form.setAttribute('action', "../controllers/editMatchController.php"); // mettre l'action du formulaire à editMatchController.php
                        formActionInput.value = "edit"; // mettre l'action du formulaire à edit
                        modal.style.display = "block"; // Display the modal
                    } else {
                        alert('Error: ' + (data.error || 'Unknown error'));
                    }
                })
                .catch(error => console.error('Error fetching match data:', error));
        } else if (type === 'joueur') { // pour les données du joueur
            fetch(`../controllers/getJoueurData.php?id=${id}`)
                .then(response => response.json()) // récupérer la réponse du serveur
                .then(data => {
                    console.log(data);
                    // Mettre les données du joueur dans les champs du formulaire
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
                        form.setAttribute('action', "../controllers/editJoueurController.php"); // mettre l'action du formulaire à editJoueurController.php
                        formActionInput.value = "edit";
                        modal.style.display = "block";
                    } else {
                        alert('Error: ' + (data.error || 'Unknown error'));
                    }
                })
                .catch(error => console.error('Error fetching player data:', error));
        }
    } else {
        alert('Veuillez sélectionner une seule ligne à modifier.');
    }
}