/**
 * Chatbot JavaScript - Sistema ISTS
 * Funcionalidad del asistente virtual (UI + autocompletado)
 */


// --- INICIO: Lógica de UI del ChatBot (clase ISTSChatbot) ---
class ISTSChatbot {
    constructor() {
        this.isOpen = false;
        this.sessionId = this.generateSessionId();
        this.messageHistory = [];
        this.userInfo = this.loadUserInfo();
        this.init();
    }

    init() {
        this.bindEvents();
        this.loadChatHistory();
    }

    bindEvents() {
        const toggleBtn = document.getElementById('chatbot-toggle');
        const closeBtn = document.getElementById('chatbot-close');
        const form = document.getElementById('chatbot-form');
        const input = document.getElementById('chatbot-input');
        const userInfoForm = document.getElementById('chatbot-userinfo-form');
        const userInfoModal = document.getElementById('chatbot-userinfo-modal');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                if (!this.userInfo) {
                    this.showUserInfoModal();
                } else {
                    this.toggleChat();
                }
            });
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', () => this.closeChat());
        }

        if (form) {
            form.addEventListener('submit', (e) => this.handleSubmit(e));
        }

        if (input) {
            input.addEventListener('keypress', (e) => {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    this.handleSubmit(e);
                }
            });
        }

        if (userInfoForm) {
            userInfoForm.addEventListener('submit', (e) => this.handleUserInfoSubmit(e));
        }

        if (userInfoModal) {
            userInfoModal.addEventListener('click', (e) => {
                if (e.target === userInfoModal) {
                    userInfoModal.style.display = 'none';
                }
            });
        }
    }

    showUserInfoModal() {
        const modal = document.getElementById('chatbot-userinfo-modal');
        if (modal) {
            modal.style.display = 'flex';
        }
    }

    hideUserInfoModal() {
        const modal = document.getElementById('chatbot-userinfo-modal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    handleUserInfoSubmit(e) {
        e.preventDefault();
        let nombre = document.getElementById('chatbot-nombre').value.trim();
        let telefono = document.getElementById('chatbot-telefono').value.trim();
        let carrera = '';
        const carreraSelect = document.getElementById('chatbot-carrera');
        const carreraOtro = document.getElementById('chatbot-carrera-otro');
        if (carreraSelect) {
            if (carreraSelect.value === '__otro__' && carreraOtro) {
                carrera = carreraOtro.value.trim();
            } else {
                carrera = carreraSelect.value.trim();
            }
        }
        if (!nombre || nombre.length > 30) {
            alert('El nombre es obligatorio y debe tener máximo 30 caracteres.');
            return;
        }
        const palabras = nombre.split(/\s+/).filter(Boolean);
        if (palabras.length < 2) {
            alert('Por favor, ingresa tu nombre y apellido.');
            return;
        }
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/.test(nombre)) {
            alert('El nombre solo puede contener letras y espacios.');
            return;
        }
        nombre = palabras.map(p => p.charAt(0).toUpperCase() + p.slice(1).toLowerCase()).join(' ');
        document.getElementById('chatbot-nombre').value = nombre;
        if (!/^[0-9]{10}$/.test(telefono)) {
            alert('El número de teléfono debe contener exactamente 10 dígitos.');
            return;
        }
        this.saveUserInfo({ nombre, telefono, carrera });
    }

    saveUserInfo(userInfo) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        fetch('/api/chatbot/contacto', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(userInfo)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.userInfo = userInfo;
                localStorage.setItem('ists_chatbot_userinfo', JSON.stringify(userInfo));
                this.hideUserInfoModal();
                this.toggleChat();
            } else {
                alert('No se pudo guardar tu información. Intenta de nuevo.');
            }
        })
        .catch(() => {
            alert('Error de conexión. Intenta de nuevo.');
        });
    }

    loadUserInfo() {
        try {
            const info = localStorage.getItem('ists_chatbot_userinfo');
            return info ? JSON.parse(info) : null;
        } catch {
            return null;
        }
    }

    toggleChat() {
        const window = document.getElementById('chatbot-window');
        if (!window) return;
        this.isOpen = !this.isOpen;
        if (this.isOpen) {
            window.style.display = 'block';
            setTimeout(() => {
                window.classList.add('active');
            }, 10);
            this.focusInput();
        } else {
            window.classList.remove('active');
            setTimeout(() => {
                window.style.display = 'none';
            }, 300);
        }
    }

    closeChat() {
        this.isOpen = false;
        const window = document.getElementById('chatbot-window');
        if (window) {
            window.classList.remove('active');
            setTimeout(() => {
                window.style.display = 'none';
            }, 300);
        }
    }

    focusInput() {
        const input = document.getElementById('chatbot-input');
        if (input) {
            setTimeout(() => input.focus(), 100);
        }
    }

    handleSubmit(e) {
        e.preventDefault();
        const input = document.getElementById('chatbot-input');
        const message = input.value.trim();
        if (!message) return;
        this.addMessage(message, 'user');
        input.value = '';
        this.showTypingIndicator();
        this.sendMessage(message);
    }

    addMessage(content, sender) {
        const messagesContainer = document.getElementById('chatbot-messages');
        if (!messagesContainer) return;
        const messageDiv = document.createElement('div');
        messageDiv.className = `${sender}-message`;
        const messageContent = document.createElement('p');
        messageContent.innerHTML = content;
        messageDiv.appendChild(messageContent);
        messagesContainer.appendChild(messageDiv);
        setTimeout(() => {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 100);
        this.messageHistory.push({
            content,
            sender,
            timestamp: new Date().toISOString()
        });
    }

    clearHistory() {
        this.messageHistory = [];
        this.saveChatHistory();
        const messagesContainer = document.getElementById('chatbot-messages');
        if (messagesContainer) {
            const welcomeMessage = messagesContainer.querySelector('.bot-message:first-child');
            messagesContainer.innerHTML = '';
            if (welcomeMessage) {
                messagesContainer.appendChild(welcomeMessage);
            }
        }
    }

    showTypingIndicator() {
        const messagesContainer = document.getElementById('chatbot-messages');
        if (!messagesContainer) return;
        const typingDiv = document.createElement('div');
        typingDiv.className = 'bot-message typing-indicator';
        typingDiv.innerHTML = '<p>El asistente está escribiendo...</p>';
        messagesContainer.appendChild(typingDiv);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        this.typingIndicator = typingDiv;
    }

    hideTypingIndicator() {
        if (this.typingIndicator) {
            this.typingIndicator.remove();
            this.typingIndicator = null;
        }
    }

    sendMessage(message) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        const formData = new FormData();
        formData.append('message', message);
        formData.append('session_id', this.sessionId);
        fetch('/chatbot/send', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            this.hideTypingIndicator();
            if (data.success) {
                this.addMessage(data.response, 'bot');
            } else {
                this.addMessage('Lo siento, ha ocurrido un error. Por favor, inténtalo de nuevo.', 'bot');
            }
        })
        .catch(error => {
            this.hideTypingIndicator();
            this.addMessage('Error de conexión. Por favor, verifica tu conexión a internet.', 'bot');
            console.error('Error:', error);
        });
    }

    generateSessionId() {
        return 'chat_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    }

    loadChatHistory() {
        const savedHistory = localStorage.getItem('ists_chat_history');
        if (savedHistory) {
            try {
                this.messageHistory = JSON.parse(savedHistory);
                this.renderHistory();
            } catch (e) {
                console.error('Error al cargar historial:', e);
            }
        }
    }

    renderHistory() {
        const messagesContainer = document.getElementById('chatbot-messages');
        if (!messagesContainer) return;
        const welcomeMessage = messagesContainer.querySelector('.bot-message:first-child');
        messagesContainer.innerHTML = '';
        if (welcomeMessage) {
            messagesContainer.appendChild(welcomeMessage);
        }
        this.messageHistory.forEach(msg => {
            const messageDiv = document.createElement('div');
            messageDiv.className = `${msg.sender}-message`;
            const messageContent = document.createElement('p');
            if (msg.sender === 'bot') {
                messageContent.innerHTML = msg.content;
            } else {
                messageContent.textContent = msg.content;
            }
            messageDiv.appendChild(messageContent);
            messagesContainer.appendChild(messageDiv);
        });
    }

    saveChatHistory() {
        localStorage.setItem('ists_chat_history', JSON.stringify(this.messageHistory));
    }
}
// --- FIN: Lógica de UI del ChatBot ---

