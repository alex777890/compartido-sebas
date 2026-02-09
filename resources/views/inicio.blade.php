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

/* HEADER FIXED - MÁS GRANDE PARA CUBRIR ESPACIO */
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

/* LOGO PEGADO A LA IZQUIERDA */
.logo-container { 
    display: flex; 
    align-items: center; 
    gap: 12px; 
    height: 40px; /* ALTURA FIJA PARA EL CONTENEDOR */
}
.logo-img { 
    width: 60px; /* MÁS GRANDE */
    height: 60px; /* MÁS GRANDE */
    border-radius: 8px; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    color: white;
    object-fit: contain; /* PARA MANTENER PROPORCIONES */
}

/* NAV - MÁS GRANDE */
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

/* LOGIN BUTTON */
.login-btn {
    padding: 10px 24px;
    background: white; /* FONDO BLANCO */
    color: var(--primary); /* TEXTO AZUL */
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    border: 2px solid var(--primary); /* BORDE AZUL */
    box-shadow: 0 2px 8px rgba(7, 68, 182, 0.2);
}
.login-btn:hover {
    background: var(--primary); /* FONDO AZUL AL PASAR MOUSE */
    color: white; /* TEXTO BLANCO AL PASAR MOUSE */
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(7, 68, 182, 0.3);
}

/* SECTION BASE */
section { padding: 80px 60px; }

/* TÍTULOS MÁS ATRACTIVOS */
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

/* CARRUSEL - SIN FLECHAS Y MÁS LENTO */
.carousel-container {
    width: 100%;
    height: 100vh;
    margin: 0;
    position: relative;
    overflow: hidden;
}

.carousel {
    display: flex;
    transition: transform 1s ease; /* MÁS LENTO */
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
}

/* TEXTO A LA IZQUIERDA */
.carousel-caption {
    position: absolute;
    top: 50%;
    left: 10%;
    transform: translateY(-50%);
    color: white;
    padding: 0;
    text-align: left;
    background: transparent;
    width: 40%;
    max-width: 500px;
}

.carousel-caption h1 {
    font-size: 2.2rem;
    margin-bottom: 15px;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.carousel-caption p {
    font-size: 1rem;
    line-height: 1.5;
    text-shadow: 0 1px 2px rgba(0,0,0,0.3);
}

/* ELIMINADAS LAS FLECHAS DEL CARRUSEL */
.carousel-nav {
    display: none; /* OCULTAR FLECHAS */
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

/* DISEÑO CREATIVO PARA FUNCIONES */
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

/* DISEÑO CREATIVO PARA BENEFICIOS */
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

/* RESPONSIVE */
@media (max-width: 992px) {
    .header {
        padding: 14px 30px;
    }
    
    section {
        padding: 60px 30px;
    }
    
    .carousel-caption {
        width: 50%;
        left: 5%;
    }
    
    .carousel-caption h1 {
        font-size: 1.8rem;
    }
    
    .funciones-container {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .beneficios-container {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .header {
        flex-direction: column;
        gap: 15px;
        padding: 12px 20px;
    }
    
    nav {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }
    
    section {
        padding: 40px 20px;
    }
    
    .carousel-caption {
        width: 80%;
        left: 10%;
        text-align: center;
    }
    
    .carousel-caption h1 {
        font-size: 1.6rem;
    }
    
    .carousel-caption p {
        font-size: 0.9rem;
    }
    
    .funcion-item {
        flex-direction: column;
        text-align: center;
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

    <a href="{{ route('login') }}" class="login-btn">Iniciar Sesión</a>
</header>

<!-- ✅ CARRUSEL DE IMÁGENES -->
<section id="inicio" style="padding: 0; margin-top: 78px;">
    <div class="carousel-container">
        <div class="carousel">
            <!-- IMAGEN 1 -->
            <div class="carousel-slide">
                <img src="{{ asset('img/fondo.jpeg') }}" alt="Dashboard GEPROC" class="carousel-image">
                <div class="carousel-caption">
                    <h1>Sistema <span>GEPROC</span></h1>
                    <p>La herramienta profesional para la gestión, control de informacion de docentes</p>
                </div>
            </div>
            
            <!-- IMAGEN 2 -->
            <div class="carousel-slide">
                <img src="{{ asset('img/fondo2.jpg') }}" alt="Gestión de Contratos" class="carousel-image">
                <div class="carousel-caption">
                    <h1>Sistema <span>GEPROC</span></h1>
                    <p>Administra y guarda la informacion </p>
                </div>
            </div>
        </div>
        
        <!-- FLECHAS ELIMINADAS -->
        
        <div class="carousel-indicators">
            <button class="carousel-indicator active"></button>
            <button class="carousel-indicator"></button>
        </div>
    </div>
</section>

<!-- ✅ FUNCIONES - DISEÑO CREATIVO -->
<section id="funciones">
    <h2>Funciones del sistema</h2>
    <div class="funciones-container">
        <div>
            <div class="funcion-item">
                <div class="funcion-icono">📁</div>
                <div class="funcion-texto">
                    <h3>Gestión de contratos</h3>
                    <p>Edicion de plantillas para contratos de los docentes </p>
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
                    <h3>Estatus Docente y Coordinacion</h3>
                    <p>Muestra Informacion de cada docente conforme a su progreso  .</p>
                </div>
            </div>
            <div class="funcion-item">
                <div class="funcion-icono">📊</div>
                <div class="funcion-texto">
                    <h3>Reportes y análisis</h3>
                    <p>Generación de informes detallados de cada coordinacion</p>
                </div>
            </div>
        </div>
        <div class="funcion-imagen">
            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Funciones GEPROC">
        </div>
    </div>
</section>

<!-- ✅ BENEFICIOS - DISEÑO CREATIVO -->
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

<!-- ✅ JS PARA ACTIVAR EL MENÚ SEGÚN SCROLL Y CARRUSEL -->
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

// Carrusel de imágenes
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.carousel');
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.carousel-indicator');
    
    let currentSlide = 0;
    const totalSlides = slides.length;
    
    // Función para actualizar el carrusel
    function updateCarousel() {
        carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
        
        // Actualizar indicadores
        indicators.forEach((indicator, index) => {
            if (index === currentSlide) {
                indicator.classList.add('active');
            } else {
                indicator.classList.remove('active');
            }
        });
    }
    
    // Eventos para indicadores
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function() {
            currentSlide = index;
            updateCarousel();
        });
    });
    
    // Cambio automático cada 8 segundos (MÁS LENTO)
    setInterval(function() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateCarousel();
    }, 8000);
});
</script>

<!-- Font Awesome para iconos -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>