{{-- Este es el inicio de la pagina --}}
@extends('layouts.app')

@section('content')
@section('title', 'Dashboard')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container mt-5">

        {{-- Bienvenida --}}
        <div class="text-center mb-4">
            <img src="{{ asset('img/mapacheLogo.png') }}" alt="Logo TerAmi" height="80">
            <h1 class="mt-3">¡Bienvenido a TerAmi!</h1>
        </div>

        {{-- Card de Tareas Pendientes --}}
        <div class="card shadow">
            <div class="card-header bg-secondary text-white">
                📌 Tareas Pendientes
            </div>
            <div class="card-body">
                @if($tareasPendientes->count())
                    <ul class="list-group">
                        @foreach($tareasPendientes as $tarea)
                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                <a href="{{ route('evento.index') }}" class="text-decoration-none text-dark">
                                    {{ $tarea->title }}
                                </a>
                                <span class="badge bg-info text-dark">
                                    {{ \Carbon\Carbon::parse($tarea->start)->format('d/m/Y H:i') }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No tienes tareas pendientes.</p>
                @endif
            </div>
        </div>
        {{-- bot--}}
        <div class="chatbot-box shadow-lg rounded p-3"
            style="position: fixed; bottom: 10px; right: 10px; width: 300px; background: white; z-index: 1000;">
            <div style="display: flex; align-items: center; margin-bottom: 10px;">
                <img src="https://i.ibb.co/xMC9Fjz/mapache.png" alt="Mapache" style="width: 40px; margin-right: 10px;">
                <strong>Asistente Mapache</strong>
            </div>
            <div id="chatBody"
                style="height: 200px; overflow-y: auto; background: #f8f9fa; padding: 10px; border-radius: 6px; margin-bottom: 10px;">
            </div>
            <div style="display: flex;">
                <input id="userInput" type="text" class="form-control me-2" placeholder="Escribe tu pregunta..." />
                <button id="sendBtn" class="btn btn-primary">Enviar</button>
            </div>
        </div>
        @section('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const sendBtn = document.getElementById('sendBtn');
                    const userInput = document.getElementById('userInput');
                    const chatBody = document.getElementById('chatBody');

                    function sendMessage() {
                        const msg = userInput.value.trim();
                        if (!msg) return;

                        // Mostrar mensaje del usuario
                        chatBody.innerHTML += `<div class="text-end text-primary mb-2">${msg}</div>`;
                        chatBody.innerHTML += `<div class="text-muted mb-2">🦝 escribiendo...</div>`;
                        chatBody.scrollTop = chatBody.scrollHeight;
                        userInput.value = '';

                        // Enviar al backend
                        fetch('http://127.0.0.1:8000/api/chatbot', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ mensaje: msg })
                        })
                            .then(res => res.json())
                            .then(data => {
                                chatBody.innerHTML += `<div class="text-start bg-light p-2 rounded mb-2">${data.answer}</div>`;
                            })
                            .catch(() => {
                                chatBody.innerHTML += `<div class="text-danger mb-2">❌ Error al conectar con el asistente</div>`;
                            });
                    }

                    // Escuchar botón
                    sendBtn.addEventListener('click', sendMessage);

                    // Escuchar Enter
                    userInput.addEventListener('keypress', function (e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            sendMessage();
                        }
                    });
                });
            </script>
        @endsection

        @yield('scripts')
        @section('scripts')
            <script src="{{ asset('js/api.js') }}"></script>
        @endsection
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection