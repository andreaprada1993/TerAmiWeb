{{-- resources/views/components/chatbot.blade.php --}}

<div class="chatbot-box shadow-lg rounded p-3"
     style="position: fixed; bottom: 10px; right: 10px; width: 300px; background: white; z-index: 1000;">
    
    {{-- Encabezado con botón minimizar --}}
    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
        <div style="display: flex; align-items: center;">
            <img src="{{ asset('img/mapache.png') }}" alt="Mapache" style="width: 40px; margin-right: 10px;">
            <strong>Asistente Mapache</strong>
        </div>
        <button id="minimizarBtn" class="btn btn-sm btn-outline-secondary"
                style="height: 30px; line-height: 1;">–</button>
    </div>

    {{-- Contenido que se minimiza --}}
    <div id="chatContenido">
        <div id="chatBody"
             style="height: 200px; overflow-y: auto; background: #f8f9fa; padding: 10px; border-radius: 6px; margin-bottom: 10px;">
        </div>
        <div style="display: flex;">
            <input id="userInput" type="text" class="form-control me-2" placeholder="Escribe tu pregunta..." />
            <button id="sendBtn" class="btn btn-primary">Enviar</button>
        </div>
    </div>
</div>
