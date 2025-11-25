/**
 * JavaScript Administrativo - Sistema ISTS
 * Funcionalidades del panel de administración
 */

document.addEventListener("DOMContentLoaded", function () {
    // Inicializar funcionalidades administrativas
    initAdminFeatures();
    initDataTables();
    initFormValidation();
    initImageUpload();
    initCollapsibleMenu();
});

/**
 * Funcionalidades principales del admin
 */
function initAdminFeatures() {
    // Auto-hide alerts
    const alerts = document.querySelectorAll(".alert");
    alerts.forEach((alert) => {
        setTimeout(() => {
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    // Confirmar eliminaciones
    const deleteButtons = document.querySelectorAll(
        '[href*="delete"], [onclick*="confirm"]',
    );
    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (e) {
            if (
                !confirm("¿Estás seguro de que deseas eliminar este elemento?")
            ) {
                e.preventDefault();
            }
        });
    });

    // Toggle sidebar en móvil
    const menuToggle = document.querySelector(".menu-toggle");
    const sidebar = document.querySelector(".admin-sidebar");

    if (menuToggle && sidebar) {
        menuToggle.addEventListener("click", function () {
            sidebar.classList.toggle("active");
        });
    }

    // Cerrar dropdowns al hacer clic fuera
    document.addEventListener("click", function (e) {
        const dropdowns = document.querySelectorAll(".dropdown.active");
        dropdowns.forEach((dropdown) => {
            if (!dropdown.contains(e.target)) {
                dropdown.classList.remove("active");
            }
        });
    });
}

/**
 * Tablas de datos interactivas
 */
function initDataTables() {
    const tables = document.querySelectorAll(".data-table");

    tables.forEach((table) => {
        // Agregar funcionalidad de búsqueda
        const searchInput = document.createElement("input");
        searchInput.type = "text";
        searchInput.placeholder = "Buscar...";
        searchInput.className = "table-search";

        const searchContainer = document.createElement("div");
        searchContainer.className = "table-search-container";
        searchContainer.appendChild(searchInput);

        table.parentNode.insertBefore(searchContainer, table);

        // Funcionalidad de búsqueda
        searchInput.addEventListener("input", function () {
            const searchTerm = this.value.toLowerCase();
            const rows = table.querySelectorAll("tbody tr");

            rows.forEach((row) => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? "" : "none";
            });
        });

        // Agregar ordenamiento a columnas
        const headers = table.querySelectorAll("th[data-sortable]");
        headers.forEach((header) => {
            header.style.cursor = "pointer";
            header.addEventListener("click", function () {
                sortTable(table, this.cellIndex);
            });
        });
    });
}

/**
 * Ordenar tabla por columna
 */
function sortTable(table, columnIndex) {
    const tbody = table.querySelector("tbody");
    const rows = Array.from(tbody.querySelectorAll("tr"));

    const isAscending = table.getAttribute("data-sort-direction") !== "asc";

    rows.sort((a, b) => {
        const aText = a.cells[columnIndex].textContent.trim();
        const bText = b.cells[columnIndex].textContent.trim();

        if (isAscending) {
            return aText.localeCompare(bText);
        } else {
            return bText.localeCompare(aText);
        }
    });

    rows.forEach((row) => tbody.appendChild(row));
    table.setAttribute("data-sort-direction", isAscending ? "asc" : "desc");
}

/**
 * Validación de formularios
 */
function initFormValidation() {
    const forms = document.querySelectorAll("form[data-validate]");

    forms.forEach((form) => {
        form.addEventListener("submit", function (e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });

        // Validación en tiempo real
        const inputs = form.querySelectorAll("input, textarea, select");
        inputs.forEach((input) => {
            input.addEventListener("blur", function () {
                validateField(this);
            });
        });
    });
}

/**
 * Validar formulario completo
 */
function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll(
        "input[required], textarea[required], select[required]",
    );

    inputs.forEach((input) => {
        if (!validateField(input)) {
            isValid = false;
        }
    });

    return isValid;
}

/**
 * Validar campo individual
 */
