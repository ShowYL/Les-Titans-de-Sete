const inputSearch = document.getElementById("search-input");
const table = document.getElementById("table-search");
const tableBody = table.querySelector("tbody");
const headers = table.querySelectorAll("th");
const deleteBtn = document.getElementById("delete-button");
const editBtn = document.getElementById("edit-button");


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

// trier par la colonne clickée
headers.forEach((header, index) => {
    header.addEventListener('click', () => {
        let rows = Array.from(tableBody.rows).slice(1)  ; // exclure la première ligne (header de la table)
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


// Sélectionner une ligne qui n'est pas le header (slice(1))
Array.from(tableBody.rows).slice(1).forEach(row => {
    row.addEventListener('click', (event) => {
        
        // si touche control préssée alors garder les précédentes sélections
        if (event.ctrlKey) {
            row.classList.toggle('selected');

        } else {
            // déselectionner les précédentes lignes
            let previouslySelectedRows = tableBody.querySelectorAll('tr.selected');
            previouslySelectedRows.forEach(selectedRow => {
                if (selectedRow !== row) {
                    selectedRow.classList.remove('selected');
                }
            });

            // sélectionner la précédente ligne
            row.classList.toggle('selected');

        }
    });
});

// supprimer les joueurs sélectionnés
deleteBtn.onclick = () => {
    var selectedRows = document.querySelectorAll('#table-search tr.selected');
    if (selectedRows.length > 0) {
        if (confirm('Êtes-vous sûr de vouloir supprimer les joueurs sélectionnés ?')) {
            // Recupére les id des joueurs sélectionnés
            var form = document.getElementById('joueurForm'); // Récupère le formulaire
            var oldInputs = form.querySelectorAll('input[name="ids[]"]'); // Supprime les anciens champs cachés pour éviter les doublons sinon big problem!!
            oldInputs.forEach(function(input) {
                form.removeChild(input);
            });

            // Crée un champ caché pour chaque ID sélectionné
            selectedRows.forEach(function(row) {
                var input = document.createElement('input'); // Crée un élément input
                input.type = 'hidden';
                input.name = 'ids[]'; // Utilise un tableau pour les noms des champs
                input.value = row.getAttribute('data-id');
                form.appendChild(input);
            });

            // Soumet le formulaire
            form.submit();
        }
    } else {
        alert('Veuillez sélectionner au moins un joueur à supprimer.');
    }
}

// Modifier les joueurs sélectionnés
editBtn.onclick = () => {
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