// Inicializar chatbot cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Si no existe el modal, lo agregamos dinámicamente
    if (!document.getElementById('chatbot-userinfo-modal')) {
        const modalHtml = `
        <div id="chatbot-userinfo-modal" style="display:none; position:fixed; z-index:2001; left:0; top:0; width:100vw; height:100vh; background:rgba(30,30,30,0.25); justify-content:center; align-items:center;">
            <div style="background:#fff; border-radius:14px; box-shadow:0 4px 24px rgba(0,0,0,0.13); padding:2.2rem 2.2rem 1.5rem 2.2rem; max-width:350px; width:90vw; text-align:center;">
                <h4 style="color:#009e60; font-weight:700; margin-bottom:1.2rem;">¡Bienvenido!</h4>
                <p style="margin-bottom:1.2rem; color:#333;">Por favor, ingresa tu nombre y número de teléfono para iniciar el chat.</p>
                <form id="chatbot-userinfo-form">
                        <input type="text" id="chatbot-nombre" name="nombre" placeholder="Tu nombre y apellido" maxlength="30" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+( [a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+)+$" title="Ingresa tu nombre y apellido, solo letras y espacios, mínimo dos palabras" required style="width:100%; margin-bottom:0.8rem; padding:0.7rem; border-radius:8px; border:1px solid #ccc;" autocomplete="off" />
                        <input type="tel" id="chatbot-telefono" name="telefono" placeholder="Teléfono" maxlength="10" minlength="10" pattern="^[0-9]{10}$" inputmode="numeric" title="Solo 10 dígitos" required style="width:100%; margin-bottom:0.8rem; padding:0.7rem; border-radius:8px; border:1px solid #ccc;" autocomplete="off" />
                        <select id="chatbot-carrera" name="carrera" required style="width:100%; margin-bottom:0.8rem; padding:0.7rem; border-radius:8px; border:1px solid #ccc;">
                            <option value="" disabled selected>Selecciona una carrera de interés</option>
                        </select>
                        <input type="text" id="chatbot-carrera-otro" name="carrera_otro" placeholder="Especifica otra carrera" maxlength="150" style="width:100%; margin-bottom:1.1rem; padding:0.7rem; border-radius:8px; border:1px solid #ccc; display:none;" autocomplete="off" />
                    <button type="submit" style="width:100%; background:#009e60; color:#fff; font-weight:600; border:none; border-radius:8px; padding:0.8rem; font-size:1.1rem; cursor:pointer;">Comenzar chat</button>
                </form>
            </div>
        </div>`;
        document.body.insertAdjacentHTML('beforeend', modalHtml);
    }
    window.istsChatbot = new ISTSChatbot();

    // Validación en tiempo real para nombre (solo letras y espacios)
    document.addEventListener('input', function(e) {
        if (e.target && e.target.id === 'chatbot-nombre') {
            let val = e.target.value;
            // Solo letras, tildes, ñ, ü y espacios
            val = val.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]/g, '');
            // Limitar a 30 caracteres
            if (val.length > 30) val = val.slice(0, 30);
            e.target.value = val;
        }
    });

    // Validación en tiempo real para teléfono (solo números, máx 10)
    document.addEventListener('input', function(e) {
        if (e.target && e.target.id === 'chatbot-telefono') {
            let val = e.target.value;
            val = val.replace(/[^0-9]/g, '');
            if (val.length > 10) val = val.slice(0, 10);
            e.target.value = val;
        }
    });

    // Listener para botón de limpiar historial
    const clearBtn = document.getElementById('chatbot-clear-history');
    if (clearBtn) {
        clearBtn.onclick = function(e) {
            e.stopPropagation();
            if (confirm('¿Seguro que deseas eliminar el historial de conversaciones?')) {
                window.istsChatbot.clearHistory();
            }
        };
    }

    // --- INICIO: Autocompletado ChatBot (nombre y carrera por teléfono) ---
    observeChatbotUserinfoForm();
    // --- FIN: Autocompletado ---
});