function validateField(field) {
    const value = field.value.trim();
    const fieldName = field.getAttribute("name") || field.getAttribute("id");
    let isValid = true;
    let errorMessage = "";

    // Remover errores previos
    removeFieldError(field);

    // Validaciones específicas
    if (field.hasAttribute("required") && !value) {
        isValid = false;
        errorMessage = "Este campo es obligatorio";
    } else if (field.type === "email" && value && !isValidEmail(value)) {
        isValid = false;
        errorMessage = "Email inválido";
    } else if (field.type === "url" && value && !isValidUrl(value)) {
        isValid = false;
        errorMessage = "URL inválida";
    } else if (
        field.hasAttribute("minlength") &&
        value.length < field.getAttribute("minlength")
    ) {
        isValid = false;
        errorMessage = `Mínimo ${field.getAttribute("minlength")} caracteres`;
    } else if (
        field.hasAttribute("maxlength") &&
        value.length > field.getAttribute("maxlength")
    ) {
        isValid = false;
        errorMessage = `Máximo ${field.getAttribute("maxlength")} caracteres`;
    }

    if (!isValid) {
        showFieldError(field, errorMessage);
    }

    return isValid;
}

/**
 * Mostrar error en campo
 */
function showFieldError(field, message) {
    field.classList.add("error");

    const errorDiv = document.createElement("div");
    errorDiv.className = "field-error";
    errorDiv.textContent = message;

    field.parentNode.appendChild(errorDiv);
}

/**
 * Remover error de campo
 */
function removeFieldError(field) {
    field.classList.remove("error");
    const errorDiv = field.parentNode.querySelector(".field-error");
    if (errorDiv) {
        errorDiv.remove();
    }
}

/**
 * Validar email
 */
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

/**
 * Validar URL
 */
function isValidUrl(url) {
    try {
        new URL(url);
        return true;
    } catch {
        return false;
    }
}

/**
 * Subida de imágenes
 */
function initImageUpload() {
    const imageInputs = document.querySelectorAll(
        'input[type="file"][accept*="image"]',
    );

    imageInputs.forEach((input) => {
        input.addEventListener("change", function (e) {
            const file = e.target.files[0];
            if (file) {
                previewImage(file, input);
            }
        });
    });
}

/**
 * Previsualizar imagen
 */
function previewImage(file, input) {
    const reader = new FileReader();

    reader.onload = function (e) {
        // Crear o actualizar preview
        let preview = input.parentNode.querySelector(".image-preview");
        if (!preview) {
            preview = document.createElement("div");
            preview.className = "image-preview";
            input.parentNode.appendChild(preview);
        }

        preview.innerHTML = `
            <img src="${e.target.result}" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <button type="button" class="remove-image" onclick="removeImagePreview(this)">✕</button>
        `;
    };

    reader.readAsDataURL(file);
}

/**
 * Estadísticas en tiempo real
 */
function updateStats() {
    fetch("/admin/api/stats")
        .then((response) => response.json())
        .then((data) => {
            // Actualizar contadores
            const counters = document.querySelectorAll(".stat-card h3");
            counters.forEach((counter) => {
                const currentValue = parseInt(counter.textContent);
                const targetValue = data[counter.dataset.stat] || 0;

                animateCounter(counter, currentValue, targetValue);
            });
        })
        .catch((error) => console.error("Error updating stats:", error));
}

/**
 * Animar contador
 */
function animateCounter(element, start, end) {
    const duration = 1000;
    const startTime = performance.now();

    function updateCounter(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);

        const current = Math.floor(start + (end - start) * progress);
        element.textContent = current;

        if (progress < 1) {
            requestAnimationFrame(updateCounter);
        }
    }

    requestAnimationFrame(updateCounter);
}

/**
 * Notificaciones toast
 */
