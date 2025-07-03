@extends('layouts.app')

@section('content')

@section('content')
  @auth
    <div class="d-flex justify-content-center align-items-center position-relative overflow-hidden"
         style="min-height: 100vh;">

      <!-- Imagen de fondo con animación -->
      <img src="{{ asset('img/carrusel.jpg') }}" class="position-absolute w-100 h-100 object-fit-cover responsive-bg"
           style="z-index: 1; animation: zoomIn 15s ease-in-out infinite alternate;" alt="Fondo TerAmi">

      <!-- Texto y botón sobre la imagen -->
      <div class="text-center text-white position-relative"
           style="z-index: 2; background-color: rgba(0, 0, 0, 0.4); padding: 2rem; border-radius: 1rem;">
        <h2 class="mb-3">¡Gracias por preferir <span style="color: #c8c6ff;">TerAmi</span>!</h2>
        <a href="{{ route('home') }}" class="btn btn-light btn-lg">Ir al Inicio</a>
      </div>
    </div>

    <!-- Animación CSS -->
    <style>
      @keyframes zoomIn {
        0% {
          transform: scale(1);
        }

        100% {
          transform: scale(1.05);
        }
      }

      .object-fit-cover {
        object-fit: cover;
      }

      @media (max-width: 768px) {
        .responsive-bg {
          object-fit: contain !important;
          height: auto !important;
        }
      }
    </style>
  @endauth

  @guest
    <!-- Carrusel -->
    <div id="carouselBienvenida" class="carousel slide carousel-fade" data-bs-ride="carousel">
      <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active" data-bs-interval="8000">
          <div class="carousel-slide bg-terami-1">
            <div class="logo-inside-slide">
              <img src="{{ asset('img/logo.png') }}" alt="TerAmi" class="logo-img">
            </div>
            <div class="overlay-text">
              <h1>Bienvenido a <span class="text-accent">TerAmiWeb</span></h1>
              <p>Organiza tu día fácilmente</p>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" data-bs-interval="8000">
          <div class="carousel-slide bg-terami-2">
            <div class="logo-inside-slide">
              <img src="{{ asset('img/logo.png') }}" alt="TerAmi" class="logo-img">
            </div>
            <div class="overlay-text">
              <h1>Gestiona tus metas</h1>
              <p>Visualiza y cumple objetivos fácilmente</p>
              <a href="{{ route('login') }}" class="btn btn-light m-2">Iniciar sesión</a>
              <a href="{{ route('register') }}" class="btn btn-outline-light m-2">Registrarse</a>
            </div>
          </div>
        </div>

        <!-- Slide 3 corregido -->
        <div class="carousel-item" data-bs-interval="false">
          <div class="carousel-slide bg-terami-3">
            <div class="logo-inside-slide">
              <img src="{{ asset('img/logo.png') }}" alt="TerAmi" class="logo-img">
            </div>
            <div class="overlay-text">
              <h1>Únete a <span class="text-accent">TerAmiWeb</span></h1>
              <p>Haz parte de la comunidad que transforma su rutina</p>
              <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="{{ route('login') }}" class="btn btn-light btn-slide3">Iniciar sesión</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-slide3">Registrarse</a>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!-- Controles -->
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselBienvenida" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselBienvenida" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>

    <!-- Estilos generales -->
    <style>
      html, body {
        height: 100%;
        overflow-x: hidden;
      }

      body {
        margin: 0;
        padding: 0;
        background-color: #e9ecef;
      }

      .carousel,
      .carousel-inner,
      .carousel-item {
        height: 100vh;
      }

      .carousel-item {
        min-height: 100vh;
        overflow-y: auto;
      }

      .carousel-slide {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100%;
        background-size: cover;
        background-position: center;
        position: relative;
        filter: brightness(0.95);
      }

      .bg-terami-1 {
        background: linear-gradient(135deg, #c8c6ff, #f2f2f2);
      }

      .bg-terami-2 {
        background: linear-gradient(135deg, #d1ecff, #ffffff);
      }

      .bg-terami-3 {
        background: linear-gradient(135deg, #f8e1ff, #ffffff);
      }

      .text-accent {
        color: #6f42c1;
      }

      .logo-inside-slide {
        position: absolute;
        top: 80px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
      }

      .logo-img {
        width: 160px;
        opacity: 0.9;
        transition: opacity 0.3s ease;
      }

      .logo-img:hover {
        opacity: 1;
      }

      .overlay-text {
        text-align: center;
        color: #343a40;
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        padding: 2rem;
        border-radius: 1rem;
        max-width: 90%;
        background-color: rgba(255, 255, 255, 0.85);
      }

      .overlay-text h1 {
        font-size: 3rem;
        font-weight: bold;
      }

      .overlay-text p {
        font-size: 1.5rem;
      }

      .btn {
        font-size: 1.1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      }

      .btn-slide3 {
        width: auto;
      }

      @media (max-width: 768px) {
        .logo-img {
          width: 90px;
        }

        .overlay-text {
          padding: 1.2rem;
          max-width: 95%;
        }

        .overlay-text h1 {
          font-size: 2rem;
        }

        .overlay-text p {
          font-size: 1rem;
        }

        .btn {
          font-size: 1rem;
          padding: 0.5rem 1rem;
        }
      }

      @media (max-width: 576px) {
        .btn-slide3 {
          width: 100%;
        }

        .logo-img {
          width: 80px;
        }

        .overlay-text h1 {
          font-size: 1.6rem;
        }

        .overlay-text p {
          font-size: 0.95rem;
        }

        .overlay-text {
          padding: 1rem;
        }

        .logo-inside-slide {
          top: 20px;
        }
      }
    </style>
  @endguest

@endsection
