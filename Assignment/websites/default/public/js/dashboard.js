document.addEventListener('DOMContentLoaded', () => {
    // 🔍 Table Search
    const searchInput = document.getElementById('global_search_input');
    const tableBody = document.getElementById('event_table_body');

    if (searchInput && tableBody) {
        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();

            Array.from(tableBody.querySelectorAll('tr')).forEach(row => {
                const title = row.cells[0]?.textContent.toLowerCase() || '';
                const date = row.cells[1]?.textContent.toLowerCase() || '';
                const matches = title.includes(searchTerm) || date.includes(searchTerm);
                row.style.display = matches ? '' : 'none';
            });
        });
    }

    // 👤 Profile Card Toggle
    const toggle = document.getElementById('profileToggle');
    const card = document.getElementById('profileCard');

    if (toggle && card) {
        toggle.addEventListener('click', () => {
            card.style.display = (card.style.display === 'block') ? 'none' : 'block';
        });

        document.addEventListener('click', function (e) {
            if (!toggle.contains(e.target) && !card.contains(e.target)) {
                card.style.display = 'none';
            }
        });
    }
});
