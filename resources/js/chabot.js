console.log('chatbot cargado');

document.addEventListener('DOMContentLoaded', function () {
    const sendBtn = document.getElementById('sendBtn');
    const userInput = document.getElementById('userInput');
    const chatBody = document.getElementById('chatBody');
    const minimizarBtn = document.getElementById('minimizarBtn');
    const chatContenido = document.getElementById('chatContenido');

    let minimizado = false;

    if (minimizarBtn && chatContenido) {
        minimizarBtn.addEventListener('click', function () {
            minimizado = !minimizado;
            chatContenido.style.display = minimizado ? 'none' : 'block';
            minimizarBtn.textContent = minimizado ? '+' : '–';
        });
    }

    function sendMessage() {
        const msg = userInput.value.trim();
        if (!msg) return;

        chatBody.innerHTML += `<div class="text-end text-primary mb-2">${msg}</div>`;
        userInput.value = '';

        setTimeout(() => {
            const respuesta = obtenerRespuestaSimulada(msg);
            chatBody.innerHTML += `<div class="text-start bg-light p-2 rounded mb-2">🦝 ${respuesta}</div>`;
            chatBody.scrollTop = chatBody.scrollHeight;
        }, 500);
    }

    function obtenerRespuestaSimulada(mensaje) {
        mensaje = mensaje.toLowerCase();
        if (mensaje.includes('hola')) return '¡Hola! Soy tu asistente. ¿En qué te ayudo?';
        if (mensaje.includes('tarea')) return 'Puedes agregar tareas desde el botón ➕ Agregar Nueva Tarea.';
        if (mensaje.includes('seguimiento')) return 'Revisa tus tareas en la sección de 📊 Seguimiento.';
        return 'Lo siento, no entiendo esa pregunta todavía.';
    }

    if (sendBtn && userInput && chatBody) {
        sendBtn.addEventListener('click', sendMessage);
        userInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                sendMessage();
            }
        });
    }
    console.log('✅ chatbot cargado');
});
