<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GEPROC - Sistema de Gestión</title>

    <!-- === ESTILOS === -->
<style>
:root {
    --primary: #0744b6ff;
    --primary-light: #2c6ae5;
    --primary-dark: #053494;
    --text-dark: #1a202c;
    --text-light: #596170;
    --bg-light: #f7f9fc;
    --gray-border: #dce3ee;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    scroll-behavior: smooth;
}

body {
    font-family: "Inter", sans-serif;
    background: var(--bg-light);
    color: var(--text-dark);
    overflow-x: hidden;
}

/* HEADER FIXED */
.header {
    width: 100%;
    padding: 16px 40px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: fixed;
    background: #fff;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 15px rgba(0,0,0,.05);
}

/* LOGO */
.logo-container { 
    display: flex; 
    align-items: center; 
    gap: 12px; 
    height: 40px;
}
.logo-img { 
    width: 70px;
    height: 70px;
    border-radius: 8px; 
    object-fit: contain;
}

/* NAV */
nav a {
    margin: 0 18px;
    text-decoration: none;
    color: var(--text-dark);
    font-weight: 500;
    font-size: 1rem;
    position: relative;
    padding-bottom: 5px;
}
nav a:hover,
nav a.active { color: var(--primary); }
nav a.active::after,
nav a:hover::after {
    content:"";
    position: absolute;
    bottom: 0; left: 0;
    height: 3px; width: 100%;
    background: var(--primary);
}

/* MODIFICACIONES PARA MEJORAR VISIBILIDAD DEL FORMULARIO */
.login-overlay .input-with-icon input::placeholder {
    color: rgb(255, 255, 255) !important;
    opacity: 1;
}

.login-overlay .input-with-icon input::-webkit-input-placeholder {
    color: rgb(255, 255, 255) !important;
}

.login-overlay .input-with-icon input::-moz-placeholder {
    color: rgb(255, 255, 255) !important;
    opacity: 1;
}

.login-overlay .input-with-icon input:-ms-input-placeholder {
    color: rgb(255, 255, 255) !important;
}

.login-overlay .input-with-icon input:-moz-placeholder {
    color: rgb(255, 255, 255) !important;
    opacity: 1;
}

.login-overlay .input-with-icon input {
    color: white !important;
}

.login-overlay .form-group label {
    color: white !important;
    font-weight: 600;
}

.login-overlay .forgot-password {
    color: rgba(255, 255, 255, 0.95) !important;
    font-weight: 600;
}

.login-overlay .register-link {
    color: rgba(255, 255, 255, 0.95) !important;
}

.login-overlay .register-link a {
    color: white !important;
    font-weight: 700;
}

.login-overlay .input-with-icon i {
    color: rgba(255, 255, 255, 0.95) !important;
}

.login-overlay .input-with-icon .password-toggle {
    color: rgba(255, 255, 255, 0.95) !important;
}

.login-overlay .input-with-icon .password-toggle:hover {
    color: white !important;
}

.login-overlay .input-with-icon input {
    border: 1px solid rgba(255, 255, 255, 0.4) !important;
    background: rgba(255, 255, 255, 0.15) !important;
}

.login-overlay .input-with-icon input:focus {
    border-color: rgba(255, 255, 255, 0.8) !important;
    background: rgba(255, 255, 255, 0.2) !important;
}

.login-overlay .alert {
    color: white !important;
    background: rgba(255, 255, 255, 0.2) !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
}

/* CONTENEDOR DE LOGIN - PARA ESCRITORIO */
.login-overlay {
    position: absolute;
    top: 50%;
    right: 8%;
    transform: translateY(-50%);
    width: 380px; /* REDUCIDO DE 420px */
    background: rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 25px; /* REDUCIDO DE 30px */
    z-index: 100;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
}

