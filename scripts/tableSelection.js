const inputSearch = document.getElementById("search-input");
const table = document.getElementById("table-search");
const tableBody = table.querySelector("tbody");
const headers = table.querySelectorAll("th");
const deleteBtn = document.getElementById("delete-button");


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
        let rows = Array.from(tableBody.rows).slice(1); // exclure la première ligne (header de la table)
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

    row.addEventListener('click', () => {

        // déselectionner les précédentes lignes
        let previouslySelectedRows = tableBody.querySelectorAll('tr.selected');
        previouslySelectedRows.forEach(selectedRow => {
            if (selectedRow !== row) {
                selectedRow.classList.remove('selected');
            }
        });

        // sélectionner la précédente ligne
        row.classList.toggle('selected');
        whenSelected(row);

    })
})

async function whenSelected(row) {
    // Remove previously added header and player rows
    const existingHeaders = tableBody.querySelectorAll('tr.header-row, tr.players-row');
    existingHeaders.forEach(el => el.remove());

    fetch(`../Controllers/selectionController.php?matchId=${row.firstElementChild.firstChild.nodeValue}`)
    .then(res => res.json())
    .then(players => {
        if (players && players.length != 0) {
            console.log(players)
            Object.values(players).forEach(player => {
                let playersRow = document.createElement('tr');
                playersRow.classList.add('players-row');
                console.log(player)
                fetch(`../Controllers/JoueurController.php?id=${player.ID_Joueur}`)
                .then(res => res.json())
                .then(infos => {
                    Object.values(infos).slice(0,8).forEach(data => {
                        let playersCell = document.createElement('td');
                        playersCell.colSpan = 1;
                        playersCell.innerHTML = data;
                        playersRow.appendChild(playersCell);
                    });
                    header.insertAdjacentElement('afterend', playersRow);
                })
                .catch(err => console.error('Error during individual player', err));
            });
            let header = document.createElement('tr');
            header.classList.add('header-row');
            const index = ['ID','Licence','Nom','Prenom','Taille','Poids','Date de naissance','Status'];
            index.forEach((headerText) => {
                let col = document.createElement('th');
                col.colSpan = 1;
                col.innerHTML = headerText;
                header.appendChild(col);
            });
            row.insertAdjacentElement('afterend', header);
        }
    })
    .catch(err => {
        console.error("Error while fetching the player for the match", err);
    });
}