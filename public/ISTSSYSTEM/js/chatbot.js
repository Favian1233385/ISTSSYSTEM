/**
 * Chatbot JavaScript - Sistema ISTS
 * Funcionalidad del asistente virtual
 */

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
        // Eliminado: mostrar modal al cargar la página
        // El modal solo se mostrará tras el clic en el ícono del chatbot
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
                    // NO abrir el chat hasta que se valide el usuario
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
        // Si existe un campo de carrera, tomarlo
        const carreraInput = document.getElementById('chatbot-carrera');
        if (carreraInput) {
            carrera = carreraInput.value.trim();
        }

        // Validar nombre: solo letras, mínimo 2 palabras, máximo 30 caracteres
        if (!nombre || nombre.length > 30) {
            alert('El nombre es obligatorio y debe tener máximo 30 caracteres.');
            return;
        }
        // Debe tener al menos dos palabras
        const palabras = nombre.split(/\s+/).filter(Boolean);
        if (palabras.length < 2) {
            alert('Por favor, ingresa tu nombre y apellido.');
            return;
        }
        // Validar que solo tenga letras y espacios
        if (!/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/.test(nombre)) {
            alert('El nombre solo puede contener letras y espacios.');
            return;
        }
        // Capitalizar cada palabra (primera letra en mayúscula)
        nombre = palabras.map(p => p.charAt(0).toUpperCase() + p.slice(1).toLowerCase()).join(' ');
        document.getElementById('chatbot-nombre').value = nombre;

        // Validar teléfono: solo números, exactamente 10 dígitos
        if (!/^[0-9]{10}$/.test(telefono)) {
            alert('El número de teléfono debe contener exactamente 10 dígitos.');
            return;
        }

        // Guardar en backend
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
                // Solo aquí abrir el chat
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
        
        // Agregar mensaje del usuario
        this.addMessage(message, 'user');
        
        // Limpiar input
        input.value = '';
        
        // Mostrar indicador de escritura
        this.showTypingIndicator();
        
        // Enviar mensaje al servidor
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
        
        // Scroll automático al final
        setTimeout(() => {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 100);
        
        // Guardar en historial
        this.messageHistory.push({
            content,
            sender,
            timestamp: new Date().toISOString()
        });
    }

    clearHistory() {
        this.messageHistory = [];
        this.saveChatHistory();
        
        // Limpiar mensajes visuales
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
        // Obtener token CSRF del meta tag
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
        // Cargar historial desde localStorage
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
        
        // Limpiar mensajes existentes (excepto el mensaje de bienvenida)
        const welcomeMessage = messagesContainer.querySelector('.bot-message:first-child');
        messagesContainer.innerHTML = '';
        
        if (welcomeMessage) {
            messagesContainer.appendChild(welcomeMessage);
        }
        
        // Renderizar historial
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

// Inicializar chatbot cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Si no existe el modal, lo agregamos dinámicamente
    if (!document.getElementById('chatbot-userinfo-modal')) {
        const modalHtml = `
        <div id=\"chatbot-userinfo-modal\" style=\"display:none; position:fixed; z-index:2001; left:0; top:0; width:100vw; height:100vh; background:rgba(30,30,30,0.25); justify-content:center; align-items:center;\">
            <div style=\"background:#fff; border-radius:14px; box-shadow:0 4px 24px rgba(0,0,0,0.13); padding:2.2rem 2.2rem 1.5rem 2.2rem; max-width:350px; width:90vw; text-align:center;\">
                <h4 style=\"color:#009e60; font-weight:700; margin-bottom:1.2rem;\">¡Bienvenido!</h4>
                <p style=\"margin-bottom:1.2rem; color:#333;\">Por favor, ingresa tu nombre y número de teléfono para iniciar el chat.</p>
                <form id=\"chatbot-userinfo-form\">
                        <input type=\"text\" id=\"chatbot-nombre\" name=\"nombre\" placeholder=\"Tu nombre y apellido\" maxlength=\"30\" pattern=\"^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+( [a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+)+$\" title=\"Ingresa tu nombre y apellido, solo letras y espacios, mínimo dos palabras\" required style=\"width:100%; margin-bottom:0.8rem; padding:0.7rem; border-radius:8px; border:1px solid #ccc;\" autocomplete=\"off\" />
                        <input type=\"tel\" id=\"chatbot-telefono\" name=\"telefono\" placeholder=\"Teléfono\" maxlength=\"10\" minlength=\"10\" pattern=\"^[0-9]{10}$\" inputmode=\"numeric\" title=\"Solo 10 dígitos\" required style=\"width:100%; margin-bottom:0.8rem; padding:0.7rem; border-radius:8px; border:1px solid #ccc;\" autocomplete=\"off\" />
                        <input type="text" id="chatbot-carrera" name="carrera" placeholder="Carrera de interés" maxlength="150" style="width:100%; margin-bottom:1.1rem; padding:0.7rem; border-radius:8px; border:1px solid #ccc;" required autocomplete="off" />
                    <button type=\"submit\" style=\"width:100%; background:#009e60; color:#fff; font-weight:600; border:none; border-radius:8px; padding:0.8rem; font-size:1.1rem; cursor:pointer;\">Comenzar chat</button>
                </form>
            </div>
        </div>`;
        document.body.insertAdjacentHTML('beforeend', modalHtml);
            // Cargar carreras dinámicamente

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
    
    // Agregar botón de limpiar historial
    const header = document.querySelector('.chatbot-header');
    if (header) {
        const clearBtn = document.createElement('button');
        clearBtn.textContent = '🗑️';
        clearBtn.title = 'Eliminar historial';
        clearBtn.style.marginLeft = '8px';
        clearBtn.style.background = 'none';
        clearBtn.style.border = 'none';
        clearBtn.style.color = '#fff';
        clearBtn.style.fontSize = '18px';
        clearBtn.style.cursor = 'pointer';
        clearBtn.onclick = function(e) {
            e.stopPropagation();
            if (confirm('¿Seguro que deseas eliminar el historial de conversaciones?')) {
                window.istsChatbot.clearHistory();
            }
        };
        header.appendChild(clearBtn);
    }
});

