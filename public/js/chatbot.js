/**
 * Chatbot JavaScript - Sistema ISTS
 * Funcionalidad del asistente virtual
 */

class ISTSChatbot {
    constructor() {
        this.isOpen = false;
        this.sessionId = this.generateSessionId();
        this.messageHistory = [];
        
        // Guardar instancia global
        window.istsChatbot = this;

        this.init();
    }

    init() {
        this.bindEvents();
        this.loadChatHistory();
        
        // Agregar mensaje de bienvenida si no hay historial
        if (this.messageHistory.length === 0) {
            this.addWelcomeMessage();
        }
    }
    
    addWelcomeMessage() {
        const messagesContainer = document.getElementById('chatbot-messages');
        if (!messagesContainer) return;
        
        // Solo agregar si no existe ya un mensaje de bienvenida
        const existingWelcome = messagesContainer.querySelector('.welcome-message');
        if (!existingWelcome) {
            const welcomeDiv = document.createElement('div');
            welcomeDiv.className = 'bot-message welcome-message';
            welcomeDiv.innerHTML = '<p>¡Hola! 👋 Soy el asistente virtual del ISTS. ¿En qué puedo ayudarte?</p>';
            messagesContainer.appendChild(welcomeDiv);
        }
    }

    bindEvents() {
        const toggleBtn = document.getElementById('chatbot-toggle');
        const closeBtn = document.getElementById('chatbot-close');
        const clearBtn = document.getElementById('chatbot-clear');
        const form = document.getElementById('chatbot-form');
        const input = document.getElementById('chatbot-input');

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => this.toggleChat());
        }

        if (closeBtn) {
            closeBtn.addEventListener('click', () => this.closeChat());
        }
        
        if (clearBtn) {
            clearBtn.addEventListener('click', () => {
                if (confirm('¿Estás seguro de que quieres limpiar toda la conversación?')) {
                    this.clearHistory();
                    this.addWelcomeMessage();
                }
            });
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
    }

    toggleChat() {
        const window = document.getElementById('chatbot-window');
        if (!window) return;

        this.isOpen = !this.isOpen;

        if (this.isOpen) {
            window.style.display = 'flex';
            setTimeout(() => {
                window.classList.add('active');
            }, 10);
            this.focusInput();
            
            // Scroll al final si hay mensajes
            setTimeout(() => {
                const messagesContainer = document.getElementById('chatbot-messages');
                if (messagesContainer) {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            }, 100);
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
        messageContent.textContent = content;
        messageDiv.appendChild(messageContent);

        messagesContainer.appendChild(messageDiv);

        // Scroll al final con animación suave
        setTimeout(() => {
            messagesContainer.scrollTo({
                top: messagesContainer.scrollHeight,
                behavior: 'smooth'
            });
        }, 50);

        // Guardar en historial
        this.messageHistory.push({
            content,
            sender,
            timestamp: new Date().toISOString()
        });
        
        // Guardar en localStorage inmediatamente
        this.saveChatHistory();
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
        fetch('/api/chatbot', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ mensaje: message })
        })
            .then(response => response.json())
            .then(data => {
                this.hideTypingIndicator();

                if (data.success) {
                    this.addMessage(data.respuesta, 'bot');
                } else {
                    this.addMessage(data.respuesta || 'Lo siento, no entendí tu pregunta.', 'bot');
                }
            })
            .catch(error => {
                this.hideTypingIndicator();
                this.addMessage('Error de conexión. Verifica tu internet.', 'bot');
                console.error('Error:', error);
            });
    }

    generateSessionId() {
        return 'chat_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
    }

    loadChatHistory() {
        const messagesContainer = document.getElementById('chatbot-messages');
        if (!messagesContainer) return;
        
        // Cargar historial desde localStorage
        const savedHistory = localStorage.getItem('ists_chat_history');
        if (savedHistory) {
            try {
                this.messageHistory = JSON.parse(savedHistory);
                
                // Renderizar historial después de la bienvenida
                this.messageHistory.forEach(msg => {
                    const messageDiv = document.createElement('div');
                    messageDiv.className = `${msg.sender}-message`;
                    
                    const messageContent = document.createElement('p');
                    messageContent.textContent = msg.content;
                    messageDiv.appendChild(messageContent);
                    
                    messagesContainer.appendChild(messageDiv);
                });
                
                // Hacer scroll al final
                setTimeout(() => {
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }, 100);
            } catch (e) {
                console.error('Error al cargar historial:', e);
                this.messageHistory = [];
            }
        }
    }

    renderHistory() {
        const messagesContainer = document.getElementById('chatbot-messages');
        if (!messagesContainer) return;

        // Limpiar solo los mensajes dinámicos, mantener bienvenida
        const dynamicMessages = messagesContainer.querySelectorAll('.user-message, .bot-message:not(.welcome-message)');
        dynamicMessages.forEach(msg => msg.remove());

        // Renderizar historial
        this.messageHistory.forEach(msg => {
            const messageDiv = document.createElement('div');
            messageDiv.className = `${msg.sender}-message`;
            
            const messageContent = document.createElement('p');
            messageContent.textContent = msg.content;
            messageDiv.appendChild(messageContent);
            
            messagesContainer.appendChild(messageDiv);
        });
        
        // Scroll al final
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    saveChatHistory() {
        try {
            localStorage.setItem('ists_chat_history', JSON.stringify(this.messageHistory));
        } catch (e) {
            console.error('Error al guardar historial:', e);
        }
    }
    
    clearHistory() {
        this.messageHistory = [];
        localStorage.removeItem('ists_chat_history');
        this.renderHistory();
    }
}

// Inicializar chatbot cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function () {
    if (!window.istsChatbot) {
        window.istsChatbot = new ISTSChatbot();
    }
});

// Guardar historial antes de cerrar la página
window.addEventListener('beforeunload', function () {
    if (window.istsChatbot) {
        window.istsChatbot.saveChatHistory();
    }
});

// Guardar historial periódicamente cada 30 segundos
setInterval(() => {
    if (window.istsChatbot) {
        window.istsChatbot.saveChatHistory();
    }
}, 30000);

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
    background: linear-gradient(135deg, #00A86B 0%, #1E3A8A 100%);
    color: white;
    border: none;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 168, 107, 0.4);
    transition: all 0.3s ease;
}

.chatbot-toggle:hover {
    background: linear-gradient(135deg, #008C5A 0%, #162d6b 100%);
    transform: scale(1.1);
    box-shadow: 0 6px 16px rgba(0, 168, 107, 0.5);
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
    background: linear-gradient(135deg, #00A86B 0%, #1E3A8A 100%);
    color: white;
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
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.user-message, .bot-message {
    max-width: 80%;
    padding: 10px 15px;
    border-radius: 15px;
    word-wrap: break-word;
}

.user-message {
    background: linear-gradient(135deg, #00A86B 0%, #008C5A 100%);
    color: white;
    align-self: flex-end;
    border-bottom-right-radius: 5px;
}

.bot-message {
    background: #f1f1f1;
    color: #333;
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
    background: linear-gradient(135deg, #00A86B 0%, #1E3A8A 100%);
    color: white;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.chatbot-form button:hover {
    background: linear-gradient(135deg, #008C5A 0%, #162d6b 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 168, 107, 0.4);
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