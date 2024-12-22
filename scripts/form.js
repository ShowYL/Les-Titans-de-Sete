var modal = document.getElementById("myModal");
var btn = document.getElementById("addBtn");
var span = document.getElementsByClassName("close")[0];
var form = document.getElementById("dynamicForm");
var formActionInput = document.getElementById("formAction");
var idInput = document.getElementById("id");
var originalFormAction = form.getAttribute('action');

btn.onclick = function() {
  form.setAttribute('action', originalFormAction); // Reset to original action
  formActionInput.value = "add";
  idInput.value = ''; // Clear the ID field when adding a new match
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
  form.setAttribute('action', originalFormAction); // Reset to original action
  formActionInput.value = "add";// Reset to add

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
    formActionInput.value = "add";// Reset to add


     // Clear all input fields in the form
     var inputs = form.querySelectorAll('input, select, textarea');
     for (var i = 0; i < inputs.length; i++) {
       if (inputs[i].type === 'hidden') continue; // Skip hidden inputs
       inputs[i].value = '';
     }
  }
}

function editSelected() {
    var selectedRows = document.querySelectorAll('#table-search tr.selected');
    if (selectedRows.length === 1) {
        var row = selectedRows[0];
        var cells = row.cells;

        if (cells.length == 6) {
            document.getElementById('id').value = cells[0].textContent;
            document.getElementById('date').value = cells[1].textContent;
            document.getElementById('heure').value = cells[2].textContent;
            document.getElementById('adversaire').value = cells[3].textContent;
            document.getElementById('lieu').value = cells[4].textContent;
            document.getElementById('resultat').value = cells[5].textContent;
            form.action = "../controllers/editMatchController.php";// Set the form action to editMatchController.php
        } else if (cells.length == 8) {
            document.getElementById('id').value = cells[0].textContent;
            document.getElementById('licence').value = cells[1].textContent;
            document.getElementById('nom').value = cells[2].textContent;
            document.getElementById('prenom').value = cells[3].textContent;
            document.getElementById('taille').value = cells[4].textContent;
            document.getElementById('poids').value = cells[5].textContent;
            document.getElementById('date_naissance').value = cells[6].textContent;
            document.getElementById('statut').value = cells[7].textContent;
            form.action = "../controllers/editJoueurController.php";
        }

        formActionInput.value = "edit"; // Set the form action to edit
        modal.style.display = "block";
    } else {
        alert('Veuillez sélectionner une seule ligne à modifier.');
    }
}