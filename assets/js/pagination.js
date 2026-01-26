document.addEventListener('DOMContentLoaded', () => {

    const rowsPerPage = 10;

    function paginateTable(tableId) {
        const table = document.getElementById(tableId);
        const tbody = table.querySelector('tbody');
        const paginationContainer = document.querySelector(`.table-pagination[data-table="${tableId}"]`);
        let rows = Array.from(tbody.querySelectorAll('tr'));
        let currentPage = 1;

        function renderTablePage(page, rowsToRender) {
            currentPage = page;
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            rows.forEach((row, i) => {
                row.style.display = 'none';
            });

            const paginatedRows = rowsToRender.slice(start, end);
            paginatedRows.forEach(row => row.style.display = '');

            renderPagination(rowsToRender.length);
        }

        function renderPagination(totalRows) {
            const totalPages = Math.ceil(totalRows / rowsPerPage);
            paginationContainer.innerHTML = '';

            if (totalPages <= 1) return;

            const prevBtn = document.createElement('button');
            prevBtn.textContent = 'Previous';
            prevBtn.disabled = currentPage === 1;
            prevBtn.onclick = () => renderTablePage(currentPage - 1, rows);
            paginationContainer.appendChild(prevBtn);

            for (let i = 1; i <= totalPages; i++) {
                const btn = document.createElement('button');
                btn.textContent = i;
                btn.style.margin = '0 3px';
                btn.style.padding = '5px 10px';
                btn.style.cursor = 'pointer';
                btn.style.background = i === currentPage ? '#007bff' : '#fff';
                btn.style.color = i === currentPage ? '#fff' : '#000';
                btn.onclick = () => renderTablePage(i, rows);
                paginationContainer.appendChild(btn);
            }

            const nextBtn = document.createElement('button');
            nextBtn.textContent = 'Next';
            nextBtn.disabled = currentPage === totalPages;
            nextBtn.onclick = () => renderTablePage(currentPage + 1, rows);
            paginationContainer.appendChild(nextBtn);
        }

        // Search functionality
        const searchInput = document.querySelector(`.table-search[data-table="${tableId}"]`);
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                const filter = this.value.toLowerCase();
                const filteredRows = rows.filter(row => 
                    Array.from(row.cells).some(cell => cell.textContent.toLowerCase().includes(filter))
                );
                renderTablePage(1, filteredRows);
            });
        }

        // Initial render
        renderTablePage(1, rows);
    }

    // Automatically paginate all tables with .table-pagination
    document.querySelectorAll('.table-pagination').forEach(p => {
        const tableId = p.dataset.table;
        paginateTable(tableId);
    });

});