.login-overlay .login-form form {
    background: rgba(255, 255, 255, 0.08);
    padding: 20px 25px; /* REDUCIDO DE 25px 30px */
    border-radius: 10px;
    color: white;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.login-overlay .login-header {
    text-align: center;
    margin-bottom: 15px; /* REDUCIDO DE 20px */
}

.login-overlay .login-header h1 {
    font-size: 1.6rem; /* REDUCIDO DE 1.8rem */
    color: white;
    margin-bottom: 6px; /* REDUCIDO DE 8px */
    font-weight: 700;
    text-shadow: 0 2px 6px rgba(0,0,0,0.8);
    letter-spacing: 0.3px;
}

.login-overlay .login-header h1:after {
    display: none;
}

.login-overlay .form-group label {
    display: block;
    margin-bottom: 6px; /* REDUCIDO DE 8px */
    color: rgba(255, 255, 255, 0.95);
    font-weight: 500;
    font-size: 0.9rem; /* REDUCIDO DE 0.95rem */
}

.login-overlay .input-with-icon {
    position: relative;
    margin-bottom: 4px; /* REDUCIDO DE 5px */
}

.login-overlay .input-with-icon i {
    position: absolute;
    left: 12px; /* REDUCIDO DE 15px */
    top: 50%;
    transform: translateY(-50%);
    color: rgba(255, 255, 255, 0.85);
    font-size: 1rem;
}

.login-overlay .input-with-icon input {
    width: 100%;
    padding: 10px 12px 10px 40px; /* REDUCIDO DE 12px 15px 12px 45px */
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-radius: 6px;
    font-size: 0.95rem; /* REDUCIDO DE 1rem */
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

.login-overlay .input-with-icon input:focus {
    outline: none;
    border-color: var(--primary-light);
    box-shadow: 0 0 0 2px rgba(44, 106, 229, 0.25);
    background: rgba(255, 255, 255, 0.15);
}

.login-overlay .input-with-icon .password-toggle {
    position: absolute;
    right: 10px; /* REDUCIDO DE 12px */
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: rgba(255, 255, 255, 0.85);
    cursor: pointer;
    font-size: 1rem;
    padding: 4px;
}

.login-overlay .input-with-icon .password-toggle:hover {
    color: white;
}

.login-overlay .login-button {
    width: 100%;
    padding: 10px; /* REDUCIDO DE 12px */
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 0.95rem; /* REDUCIDO DE 1rem */
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px; /* REDUCIDO DE 8px */
    margin-top: 8px; /* REDUCIDO DE 10px */
    box-shadow: 0 3px 10px rgba(7, 68, 182, 0.4);
}

.login-overlay .login-button:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(7, 68, 182, 0.5);
}

.login-overlay .login-button:active {
    transform: translateY(0);
}

.login-overlay .form-options {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin: 12px 0 15px; /* REDUCIDO DE 15px 0 20px */
}

.login-overlay .forgot-password {
    color: white;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.85rem; /* REDUCIDO DE 0.9rem */
    transition: all 0.3s ease;
}

.login-overlay .forgot-password:hover {
    color: var(--primary-light);
    text-decoration: underline;
}

.login-overlay .register-link {
    text-align: center;
    margin-top: 15px; /* REDUCIDO DE 20px */
    font-size: 0.9rem; /* REDUCIDO DE 0.95rem */
    color: rgba(255, 255, 255, 0.9);
}

.login-overlay .register-link a {
    color: white;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.login-overlay .register-link a:hover {
    color: var(--primary-light);
    text-decoration: underline;
}

.login-overlay .alert {
    padding: 8px 10px; /* REDUCIDO DE 10px 12px */
    border-radius: 6px;
    margin-bottom: 12px; /* REDUCIDO DE 15px */
    font-size: 0.85rem; /* REDUCIDO DE 0.9rem */
    display: flex;
    align-items: center;
    gap: 6px; /* REDUCIDO DE 8px */
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
}

.login-overlay .alert i {
    font-size: 0.95rem; /* REDUCIDO DE 1rem */
}

section { padding: 80px 60px; }

section h2 { 
    font-size: 2.5rem; 
    font-weight: 800; 
    margin-bottom: 50px; 
    color: var(--text-dark); 
    text-align: center;
    position: relative;
    padding-bottom: 15px;
}
section h2::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: var(--primary);
    border-radius: 2px;
}

/* CARRUSEL */
.carousel-container {
    width: 100%;
    height: 100vh;
    margin: 0;
    position: relative;
    overflow: hidden;
}

.carousel {
    display: flex;
    transition: transform 0.7s ease-in-out;
    height: 100%;
}

.carousel-slide {
    min-width: 100%;
    position: relative;
    height: 100%;
}

.carousel-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    object-position: center;
}

