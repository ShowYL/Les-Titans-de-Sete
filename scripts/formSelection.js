const modal = document.getElementById("myModal");
const addBtns = document.querySelectorAll("#addBtn");
const span = document.getElementsByClassName("close")[0];
const form = document.getElementById("dynamicForm");
const formActionInput = document.getElementById("formAction");
const idInput = document.getElementById("id");
const originalFormAction = form.getAttribute('action');
const editBtns = document.querySelectorAll("#edit-button");
const deleteBtns = document.querySelectorAll("#delete-button");
const note = document.getElementById("Note");
note.disabled = true;

// Add player button click - one for each match section
addBtns.forEach(btn => {
  btn.onclick = function () {
    const matchDetails = btn.closest('details');
    const matchSummary = matchDetails.querySelector('summary').textContent;
    const matchId = matchSummary.match(/\(id : (\d+)\)/)[1];

    form.setAttribute('action', '../controllers/addSelectionController.php');
    formActionInput.value = "add";
    idInput.value = '';

    // Set the match ID in hidden field
    document.getElementById('ID_Match').value = matchId;
    modal.style.display = "block";

  }
});

// Close modal button click
span.onclick = function () {
  modal.style.display = "none";
  form.setAttribute('action', originalFormAction);
  formActionInput.value = "add";

  // Clear form fields
  const inputs = form.querySelectorAll('input, select, textarea');
  for (let i = 0; i < inputs.length; i++) {
    if (inputs[i].type === 'hidden') continue;
    inputs[i].value = '';
  }
}

// Click outside modal
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
    form.setAttribute('action', originalFormAction);
    formActionInput.value = "add";

    // Clear form fields
    const inputs = form.querySelectorAll('input, select, textarea');
    for (let i = 0; i < inputs.length; i++) {
      if (inputs[i].type === 'hidden') continue;
      inputs[i].value = '';
    }
  }
}

// Edit button click handler
editBtns.forEach(editBtn => {
  editBtn.onclick = function () {
    const matchDetails = editBtn.closest('details');
    if (!matchDetails) {
      console.error('No matching details element found');
      return;
    }

    const table = matchDetails.querySelector('.table-search');
    if (!table) {
      console.error('No table found');
      return;
    }

    const selectedRows = table.querySelectorAll('tr.selected');
    console.log('Selected rows:', selectedRows.length);

    if (selectedRows.length === 1) {
      const row = selectedRows[0];
      const joueurIdConcat = row.cells[0].textContent.trim();
      const joueurId = joueurIdConcat.split(' ')[0]; // Extract the ID from the concatenation
      const matchIdMatch = matchDetails.querySelector('summary').textContent.match(/\(id : (\d+)\)/);
      const matchId = matchIdMatch ? matchIdMatch[1] : null;

      if (!matchId) {
        alert('Match ID not found.');
        return;
      }

      fetch(`../controllers/getSelectionData.php?joueurId=${joueurId}&matchId=${matchId}`)
        .then(response => {
          if (!response.ok) {
            console.error('Network response was not ok:', response);
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          console.log('Response data:', data);
          const today = new Date().toISOString().split('T')[0];

          if (data && !data.error) {
            // Fill form with selection data
            document.getElementById('ID_Joueur').value = data.ID_Joueur || '';
            document.getElementById('ID_Match').value = data.ID_Match || '';
            document.getElementById('Titulaire').value = data.Titulaire == '0' ? 'Non' : 'Oui'; // Convert to Yes/No
            document.getElementById('Poste').value = data.Poste || 'Pilier Gauche'; // Default position
            document.getElementById('Note').value = data.Note || '';

            // Update form settings
            form.setAttribute('action', '../controllers/editSelectionController.php');
            formActionInput.value = "edit";
            modal.style.display = "block";
          } else {
            throw new Error(data.error || 'Unknown error');
          }

          // Disable field if match date has passed
          if (data.Date_Match < today) {
            document.getElementById('ID_Joueur').disabled = true;
            document.getElementById('ID_Match').disabled =  true;
            document.getElementById('Titulaire').disabled = true;
            document.getElementById('Poste').disabled = true;
            note.disabled = false;
          }
        })
        .catch(error => {
          console.error('Error fetching selection data:', error);
          alert('Error loading selection data: ' + error.message);
        });
    } else {
      alert('Please select a single row to edit.');
    }
  };
});

// Delete button click
deleteBtns.forEach(deleteBtn => {
  deleteBtn.onclick = async function () {
    const matchDetails = deleteBtn.closest('details');
    const table = matchDetails.querySelector('.table-search');
    const selectedRows = table.querySelectorAll('tr.selected');

    if (selectedRows.length === 1 && confirm('Are you sure you want to delete this selection?')) {
      try {
        const row = selectedRows[0];
        const joueurIdConcat = row.cells[0].textContent.trim();
        const joueurId = joueurIdConcat.split(' ')[0]; // Extract the ID from the concatenation
        const matchId = matchDetails.querySelector('summary').textContent.match(/\(id : (\d+)\)/)[1];

        const response = await fetch('../controllers/suppSelectionController.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `ID_Joueur=${joueurId}&ID_Match=${matchId}`
        });
        const data = await response.json();

        if (data.success) {
          window.location.reload();
        } else {
          throw new Error(data.error || 'Unknown error');
        }
      } catch (error) {
        console.error('Error:', error);
        alert('Error deleting selection: ' + error.message);
      }
    }
  }
});