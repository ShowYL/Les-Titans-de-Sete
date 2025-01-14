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
deleteBtn.addEventListener('click', () => {
    let selectedRow = tableBody.querySelector('tr.selected');
    if (selectedRow) {
        let id = selectedRow.cells[0].textContent; 
        let type = selectedRow.getAttribute('data-type'); 
        let confirmMsg = `Voulez-vous vraiment supprimer ce ${type === 'match' ? 'match' : 'joueur'} ?`;
        if (confirm(confirmMsg)) {
            console.log(`type :${type},  ID: ${id}`); 

            deleteBtn.disabled = true;
            deleteBtn.textContent = 'Suppression...'; // l'attente de la suppression car elle peut prendre du temps

            // envoyer une requête de suppression au serveur avec la méthode GET
            fetch(`../controllers/supp${type === 'match' ? 'Match' : 'Joueur'}Data.php?id=${id}`, {
                method: 'GET'
            })
                .then(response => response.text()) // récupérer la réponse du serveur en texte brut
                .then(text => {
                    console.log('Reponse du serveur  :', text);
                    let data = JSON.parse(text); // convertir le texte en JSON
                    console.log('Reponse du serveur (JSON) :', data);
                    if (data && !data.error) { // si la suppression est effectuée avec succès
                        alert(data.message);
                        selectedRow.remove();
                    } else {
                        alert('Erreur: ' + (data.error || 'Erreur inconnue')); 
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la suppression:', error);
                    alert('Erreur lors de la suppression : réponse invalide du serveur.');
                }) // si la requête échoue
                .finally(() => {
                    deleteBtn.disabled = false;
                    deleteBtn.textContent = 'Supprimer'; // rétablir le texte du bouton
                });
        }
    } else {
        alert('Veuillez sélectionner une ligne à supprimer.');
    }
});