.carousel-nav {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    padding: 0 20px;
    transform: translateY(-50%);
    z-index: 10;
}

.carousel-arrow {
    background: rgba(255, 255, 255, 0.3);
    border: none;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 1.5rem;
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    backdrop-filter: blur(5px);
}

.carousel-arrow:hover {
    background: rgba(255, 255, 255, 0.5);
    transform: scale(1.1);
}

/* TEXTO EN CARRUSEL - ESCRITORIO (MÁS PEQUEÑO) */
.carousel-caption {
    position: absolute;
    top: 50%;
    left: 10%;
    transform: translateY(-50%);
    color: white;
    width: 35%;
    max-width: 450px; /* REDUCIDO DE 500px */
    z-index: 50;
}

.carousel-caption h1 {
    font-size: 1.8rem; /* REDUCIDO DE 2.2rem */
    margin-bottom: 6px; /* REDUCIDO DE 8px */
    font-weight: 900;
    text-shadow: 0 4px 12px rgba(0,0,0,0.8);
    line-height: 1.2;
}

.carousel-text-box {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 12px; /* REDUCIDO DE 14px */
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2); /* REDUCIDO DE 12px 30px */
    padding: 15px; /* REDUCIDO DE 20px */
    margin-top: 6px; /* REDUCIDO DE 8px */
}

.carousel-caption .siglas {
    font-size: 1rem; /* REDUCIDO DE 1.1rem */
    margin-bottom: 8px; /* REDUCIDO DE 12px */
    font-weight: 600;
    color: rgba(255, 255, 255, 0.95);
    letter-spacing: 0.2px; /* REDUCIDO DE 0.3px */
    text-shadow: 0 1px 3px rgba(0,0,0,0.5);
}

.carousel-caption p {
    font-size: 1rem; /* REDUCIDO DE 1.2rem */
    line-height: 1.4; /* REDUCIDO DE 1.5 */
    font-weight: 500;
    color: rgba(255, 255, 255, 0.9);
    text-shadow: 0 1px 3px rgba(0,0,0,0.5);
}

.carousel-indicators {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    z-index: 10;
}

.carousel-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.carousel-indicator.active {
    background: white;
    transform: scale(1.2);
}

/* DISEÑO PARA FUNCIONES */
.funciones-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: center;
}

.funcion-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    margin-bottom: 25px;
}

.funcion-icono {
    width: 50px;
    height: 50px;
    background: var(--primary);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.funcion-texto h3 {
    font-size: 1.2rem;
    margin-bottom: 5px;
    color: var(--text-dark);
}

.funcion-texto p {
    color: var(--text-light);
    line-height: 1.5;
}

.funcion-imagen {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.funcion-imagen img {
    width: 100%;
    height: auto;
    display: block;
}

/* BENEFICIOS */
.beneficios-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
}

.beneficio-tarjeta {
    background: white;
    padding: 30px;
    border-radius: 12px;
    border-left: 5px solid var(--primary);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
}

.beneficio-tarjeta:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}

.beneficio-tarjeta h3 {
    font-size: 1.3rem;
    margin-bottom: 10px;
    color: var(--primary);
}

.beneficio-tarjeta p {
    color: var(--text-light);
    line-height: 1.6;
}

/* FOOTER */
.footer {
    text-align:center;
    padding:35px;
    color:var(--text-light);
    font-size:.95rem;
    border-top:1px solid var(--gray-border);
    background: white;
}