// Guardar historial antes de cerrar la página
window.addEventListener('beforeunload', function() {
    if (window.istsChatbot) {
        window.istsChatbot.saveChatHistory();
    }
    // Limpiar datos del usuario al cerrar la pestaña o navegador
    localStorage.removeItem('ists_chatbot_userinfo');
});

// CSS para el chatbot (copiado del original)
const chatbotStyles = `
<style>
/* ... (aquí iría el CSS del chatbot) ... */
</style>
`;
document.head.insertAdjacentHTML('beforeend', chatbotStyles);

// --- FIN: Código del ChatBot ---

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

    // Autocompletado ChatBot: nombre y carrera por teléfono (dinámico)
    observeChatbotUserinfoForm();
/**
 * Observa el DOM y activa el autocompletado cuando el formulario del ChatBot aparece
 */
function observeChatbotUserinfoForm() {
    // Si ya existe el formulario, inicializa de inmediato
    if (document.getElementById('chatbot-userinfo-form')) {
        initChatbotUserinfoAutocomplete();
        return;
    }
    // Si no, observa el DOM por si aparece dinámicamente
    const observer = new MutationObserver(() => {
        if (document.getElementById('chatbot-userinfo-form')) {
            initChatbotUserinfoAutocomplete();
            observer.disconnect();
        }
    });
    observer.observe(document.body, { childList: true, subtree: true });
}
/**
 * Autocompleta nombre y carrera en el formulario del ChatBot al ingresar el teléfono
 */
