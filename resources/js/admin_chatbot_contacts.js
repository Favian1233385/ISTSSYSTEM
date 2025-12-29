// resources/js/admin_chatbot_contacts.js

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form[action*="chatbot.contacts"]');
    const tableContainer = document.querySelector('.table-responsive');
    const paginationContainer = document.querySelector('.mt-3');
    const limpiarBtn = form.querySelector('button.btn-secondary');

    // AJAX submit para filtrar
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(form);
        const params = new URLSearchParams(formData).toString();
        fetch(form.action + '?' + params, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            // Extraer solo la tabla y paginación del HTML recibido
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newTable = doc.querySelector('.table-responsive');
            const newPagination = doc.querySelector('.mt-3');
            if (newTable && tableContainer) tableContainer.innerHTML = newTable.innerHTML;
            if (newPagination && paginationContainer) paginationContainer.innerHTML = newPagination.innerHTML;
        });
    });

    // Limpiar filtros y recargar tabla completa por AJAX
    limpiarBtn.addEventListener('click', function () {
        form.reset();
        fetch(form.action, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newTable = doc.querySelector('.table-responsive');
            const newPagination = doc.querySelector('.mt-3');
            if (newTable && tableContainer) tableContainer.innerHTML = newTable.innerHTML;
            if (newPagination && paginationContainer) paginationContainer.innerHTML = newPagination.innerHTML;
        });
    });
});