// Guardar historial antes de cerrar la página
window.addEventListener('beforeunload', function() {
    if (window.istsChatbot) {
        window.istsChatbot.saveChatHistory();
    }
    // Limpiar datos del usuario al cerrar la pestaña o navegador
    localStorage.removeItem('ists_chatbot_userinfo');
});
// CSS para el chatbot
// CSS para el chatbot
const chatbotStyles = `
<style>
.chatbot-widget {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
}

.chatbot-toggle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #009e60;
    color: #fff;
    border: none;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
}

.chatbot-toggle:hover {
    background: #0e3e49;
    transform: scale(1.1);
}

.chatbot-window {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 350px;
    height: 500px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.2);
    display: flex;
    flex-direction: column;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.chatbot-window.active {
    opacity: 1;
    transform: translateY(0);
}

.chatbot-header {
    background: #009e60;
    color: #fff;
    padding: 15px;
    border-radius: 10px 10px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chatbot-header h3 {
    margin: 0;
    font-size: 16px;
}

.chatbot-header button {
    background: none;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
}

.chatbot-messages {
    flex: 1;
    padding: 15px;
    overflow-y: auto;
    max-height: 350px;
    min-height: 120px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    scroll-behavior: smooth;
}

.user-message, .bot-message {
    max-width: 80%;
    padding: 10px 15px;
    border-radius: 15px;
    word-wrap: break-word;
}

.user-message {
    background: #009e60;
    color: #fff;
    align-self: flex-end;
    border-bottom-right-radius: 5px;
}

.bot-message {
    background: #e8f5f1;
    color: #0e3e49;
    align-self: flex-start;
    border-bottom-left-radius: 5px;
}

.typing-indicator {
    opacity: 0.7;
    font-style: italic;
}

.chatbot-form {
    padding: 15px;
    border-top: 1px solid #eee;
    display: flex;
    gap: 10px;
}

.chatbot-form input {
    flex: 1;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 20px;
    outline: none;
}

.chatbot-form button {
    padding: 10px 15px;
    background: #009e60;
    color: #fff;
    border: none;
    border-radius: 20px;
    cursor: pointer;
}

.chatbot-form button:hover {
    background: #0e3e49;
}

@media (max-width: 480px) {
    .chatbot-window {
        width: calc(100vw - 40px);
        right: -10px;
    }
}
</style>
`;

// Insertar estilos
document.head.insertAdjacentHTML('beforeend', chatbotStyles);
// Insertar estilos
document.head.insertAdjacentHTML('beforeend', chatbotStyles);