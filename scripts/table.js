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
