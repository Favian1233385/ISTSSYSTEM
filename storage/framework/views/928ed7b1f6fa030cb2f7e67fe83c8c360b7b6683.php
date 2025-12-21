<div class="chatbot-widget">
    <button id="chatbot-toggle" class="chatbot-toggle" aria-label="Abrir chat">
        💬
    </button>
    <div id="chatbot-window" class="chatbot-window" style="display:none;">
        <div class="chatbot-header">
            <h3>Asistente ISTS</h3>
            <button id="chatbot-close" aria-label="Cerrar chat">&times;</button>
        </div>
        <div id="chatbot-messages" class="chatbot-messages">
            <div class="bot-message">
                <p>¡Hola! Soy el asistente virtual del ISTS. ¿En qué puedo ayudarte hoy?</p>
            </div>
        </div>
        <form id="chatbot-form" class="chatbot-form">
            <input id="chatbot-input" type="text" placeholder="Escribe tu mensaje..." autocomplete="off" required />
            <button type="submit">Enviar</button>
        </form>
    </div>
</div>
<div id="chatbot-userinfo-modal" style="display:none; position:fixed; z-index:2001; left:0; top:0; width:100vw; height:100vh; background:rgba(30,30,30,0.25); justify-content:center; align-items:center;">
    <div style="background:#fff; border-radius:14px; box-shadow:0 4px 24px rgba(0,0,0,0.13); padding:2.2rem 2.2rem 1.5rem 2.2rem; max-width:350px; width:90vw; text-align:center;">
        <h4 style="color:#009e60; font-weight:700; margin-bottom:1.2rem;">¡Bienvenido!</h4>
        <p style="margin-bottom:1.2rem; color:#333;">Por favor, ingresa tu nombre y número de teléfono para iniciar el chat.</p>
        <form id="chatbot-userinfo-form">
            <input type="text" id="chatbot-nombre" name="nombre" placeholder="Tu nombre" maxlength="120" required style="width:100%; margin-bottom:0.8rem; padding:0.7rem; border-radius:8px; border:1px solid #ccc;" />
            <input type="tel" id="chatbot-telefono" name="telefono" placeholder="Teléfono" maxlength="30" required style="width:100%; margin-bottom:1.1rem; padding:0.7rem; border-radius:8px; border:1px solid #ccc;" />
            <button type="submit" style="width:100%; background:#009e60; color:#fff; font-weight:600; border:none; border-radius:8px; padding:0.8rem; font-size:1.1rem; cursor:pointer;">Comenzar chat</button>
        </form>
    </div>
</div>
<?php /**PATH C:\workspace\ISTSSYSTEM\resources\views/public/partials/chatbot_widget.blade.php ENDPATH**/ ?>