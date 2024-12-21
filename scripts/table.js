const inputSearch = document.getElementById("search-input");
const table = document.getElementById("table-search");
const tableBody = table.querySelector("tbody");

inputSearch.addEventListener('input', (event) => {
    let inputValue = event.target.value.toLowerCase();
    let rows = Array.from(tableBody.rows);

    // Filtrer les lignes en fonction de la valeur de recherche
    rows.forEach((row, index) => {
        if (index === 0) {
            // Toujours afficher la première ligne (les titres des colonnes)
            row.style.display = "";
            return;
        }
        let cells = Array.from(row.cells);
        let match = cells.some(cell => cell.textContent.toLowerCase().includes(inputValue));
        row.style.display = match ? "" : "none";
    });
});

// Selectionner une ligne
function selectRow(row) {
    row.classList.toggle('selected');
}

// supprimer les joueurs sélectionnés
function deleteSelected() {
    var selectedRows = document.querySelectorAll('#table-search tr.selected');
    if (selectedRows.length > 0) {
        if (confirm('Êtes-vous sûr de vouloir supprimer les joueurs sélectionnés ?')) {
            var ids = [];
            selectedRows.forEach(function(row) {
                ids.push(row.getAttribute('data-id'));
            });
            var form = document.getElementById('joueurForm');
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids';
            input.value = JSON.stringify(ids);
            form.appendChild(input);
            form.submit();
        }
    } else {
        alert('Veuillez sélectionner au moins un joueur à supprimer.');
    }
}

// Modifier les joueurs sélectionnés
function editSelected() {
    var selectedRows = document.querySelectorAll('#table-search tr.selected');
    if (selectedRows.length === 1) {
        var row = selectedRows[0];
        var cells = row.cells;

        // Remplir les champs du formulaire avec les données de la ligne sélectionnée
        document.getElementById('licence').value = cells[1].textContent;
        document.getElementById('nom').value = cells[2].textContent;
        document.getElementById('prenom').value = cells[3].textContent;
        document.getElementById('taille').value = cells[4].textContent;
        document.getElementById('poids').value = cells[5].textContent;
        document.getElementById('date_naissance').value = cells[6].textContent;
        document.getElementById('statut').value = cells[7].textContent;

        // Ouvrir la modal
        var modal = document.getElementById("myModal");
        modal.style.display = "block";
    } else {
        alert('Veuillez sélectionner une seule ligne à modifier.');
    }
}