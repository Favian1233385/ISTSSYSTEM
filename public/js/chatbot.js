/**
 * JavaScript Principal - Sistema ISTS
 * Funcionalidades básicas del sitio web
 */

document.addEventListener("DOMContentLoaded", function () {
    // Inicializar funcionalidades
    initSearch();
    initMobileMenu();
    initBackToTop();
    initSmoothScroll();
});

/**
 * Funcionalidad de búsqueda
 */
function initSearch() {
    const searchInput = document.getElementById("main-search");
    const searchToggle = document.querySelector(".search-toggle");
    const searchDropdown = document.querySelector(".search-dropdown");

    if (searchInput && searchToggle && searchDropdown) {
        // Toggle del dropdown de búsqueda
        searchToggle.addEventListener("click", function () {
            searchDropdown.classList.toggle("active");
            if (searchDropdown.classList.contains("active")) {
                searchInput.focus();
            }
        });

        // Búsqueda en tiempo real
        let searchTimeout;
        searchInput.addEventListener("input", function () {
            clearTimeout(searchTimeout);
            const query = this.value.trim();

            if (query.length >= 3) {
                searchTimeout = setTimeout(() => {
                    performSearch(query);
                }, 300);
            }
        });

        // Cerrar dropdown al hacer clic fuera
        document.addEventListener("click", function (e) {
            if (
                !searchDropdown.contains(e.target) &&
                !searchToggle.contains(e.target)
            ) {
                searchDropdown.classList.remove("active");
            }
        });
    }
}

/**
 * Realizar búsqueda AJAX
 */
function performSearch(query) {
    fetch(`/search?q=${encodeURIComponent(query)}`)
        .then((response) => response.json())
        .then((data) => {
            displaySearchResults(data);
        })
        .catch((error) => {
            console.error("Error en búsqueda:", error);
        });
}

/**
 * Mostrar resultados de búsqueda
 */
function displaySearchResults(data) {
    const suggestions = document.querySelector(".search-suggestions");
    if (!suggestions) return;

    suggestions.innerHTML = "";

    if (data.results && data.results.length > 0) {
        data.results.forEach((result) => {
            const link = document.createElement("a");
            link.href = result.url;
            link.textContent = result.title;
            link.className = "suggestion";
            suggestions.appendChild(link);
        });
    } else {
        suggestions.innerHTML =
            '<span class=\"no-results\">No se encontraron resultados</span>';
    }
}

/**
 * Menú móvil
 */
function initMobileMenu() {
    const mobileToggle = document.getElementById("mobile-menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    const mobileClose = document.getElementById("mobile-menu-close");

    if (mobileToggle && mobileMenu) {
        mobileToggle.addEventListener("click", function () {
            mobileMenu.classList.add("active");
            document.body.style.overflow = "hidden";
        });

        if (mobileClose) {
            mobileClose.addEventListener("click", function () {
                mobileMenu.classList.remove("active");
                document.body.style.overflow = "";
            });
        }

        // Cerrar menú al hacer clic fuera
        document.addEventListener("click", function (e) {
            if (
                !mobileMenu.contains(e.target) &&
                !mobileToggle.contains(e.target)
            ) {
                mobileMenu.classList.remove("active");
                document.body.style.overflow = "";
            }
        });

        // Cerrar menú al hacer clic en enlaces
        const mobileLinks = mobileMenu.querySelectorAll("a");
        mobileLinks.forEach((link) => {
            link.addEventListener("click", function () {
                mobileMenu.classList.remove("active");
                document.body.style.overflow = "";
            });
        });
    }
}

/**
 * Botón de volver arriba
 */
function initBackToTop() {
    const backToTopBtn = document.getElementById("back-to-top");

    if (backToTopBtn) {
        // Mostrar/ocultar botón según scroll
        window.addEventListener("scroll", function () {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add("visible");
            } else {
                backToTopBtn.classList.remove("visible");
            }
        });

        // Scroll suave al hacer clic
        backToTopBtn.addEventListener("click", function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    }
}

/**
 * Scroll suave para enlaces internos
 */
function initSmoothScroll() {
    const internalLinks = document.querySelectorAll('a[href^=\"#\"]');

    internalLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            const targetId = this.getAttribute("href").substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                e.preventDefault();
                targetElement.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });
}

/**
 * Validación de formularios
 */
function validateForm(form) {
    const requiredFields = form.querySelectorAll("[required]");
    let isValid = true;

    requiredFields.forEach((field) => {
        if (!field.value.trim()) {
            field.classList.add("error");
            isValid = false;
        } else {
            field.classList.remove("error");
        }
    });

    return isValid;
}

/**
 * Mostrar notificaciones
 */
function showNotification(message, type = "info") {
    const notification = document.createElement("div");
    notification.className = `notification notification-${type}`;
    notification.textContent = message;

    // Estilos
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        background: ${type === "error" ? "#dc3545" : type === "success" ? "#28a745" : "#007bff"};
        color: white;
        border-radius: 5px;
        z-index: 10000;
        animation: slideIn 0.3s ease;
    `;

    document.body.appendChild(notification);

    // Remover después de 5 segundos
    setTimeout(() => {
        notification.style.animation = "slideOut 0.3s ease";
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 5000);
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

    targetContainer.innerHTML = '<div class=\"loading\">Cargando...</div>';

    fetch(url)
        .then((response) => response.text())
        .then((html) => {
            targetContainer.innerHTML = html;
        })
        .catch((error) => {
            targetContainer.innerHTML =
                '<div class=\"error\">Error al cargar el contenido</div>';
            console.error("Error:", error);
        });
}

// CSS para animaciones
if (!document.getElementById("main-js-styles")) {
    const style = document.createElement("style");
    style.id = "main-js-styles"; // Asignar un ID único
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }

        .loading {
            text-align: center;
            padding: 20px;
            color: #666;
        }

        .error {
            text-align: center;
            padding: 20px;
            color: #dc3545;
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
        }

        .field.error {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
    `;
    document.head.appendChild(style);
}

/**
 * Animación Scroll Reveal para Contenido Reciente
 */
function initScrollReveal() {
    const scrollElements = document.querySelectorAll(".scroll-reveal");

    if (scrollElements.length === 0) {
        return;
    }

    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("revealed");
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    scrollElements.forEach((element) => {
        observer.observe(element);
    });
}

// Inicializar scroll reveal cuando el DOM esté listo
if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initScrollReveal);
} else {
    initScrollReveal();
}