<div class="container-index">
    <!-- Banner principal con carrusel -->
    <div class="banner-carousel">

        <!-- Texto fijo sobre todas las imágenes -->
        <div class="carousel-text">
            <h2>Bienvenido a nuestra página</h2>
            <p>Encuentra tu hogar ideal aquí</p>
        </div>

        <div class="carousel-slide">
       <!-- https://images.unsplash.com/photo-1604771870038-6b1d99e7bae8?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fGx1eHVyeSUyMGhvdXNlfGVufDB8fDB8fHww-->
            <img src="https://i.pinimg.com/originals/02/17/e8/0217e8ba2cda0577e7a490566a47f49e.jpg" alt="Propiedades destacadas 1">
        </div>
        <div class="carousel-slide">
            <img src="https://s1.1zoom.me/b5353/208/Houses_Villa_Design_Pools_537090_1920x1080.jpg" alt="Propiedades destacadas 2">
        </div>
        <div class="carousel-slide">
            <img src="https://s1.1zoom.me/b5350/670/Houses_Mansion_Design_514345_1920x1080.jpg" alt="Propiedades destacadas 3">
        </div>
        <div class="carousel-slide">
            <img src="https://wallpapers.com/images/hd/luxury-house-with-terracotta-roof-d68qn5xn2qgpmuk0.jpg" alt="Propiedades destacadas 4">
        </div>
    </div>

    <div class="second-container">

        <!-- Sección de categorías destacadas -->
        <section class="services">
            <h2>Servicios destacados</h2>
            <div class="services-list">
                <div class="service">
                    <div class="image-container">
                        <img src="https://loqueva.com/wp-content/uploads/2016/08/homify-casas-modernas-ideas-modernas-200x200.jpg" alt="Comparar Casas">
                    </div>
                    <div class="service-info">
                        <h3>Comparar Inmuebles</h3>
                        <p>Compara las mejores opciones de propiedades de acuerdo a tus necesidades.</p>

                        <?php if ($session->get('id_usuario') && $session->get('rol') === 'cliente'): ?>
                            <a href="PropiedadController/comparar" class="btn">Saber más</a>
                        <?php elseif (!$session->get('id_usuario')): ?>
                            <a class="btn btn-heart" onclick="document.getElementById('loginModal').style.display='block'">
                                Saber más
                            </a>
                        </button>
                    <?php endif; ?>
                    </div>
                </div>
                <div class="service">
                    <div class="image-container">
                        <img src="https://st4.depositphotos.com/1010613/27377/i/450/depositphotos_273772384-stock-photo-businesswoman-hand-checking-schedule-diary.jpg" alt="Citas">
                    </div>
                    <div class="service-info">
                        <h3>Agendar Visita a la Casa</h3>
                        <p>Pide una cita para visitar las propiedades de nuestro listado.</p>
                        <a href="PropiedadController" class="btn">Saber más</a>
                    </div>
                </div>
                <div class="service">
                    <div class="image-container">
                        <img src="https://media.istockphoto.com/id/1146963915/es/foto/empresario-c%C3%A1lculo-del-impuesto-sobre-la-propiedad.jpg?s=612x612&w=0&k=20&c=39IZnUh45hTJFb7KfRbprXNOHi0s-mGkkCVzFC8Hx1Q=" alt="Compras">
                    </div>
                    <div class="service-info">
                        <h3>Solicitar Tasación</h3>
                        <p>Elige la casa que te interesa y solicita una tasación para conocer su valor de mercado.</p>
                        <a href="TasacionController/create" class="btn">Saber más</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Propiedades destacadas -->
        <section class="featured-properties">
            <h2>Propiedades destacadas</h2>
            <div class="property-container">
                <?php foreach ($propiedadesConDatos as $propiedad): ?>
                    <div class="property">
                        <a href="<?= $baseUrl ?>PropiedadController/show/<?= $propiedad['propiedad']->id_propiedad ?>" class="property-link">
                            <?php if (!empty($propiedad['imagenes'])): ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($propiedad['imagenes'][0]->imagen); ?>" alt="Imagen de la propiedad">
                            <?php else: ?>
                                <img src="https://via.placeholder.com/600x400" alt="Imagen de la propiedad">
                            <?php endif; ?>

                            <h2><?php echo htmlspecialchars($propiedad['propiedad']->titulo); ?></h2>
                            <p><?php echo htmlspecialchars($propiedad['propiedad']->descripcion); ?></p>
                            <p class="price">Precio: <?php echo htmlspecialchars($propiedad['propiedad']->precio); ?> &#36;</p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        

        <!-- Llamado a la acción -->
        <section class="cta">
            <h2>¿Listo para encontrar tu hogar ideal?</h2>
            <a class="btn"href="<?= $baseUrl ?>PropiedadController">buscar ahora</a>
        </section>
    </div>
</div>

<!-- Modal -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="document.getElementById('loginModal').style.display='none'">&times;</span>
        <h2>Inicia sesión o regístrate</h2>
        <p>Por favor, inicia sesión o regístrate para poder acceder a comparar casas</p>
        <a href="<?= $baseUrl ?>AuthController/login" class="btn">Iniciar sesión</a>
        <a href="<?= $baseUrl ?>AuthController/register" class="btn">Registrarse</a>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const slides = document.querySelectorAll(".carousel-slide");
        let currentIndex = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.display = i === index ? "block" : "none";
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        // Inicializar carrusel
        showSlide(currentIndex);

        // Cambiar de diapositiva cada 5 segundos
        setInterval(nextSlide, 5000);
    });
</script>