/* ============ RESPONSIVE OPTIMIZADO ============ */

/* TABLET (1024px o menos) */
@media (max-width: 1024px) {
    .carousel-container {
        height: 80vh;
    }
    
    .carousel-caption {
        width: 40%;
        left: 5%;
    }
    
    .carousel-caption h1 {
        font-size: 1.6rem;
    }
    
    .carousel-text-box {
        padding: 12px;
    }
    
    .carousel-caption .siglas {
        font-size: 0.9rem;
    }
    
    .carousel-caption p {
        font-size: 0.95rem;
    }
    
    .login-overlay {
        right: 4%;
        width: 340px;
        padding: 20px;
    }
}

/* TABLET MEDIANA (900px o menos) - CARRUSEL ARRIBA, LOGIN ABAJO */
@media (max-width: 900px) {
    .carousel-container {
        height: 70vh;
        display: flex;
        flex-direction: column;
    }
    
    .carousel {
        order: 1;
        height: 70%;
    }
    
    .carousel-caption {
        position: absolute;
        top: 40%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 75%;
        max-width: 500px;
        text-align: center;
    }
    
    .carousel-caption h1 {
        font-size: 1.5rem;
        margin-bottom: 5px;
    }
    
    .carousel-text-box {
        margin: 8px auto 0 auto;
        padding: 12px;
    }
    
    .carousel-caption .siglas {
        font-size: 0.85rem;
        margin-bottom: 6px;
    }
    
    .carousel-caption p {
        font-size: 0.9rem;
        line-height: 1.3;
    }
    
    /* LOGIN SE MUEVE ABAJO */
    .login-overlay {
        position: relative;
        top: auto;
        right: auto;
        transform: none;
        order: 2;
        width: 85%;
        max-width: 350px;
        margin: 25px auto 0 auto;
        padding: 20px;
    }
    
    .login-overlay .login-form form {
        padding: 18px 20px;
    }
    
    .login-overlay .login-header h1 {
        font-size: 1.5rem;
    }
    
    .carousel-nav {
        padding: 0 10px;
    }
    
    .carousel-arrow {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
    }
    
    .carousel-indicators {
        bottom: 15px;
    }
}

