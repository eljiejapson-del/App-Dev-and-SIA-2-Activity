document.addEventListener('DOMContentLoaded', function() {
    const table = document.querySelector('table');
    const searchBox = document.createElement('input');
    
    searchBox.placeholder = "Filter employees by name...";
    searchBox.className = "search-input";
    searchBox.style = "width: 100%; padding: 10px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 5px;";
    
    table.parentNode.insertBefore(searchBox, table);

    searchBox.addEventListener('keyup', function() {
        const term = searchBox.value.toLowerCase();
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {
            const name = row.querySelector('td').textContent.toLowerCase();
            row.style.display = name.includes(term) ? '' : 'none';
        });
    });
});