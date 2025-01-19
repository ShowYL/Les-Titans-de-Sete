document.addEventListener('DOMContentLoaded', () => {
    const inputs = document.querySelectorAll(".search-input");
    const tables = document.querySelectorAll(".table-search");

    tables.forEach((table, idx) => {
        const input = inputs[idx];
        const tableBody = table.querySelector("tbody");
        const headers = table.querySelectorAll("th");

        // Search functionality
        input.addEventListener('input', (event) => {
            const inputValue = event.target.value.toLowerCase();
            const rows = Array.from(tableBody.rows);

            rows.forEach(row => {
                const cells = Array.from(row.cells);
                const match = cells.some(cell => 
                    cell.textContent.toLowerCase().includes(inputValue)
                );
                row.style.display = match ? "" : "none";
            });
        });

        // Sorting functionality
        headers.forEach((header, index) => {
            header.addEventListener('click', () => {
                const rows = Array.from(tableBody.rows);
                const sortedRows = rows.sort((a, b) => {
                    const cellA = a.cells[index].textContent.toLowerCase();
                    const cellB = b.cells[index].textContent.toLowerCase();
                    
                    const numA = parseFloat(cellA);
                    const numB = parseFloat(cellB);
                    
                    if (!isNaN(numA) && !isNaN(numB)) {
                        return numA - numB;
                    }
                    return cellA.localeCompare(cellB);
                });
                
                tableBody.innerHTML = '';
                sortedRows.forEach(row => tableBody.appendChild(row));
            });
        });

        // Row selection
        const rows = tableBody.querySelectorAll('tr');
        rows.forEach(row => {
            row.addEventListener('click', (event) => {
                if (event.ctrlKey) {
                    row.classList.toggle('selected');
                } else {
                    rows.forEach(r => {
                        if (r !== row) r.classList.remove('selected');
                    });
                    row.classList.toggle('selected');
                }
            });
        });
    });
});