function initChatbotUserinfoAutocomplete() {
    const telefonoInput = document.getElementById('chatbot-telefono');
    const nombreInput = document.getElementById('chatbot-nombre');
    const carreraInput = document.getElementById('chatbot-carrera');
    if (!telefonoInput || !nombreInput || !carreraInput) return;

    let lastValue = '';
    telefonoInput.addEventListener('input', function () {
        const value = telefonoInput.value.trim();
        console.log('[ChatBot] Teléfono input:', value);
        // Solo si tiene 10 dígitos y es diferente al último valor buscado
        if (/^\d{10}$/.test(value) && value !== lastValue) {
            lastValue = value;
            console.log('[ChatBot] Consultando API:', `/api/chatbot/contacto/buscar?telefono=${value}`);
            fetch(`/api/chatbot/contacto/buscar?telefono=${value}`)
                .then(res => {
                    console.log('[ChatBot] Respuesta HTTP:', res.status);
                    return res.ok ? res.json() : null;
                })
                .then(data => {
                    console.log('[ChatBot] Respuesta JSON:', data);
                    if (data && data.found && data.nombre) {
                        nombreInput.value = data.nombre;
                        carreraInput.value = data.carrera || '';
                        console.log('[ChatBot] Autocompletado:', data.nombre, data.carrera);
                    } else {
                        // Si no existe, limpiar los campos
                        nombreInput.value = '';
                        carreraInput.value = '';
                        console.log('[ChatBot] No se encontró contacto, campos limpiados');
                    }
                })
                .catch((err) => {
                    nombreInput.value = '';
                    carreraInput.value = '';
                    console.error('[ChatBot] Error en fetch:', err);
                });
        } else if (value.length < 10) {
            nombreInput.value = '';
            carreraInput.value = '';
            console.log('[ChatBot] Teléfono incompleto, campos limpiados');
        }
    });
}
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

// --- INICIO: Cargar carreras dinámicamente y gestionar opción 'Otro' ---
function cargarCarrerasChatbot() {
    fetch('/api/chatbot/carreras')
        .then(res => res.json())
        .then(data => {
            const select = document.getElementById('chatbot-carrera');
            if (!select) return;
            // Limpiar opciones previas
            select.innerHTML = '<option value="" disabled selected>Selecciona una carrera de interés</option>';
            if (data.careers && Array.isArray(data.careers)) {
                data.careers.forEach(c => {
                    const opt = document.createElement('option');
                    opt.value = c.name;
                    opt.textContent = c.name;
                    select.appendChild(opt);
                });
            }
            // Opción Otro
            const optOtro = document.createElement('option');
            optOtro.value = '__otro__';
            optOtro.textContent = 'Otro (especificar)';
            select.appendChild(optOtro);
        });
}

function gestionarCarreraOtro() {
    const select = document.getElementById('chatbot-carrera');
    const inputOtro = document.getElementById('chatbot-carrera-otro');
    if (!select || !inputOtro) return;
    select.addEventListener('change', function() {
        if (this.value === '__otro__') {
            inputOtro.style.display = 'block';
            inputOtro.required = true;
        } else {
            inputOtro.style.display = 'none';
            inputOtro.required = false;
        }
    });
}

// Llamar al cargar el modal
// Si el modal se crea dinámicamente, observarlo
document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('chatbot-carrera')) {
        cargarCarrerasChatbot();
        gestionarCarreraOtro();
    }
    const observer = new MutationObserver(() => {
        if (document.getElementById('chatbot-carrera')) {
            cargarCarrerasChatbot();
            gestionarCarreraOtro();
            observer.disconnect();
        }
    });
    observer.observe(document.body, { childList: true, subtree: true });
});
// --- FIN: Cargar carreras dinámicamente y gestionar opción 'Otro' ---