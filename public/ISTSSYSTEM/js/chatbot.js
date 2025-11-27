/**
 * Chatbot JavaScript - Sistema ISTS
 * Funcionalidad del asistente virtual
 */

class ISTSChatbot {
    constructor() {
        this.isOpen = false;
        this.sessionId = this.generateSessionId();
        this.messageHistory = [];
        
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
        
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => this.toggleChat());
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
        messageContent.textContent = content;
        messageDiv.appendChild(messageContent);
        
            messagesContainer.appendChild(messageDiv);
            // Scroll automático al final (siempre baja hasta el último mensaje)
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
        this.renderHistory();
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
        const formData = new FormData();
        formData.append('message', message);
        formData.append('session_id', this.sessionId);
        formData.append('csrf_token', document.querySelector('input[name="csrf_token"]')?.value || '');
        
        fetch('/chatbot/send', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
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
            this.addMessage(msg.content, msg.sender);
        });
    }
    
    saveChatHistory() {
        localStorage.setItem('ists_chat_history', JSON.stringify(this.messageHistory));
    }
}

// Inicializar chatbot cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    window.istsChatbot = new ISTSChatbot();
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
});

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