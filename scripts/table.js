const inputSearch = document.getElementById("search-input");
const table = document.getElementById("table-search");
const tableBody = table.querySelector("tbody");
const headers = table.querySelectorAll("th");

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

// Ajouter un gestionnaire d'événements pour chaque en-tête de colonne
headers.forEach((header, index) => {
    header.addEventListener('click', () => {
        let rows = Array.from(tableBody.rows).slice(1)  ; // Exclude the first row (headers)
        let sortedRows = rows.sort((a, b) => {
            let cellA = a.cells[index].textContent.toLowerCase();
            let cellB = b.cells[index].textContent.toLowerCase();
            
            // Convertir les valeurs en nombres si possible
            let numA = parseFloat(cellA);
            let numB = parseFloat(cellB);
            
            if (!isNaN(numA) && !isNaN(numB)) {
                return numA - numB;
            } else {
                if (cellA < cellB) return -1;
                if (cellA > cellB) return 1;
                return 0;
            }
        });
        
        // Vider le corps du tableau sauf la première ligne (les titres des colonnes)
        let headerRow = tableBody.rows[0];
        tableBody.innerHTML = "";
        tableBody.appendChild(headerRow);
        
        // Ajouter les lignes triées
        sortedRows.forEach(row => tableBody.appendChild(row));
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