// Script para mantener el dropdown abierto mientras el mouse esté sobre el botón o el menú
// y permitir abrir/cerrar con clic en móviles

document.addEventListener('DOMContentLoaded', function() {
    const dropdowns = document.querySelectorAll('.header-public .dropdown');
    dropdowns.forEach(function(dropdown) {
        const trigger = dropdown.querySelector('.header-link');
        const menu = dropdown.querySelector('.dropdown-content');
        let closeTimeout;

        if (trigger && menu) {
            // Mostrar menú al pasar mouse por el trigger o el menú
            trigger.addEventListener('mouseenter', () => {
                clearTimeout(closeTimeout);
                menu.classList.add('dropdown-open');
            });
            menu.addEventListener('mouseenter', () => {
                clearTimeout(closeTimeout);
                menu.classList.add('dropdown-open');
            });
            // Ocultar menú al salir mouse del trigger o menú (con retardo)
            trigger.addEventListener('mouseleave', () => {
                closeTimeout = setTimeout(() => {
                    menu.classList.remove('dropdown-open');
                }, 180);
            });
            menu.addEventListener('mouseleave', () => {
                closeTimeout = setTimeout(() => {
                    menu.classList.remove('dropdown-open');
                }, 180);
            });
            // Abrir/cerrar con clic en móviles
            trigger.addEventListener('click', function(e) {
                if (window.innerWidth < 900) {
                    e.preventDefault();
                    if (menu.classList.contains('dropdown-open')) {
                        menu.classList.remove('dropdown-open');
                    } else {
                        menu.classList.add('dropdown-open');
                    }
                }
            });
        }
    });
});