function showToast(message, type = "info") {
    const toast = document.createElement("div");
    toast.className = `toast toast-${type}`;
    toast.textContent = message;

    // Estilos
    toast.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        background: ${type === "success" ? "#10B981" : type === "error" ? "#EF4444" : "#3B82F6"};
        color: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        z-index: 10000;
        animation: slideInRight 0.3s ease;
    `;

    document.body.appendChild(toast);

    // Remover después de 3 segundos
    setTimeout(() => {
        toast.style.animation = "slideOutRight 0.3s ease";
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

/**
 * Cargar contenido dinámicamente
 */
function loadContent(url, container) {
    const targetContainer =
        typeof container === "string"
            ? document.querySelector(container)
            : container;

    if (!targetContainer) return;

    targetContainer.innerHTML = '<div class="loading">Cargando...</div>';

    fetch(url)
        .then((response) => response.text())
        .then((html) => {
            targetContainer.innerHTML = html;
        })
        .catch((error) => {
            targetContainer.innerHTML =
                '<div class="error">Error al cargar el contenido</div>';
            console.error("Error:", error);
        });
}

// CSS adicional para funcionalidades administrativas
const adminStyles = `
<style>
.field-error {
    color: #EF4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.field.error {
    border-color: #EF4444;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.table-search-container {
    margin-bottom: 1rem;
}

.table-search {
    width: 100%;
    max-width: 300px;
    padding: 0.5rem;
    border: 2px solid var(--admin-border);
    border-radius: 6px;
    font-size: 0.9rem;
}

.table-search:focus {
    outline: none;
    border-color: var(--admin-primary);
    box-shadow: 0 0 0 3px rgba(0, 168, 107, 0.1);
}

.image-preview {
    position: relative;
    display: inline-block;
    margin-top: 1rem;
}

.remove-image {
    position: absolute;
    top: -10px;
    right: -10px;
    background: #EF4444;
    color: white;
    border: none;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    cursor: pointer;
    font-size: 12px;
}

.rich-editor-toolbar {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 0.5rem;
    padding: 0.5rem;
    background: var(--admin-light);
    border-radius: 6px;
    border: 1px solid var(--admin-border);
}

.rich-editor-toolbar button {
    padding: 0.5rem;
    border: 1px solid var(--admin-border);
    background: white;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
    transition: var(--transition);
}

.rich-editor-toolbar button:hover {
    background: var(--admin-primary);
    color: white;
}

.rich-editor-content {
    min-height: 200px;
    border: 2px solid var(--admin-border);
    border-radius: 6px;
    padding: 1rem;
}

.loading {
    text-align: center;
    padding: 2rem;
    color: var(--admin-gray);
}

.error {
    text-align: center;
    padding: 2rem;
    color: #EF4444;
    background: #FEE2E2;
    border-radius: 6px;
}

@keyframes slideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes slideOutRight {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
}
</style>
`;

document.head.insertAdjacentHTML("beforeend", adminStyles);

/**
 * Inicializar menú colapsable con categorías
 */
function initCollapsibleMenu() {
    // Toggle de categorías
    const categoryToggles = document.querySelectorAll('.category-toggle');
    
    categoryToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const parent = this.parentElement;
            const submenu = parent.querySelector('.submenu');
            const icon = this.querySelector('i');
            
            // Toggle submenu
            if (submenu) {
                submenu.classList.toggle('show');
                icon.style.transform = submenu.classList.contains('show') 
                    ? 'rotate(180deg)' 
                    : 'rotate(0deg)';
            }
            
            // En móvil, cerrar otros submenús
            if (window.innerWidth < 768) {
                categoryToggles.forEach(otherToggle => {
                    if (otherToggle !== toggle) {
                        const otherParent = otherToggle.parentElement;
                        const otherSubmenu = otherParent.querySelector('.submenu');
                        const otherIcon = otherToggle.querySelector('i');
                        if (otherSubmenu) {
                            otherSubmenu.classList.remove('show');
                            otherIcon.style.transform = 'rotate(0deg)';
                        }
                    }
                });
            }
        });
    });
    
    // Toggle menú móvil
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const adminNav = document.getElementById('adminNav');
    
    if (mobileMenuToggle && adminNav) {
        mobileMenuToggle.addEventListener('click', function() {
            adminNav.classList.toggle('show-mobile');
        });
        
        // Cerrar menú al hacer clic fuera
        document.addEventListener('click', function(e) {
            if (!adminNav.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
                adminNav.classList.remove('show-mobile');
            }
        });
    }
    
    // Mantener submenú abierto si hay un item activo dentro
    const activeLinks = document.querySelectorAll('.submenu a.active');
    activeLinks.forEach(link => {
        const submenu = link.closest('.submenu');
        if (submenu) {
            submenu.classList.add('show');
            const toggle = submenu.parentElement.querySelector('.category-toggle i');
            if (toggle) {
                toggle.style.transform = 'rotate(180deg)';
            }
        }
    });
}