/* MÓVIL GRANDE (768px o menos) */
@media (max-width: 768px) {
    .header {
        flex-direction: column;
        gap: 12px;
        padding: 12px 20px;
    }
    
    nav {
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    nav a {
        margin: 0 8px;
        font-size: 0.9rem;
    }
    
    section {
        padding: 50px 25px;
    }
    
    .carousel-container {
        height: 60vh;
    }
    
    .carousel-caption {
        width: 85%;
        top: 40%;
    }
    
    .carousel-caption h1 {
        font-size: 1.4rem;
    }
    
    .carousel-text-box {
        padding: 10px;
        margin-top: 6px;
    }
    
    .carousel-caption .siglas {
        font-size: 0.8rem;
        margin-bottom: 5px;
    }
    
    .carousel-caption p {
        font-size: 0.85rem;
        line-height: 1.25;
    }
    
    .login-overlay {
        width: 80%;
        max-width: 320px;
        padding: 18px;
        margin: 20px auto 0 auto;
    }
    
    .login-overlay .login-form form {
        padding: 16px 18px;
    }
    
    .login-overlay .login-header h1 {
        font-size: 1.4rem;
        margin-bottom: 5px;
    }
    
    .funciones-container {
        grid-template-columns: 1fr;
        gap: 25px;
    }
    
    .funcion-item {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .beneficios-container {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}

/* MÓVIL MEDIANO (600px o menos) */
@media (max-width: 600px) {
    .carousel-container {
        height: 55vh;
    }
    
    .carousel-caption {
        width: 90%;
        top: 35%;
    }
    
    .carousel-caption h1 {
        font-size: 1.3rem;
        margin-bottom: 4px;
    }
    
    .carousel-text-box {
        padding: 8px;
        border-radius: 10px;
        margin-top: 5px;
    }
    
    .carousel-caption .siglas {
        font-size: 0.75rem;
        margin-bottom: 4px;
    }
    
    .carousel-caption p {
        font-size: 0.8rem;
        line-height: 1.2;
    }
    
    .login-overlay {
        width: 85%;
        max-width: 300px;
        padding: 16px;
        margin: 15px auto 0 auto;
    }
    
    .login-overlay .login-form form {
        padding: 14px 16px;
    }
    
    .login-overlay .login-header h1 {
        font-size: 1.3rem;
    }
    
    section h2 {
        font-size: 2rem;
        margin-bottom: 35px;
        padding-bottom: 12px;
    }
}

/* MÓVIL PEQUEÑO (480px o menos) */
@media (max-width: 480px) {
    .carousel-container {
        height: 50vh;
    }
    
    .carousel-caption {
        width: 92%;
        top: 35%;
    }
    
    .carousel-caption h1 {
        font-size: 1.2rem;
    }
    
    .carousel-text-box {
        padding: 6px;
        border-radius: 8px;
        margin-top: 4px;
    }
    
    .carousel-caption .siglas {
        font-size: 0.7rem;
        margin-bottom: 3px;
    }
    
    .carousel-caption p {
        font-size: 0.75rem;
        line-height: 1.15;
    }
    
    .login-overlay {
        max-width: 280px;
        padding: 14px;
        margin: 12px auto 0 auto;
    }
    
    .login-overlay .login-form form {
        padding: 12px 14px;
    }
    
    .login-overlay .login-header h1 {
        font-size: 1.2rem;
        margin-bottom: 4px;
    }
    
    .login-overlay .form-group label {
        font-size: 0.85rem;
        margin-bottom: 5px;
    }
    
    .login-overlay .input-with-icon input {
        padding: 8px 10px 8px 35px;
        font-size: 0.9rem;
    }
    
    .carousel-nav {
        display: none;
    }
    
    .carousel-indicators {
        bottom: 10px;
    }
    
    .carousel-indicator {
        width: 10px;
        height: 10px;
    }
}
</style>
</head>

<body>

<!-- ✅ NAVBAR -->
<header class="header">
    <div class="logo-container">
        <img src="{{ asset('img/logo_iufim.png') }}" alt="Logo" class="logo-img">
    </div>

    <nav>
        <a href="#inicio" class="active">Inicio</a>
        <a href="#funciones">Funciones</a>
        <a href="#beneficios">Beneficios</a>
    </nav>
</header>

<!-- ✅ CARRUSEL DE IMÁGENES CON FORMULARIO DE LOGIN -->
<section id="inicio" style="padding: 0; margin-top: 78px;">
    <div class="carousel-container">
        <!-- FORMULARIO DE INICIO DE SESIÓN (SE MUEVE CON RESPONSIVE) -->
        <div class="login-overlay">
            <div class="login-header">
                <h1>Acceso</h1>
            </div>
            
            <div class="login-form">
                @if(session('role_changed'))
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        {{ session('role_changed') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <div class="input-with-icon">
                            <i class="fas fa-envelope"></i>
                            <input id="email" type="email" class="@error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                   placeholder="tucorreo@ejemplo.com">
                        </div>
                        @error('email')
                            <div class="alert alert-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i>
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input id="password" type="password" class="@error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="current-password"
                                   placeholder="Ingresa tu contraseña">
                            <button type="button" class="password-toggle" id="togglePassword">
                                <i class="far fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="alert alert-danger mt-2">
                                <i class="fas fa-exclamation-circle"></i>
                                <strong>{{ $message }}</strong>
                                
                            </div>
                        @enderror
                    </div>

                    <div class="form-options">
                        <a href="{{ route('password.request') }}" class="forgot-password">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button type="submit" class="login-button">
                        <i class="fas fa-sign-in-alt"></i> Acceder
                    </button>

                    <div class="register-link">
                        ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- CARRUSEL DE IMÁGENES -->
        <div class="carousel">
            <!-- IMAGEN 1 -->
            <div class="carousel-slide">
                <img src="{{ asset('img/fondo.jpeg') }}" alt="Dashboard GEPROC" class="carousel-image">
                <div class="carousel-caption">
                    <h1>Sistema GEPROC</h1>
                    <div class="carousel-text-box">
                        <div class="siglas">(Gestión de Promedios y Contratos)</div>
                        <p>Herramienta para la gestión y control de información de docentes</p>
                    </div>
                </div>
            </div>
            
            <!-- IMAGEN 2 -->
            <div class="carousel-slide">
                <img src="{{ asset('img/fondo2.jpg') }}" alt="Gestión de Contratos" class="carousel-image">
                <div class="carousel-caption">
                    <h1>Sistema GEPROC</h1>
                    <div class="carousel-text-box">
                        <div class="siglas">(Gestión de Promedios y Contratos)</div>
                        <p>Administra y guarda tu información de manera eficiente y segura</p>
                    </div>
                </div>
            </div>
            
            <!-- IMAGEN 3 -->
            <div class="carousel-slide">
                <img src="{{ asset('img/fondo3.jpg') }}" alt="Análisis de Datos" class="carousel-image">
                <div class="carousel-caption">
                    <h1>Sistema GEPROC</h1>
                    <div class="carousel-text-box">
                        <div class="siglas">(Gestión de Promedios y Contratos)</div>
                        <p>Genera reportes y estadísticas</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- FLECHAS TRANSPARENTES (SE OCULTAN EN MÓVIL) -->
        <div class="carousel-nav">
            <button class="carousel-arrow prev-arrow">‹</button>
            <button class="carousel-arrow next-arrow">›</button>
        </div>
        
        <!-- INDICADORES -->
        <div class="carousel-indicators">
            <button class="carousel-indicator active"></button>
            <button class="carousel-indicator"></button>
            <button class="carousel-indicator"></button>
        </div>
    </div>
</section>

<!-- ✅ FUNCIONES -->
<section id="funciones">
    <h2>Funciones del sistema</h2>
    <div class="funciones-container">
        <div>
            <div class="funcion-item">
                <div class="funcion-icono">📁</div>
                <div class="funcion-texto">
                    <h3>Gestión de contratos</h3>
                    <p>Edición de plantillas para contratos de los docentes</p>
                </div>
            </div>
            <div class="funcion-item">
                <div class="funcion-icono">🧾</div>
                <div class="funcion-texto">
                    <h3>Control de documentos</h3>
                    <p>Almacenamiento seguro y organización de documentos de los docentes</p>
                </div>
            </div>
            <div class="funcion-item">
                <div class="funcion-icono">🔔</div>
                <div class="funcion-texto">
                    <h3>Estatus Docente y Coordinación</h3>
                    <p>Muestra Información de cada docente conforme a su progreso</p>
                </div>
            </div>
            <div class="funcion-item">
                <div class="funcion-icono">📊</div>
                <div class="funcion-texto">
                    <h3>Reportes y análisis</h3>
                    <p>Generación de informes detallados de cada coordinación</p>
                </div>
            </div>
        </div>
        <div class="funcion-imagen">
            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Funciones GEPROC">
        </div>
    </div>
</section>

<!-- ✅ BENEFICIOS -->
<section id="beneficios" style="background:white;">
    <h2>Beneficios</h2>
    <div class="beneficios-container">
        <div class="beneficio-tarjeta">
            <h3>⏱ Ahorro de tiempo</h3>
            <p>Automatización de procesos repetitivos y gestión eficiente que reduce el tiempo de administración en un 60%.</p>
        </div>
        <div class="beneficio-tarjeta">
            <h3>✅ Mayor control</h3>
            <p>Seguimiento completo y trazabilidad de todos los contratos</p>
        </div>
        <div class="beneficio-tarjeta">
            <h3>🔒 Seguridad y respaldo</h3>
            <p>Protección de datos y respaldos automáticos</p>
        </div>
        <div class="beneficio-tarjeta">
            <h3>📁 Centralización documental</h3>
            <p>Acceso unificado a toda la documentación contractual desde cualquier dispositivo.</p>
        </div>
    </div>
</section>

<!-- ✅ FOOTER -->
<div class="footer">© 2026 GEPROC </div>

<!-- ✅ JS CORREGIDO PARA EL CARRUSEL - BUCLE INFINITO SUAVE -->
<script>
// Navegación por scroll
const sections = document.querySelectorAll("section");
const menu = document.querySelectorAll("nav a");

window.addEventListener("scroll", () => {
  let current = "";
  sections.forEach(sec => {
    if (window.scrollY >= sec.offsetTop - 200) current = sec.getAttribute("id");
  });

  menu.forEach(a => {
    a.classList.remove("active");
    if (a.getAttribute("href") === `#${current}`) a.classList.add("active");
  });
});

// CARRUSEL CON BUCLE INFINITO SUAVE
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.carousel');
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.carousel-indicator');
    const prevArrow = document.querySelector('.prev-arrow');
    const nextArrow = document.querySelector('.next-arrow');
    
    let currentSlide = 0;
    const totalSlides = slides.length;
    let isTransitioning = false;
    let autoSlideInterval;
    
    const SLIDE_DURATION = 15000;
    const TRANSITION_DURATION = 700;
    
    carousel.style.transition = `transform ${TRANSITION_DURATION}ms ease-in-out`;
    
    function updateCarousel() {
        carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentSlide);
        });
    }
    
    function goToNextSlide() {
        if (isTransitioning) return;
        
        isTransitioning = true;
        currentSlide++;
        
        if (currentSlide === totalSlides) {
            setTimeout(() => {
                carousel.style.transition = 'none';
                currentSlide = 0;
                carousel.style.transform = `translateX(0%)`;
                void carousel.offsetWidth;
                carousel.style.transition = `transform ${TRANSITION_DURATION}ms ease-in-out`;
                isTransitioning = false;
                
                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index === currentSlide);
                });
            }, TRANSITION_DURATION);
        } else {
            updateCarousel();
            setTimeout(() => {
                isTransitioning = false;
            }, TRANSITION_DURATION);
        }
    }
    
    function goToPrevSlide() {
        if (isTransitioning) return;
        
        isTransitioning = true;
        
        if (currentSlide === 0) {
            carousel.style.transition = 'none';
            currentSlide = totalSlides - 1;
            carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
            void carousel.offsetWidth;
            carousel.style.transition = `transform ${TRANSITION_DURATION}ms ease-in-out`;
            
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentSlide);
            });
            
            isTransitioning = false;
        } else {
            currentSlide--;
            updateCarousel();
            setTimeout(() => {
                isTransitioning = false;
            }, TRANSITION_DURATION);
        }
    }
    
    function goToSlide(index) {
        if (isTransitioning || index === currentSlide) return;
        
        isTransitioning = true;
        currentSlide = index;
        updateCarousel();
        
        setTimeout(() => {
            isTransitioning = false;
        }, TRANSITION_DURATION);
    }
    
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function() {
            clearInterval(autoSlideInterval);
            goToSlide(index);
            startAutoSlide();
        });
    });
    
    if (prevArrow) {
        prevArrow.addEventListener('click', function() {
            clearInterval(autoSlideInterval);
            goToPrevSlide();
            startAutoSlide();
        });
    }
    
    if (nextArrow) {
        nextArrow.addEventListener('click', function() {
            clearInterval(autoSlideInterval);
            goToNextSlide();
            startAutoSlide();
        });
    }
    
    function startAutoSlide() {
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(goToNextSlide, SLIDE_DURATION);
    }
    
    startAutoSlide();
    
    const togglePassword = document.getElementById('togglePassword');
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    }
});
</script>

<!-- Font Awesome para iconos -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>