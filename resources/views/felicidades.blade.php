@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <canvas id="confetti-canvas" style="position:fixed; top:0; left:0; width:100%; height:100%; z-index:999;"></canvas>

    <!-- Logo -->
    <div class="mb-4">
        <img src="{{ asset('img/logo.png') }}" alt="TerAmi Logo" style="max-width: 140px;">
    </div>

    <h1 class="display-4 mb-4">🎉 ¡Felicidades!</h1>
    <p class="lead">Te has registrado exitosamente en <strong>TerAmi</strong></p>
    <p>Estamos felices de que formes parte de nuestra comunidad.</p>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<script>
    const canvas = document.getElementById('confetti-canvas');
    const myConfetti = confetti.create(canvas, { resize: true, useWorker: true });

    // Lanza confeti varias veces durante 3 segundos
    const duration = 3 * 1000; // 3 segundos
    const interval = 250; // cada 250ms

    let end = Date.now() + duration;

    const intervalId = setInterval(function () {
        if (Date.now() > end) {
            clearInterval(intervalId);
        }

        myConfetti({
            particleCount: 50,
            spread: 160,
            origin: { y: Math.random() - 0.2 } // más natural
        });
    }, interval);
</script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
