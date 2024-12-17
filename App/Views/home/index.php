<div class="container-index">
    <!-- Banner principal con carrusel -->
    <div class="banner">
        <div class="banner-inicio">
            <img src="<?= $baseUrl ?>img/banner.png" alt="Banner de inicio">
        </div>

    </div>

    <div class="second-container">

        <!-- Sección de categorías destacadas -->
        <section class="services">
            <h1>Servicios destacados</h1>
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
            <h1>Propiedades destacadas</h1>
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
            <h1>¿Te animas a encontrar el hogar de tus sueños?</h1>
            <a class="btn" href="<?= $baseUrl ?>PropiedadController">Buscar ahora</a>
        </section>
    </div>
</div>

<!-- Modal -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="document.getElementById('loginModal').style.display='none'">&times;</span>
        <h1>Inicia sesión o regístrate</h1>
        <p>Por favor, inicia sesión o regístrate para poder acceder a comparar casas</p>
        <a href="<?= $baseUrl ?>AuthController/login" class="btn">Iniciar sesión</a>
        <a href="<?= $baseUrl ?>AuthController/register" class="btn">Registrarse</a>
    </div>
</div>