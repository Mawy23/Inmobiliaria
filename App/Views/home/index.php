<div class="container">
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
                        <a href="#" class="btn">Saber más</a>
                    </div>
                </div>
                <div class="service">
                    <div class="image-container">
                        <img src="https://st4.depositphotos.com/1010613/27377/i/450/depositphotos_273772384-stock-photo-businesswoman-hand-checking-schedule-diary.jpg" alt="Citas">
                    </div>
                    <div class="service-info">
                        <h3>Visita Virtual</h3>
                        <p>Pide una cita para ver las propiedades sin necesidad de desplazarte.</p>
                        <a href="#" class="btn">Saber más</a>
                    </div>
                </div>
                <div class="service">
                    <div class="image-container">
                        <img src="https://www.lr21.com.uy/wp-content/uploads/2017/04/Buying-House-from-Bank-in-Installments.jpg" alt="Compras">
                    </div>
                    <div class="service-info">
                        <h3>Comprar Casas</h3>
                        <p>Encuentra la casa perfecta para ti y tu familia con nuestra ayuda.</p>
                        <a href="#" class="btn">Saber más</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Propiedades destacadas -->
        <section class="featured-properties">
            <h2>Propiedades destacadas</h2>
            <div class="property-container">
                <div class="property">
                    <img src="https://via.placeholder.com/600x400" alt="Casa en la Playa">
                    <h3>Casa en la Playa</h3>
                    <p>Desde $500,000 USD</p>
                </div>
                <div class="property">
                    <img src="https://via.placeholder.com/600x400" alt="Departamento en la Ciudad">
                    <h3>Departamento en la Ciudad</h3>
                    <p>Desde $300,000 USD</p>
                </div>
                <div class="property">
                    <img src="https://via.placeholder.com/600x400" alt="Villa en el Campo">
                    <h3>Villa en el Campo</h3>
                    <p>Desde $750,000 USD</p>
                </div>
            </div>
        </section>

        <!-- Llamado a la acción -->
        <section class="cta">
            <h2>¿Listo para encontrar tu hogar ideal?</h2>
            <a class="btn"href="<?= $baseUrl ?>PropiedadController">buscar ahora</a>
        </section>
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


<style>
/* Estilos generales */
.container {
    width: 100%;
    max-width: 100%; /* Asegura que el contenedor ocupe todo el ancho de la pantalla */
    margin: 0 auto;
    padding: 0;
}

.second-container {
    padding: 60px 15px 0;
    max-width: 1200px;
    margin: 30px auto;
}

/* Carrusel */
.banner-carousel {
    position: relative;
    overflow: hidden;
    margin-bottom: 20px;
    width: 100%;
    height: calc(100vh - 80px); /* Hacer que el carrusel ocupe toda la altura de la pantalla */
}

.carousel-slide img {
    width: 100%; /* Asegura que la imagen ocupe todo el ancho del contenedor */
    height: 100vh; /* Asegura que la imagen ocupe toda la altura del viewport */
    object-fit: cover; /* Hace que la imagen cubra completamente el área sin distorsionarse */
    display: block;
}

.carousel-slide {
    display: none; /* Ocultar todas las diapositivas por defecto */
}

.carousel-slide:first-child {
    display: block; /* Mostrar la primera diapositiva al cargar */
}

/* Estilo para el texto fijo del carrusel */
.carousel-text {
    position: absolute;
    top: 50%; /* Centrado verticalmente */
    left: 50%; /* Centrado horizontalmente */
    transform: translate(-50%, -50%); /* Asegura el verdadero centrado */
    color: white;
    text-align: center;
    z-index: 10; /* Asegura que el texto esté por encima de las imágenes */
    width: 100%;
}

/* Fondo borroso y transparente */
.carousel-text::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6); /* Fondo más oscuro para mejor contraste */
    filter: blur(8px); /* Aumentar el desenfoque */
    z-index: -1; /* Asegura que el fondo quede detrás del texto */
}

.carousel-text h2 {
    font-size: 3rem;
    margin-bottom: 10px;
    color: white; /* Blanco para el h2 */
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7); /* Sombras más intensas */
}

.carousel-text p {
    font-size: 1.5rem;
    color: #f1f1f1; /* Gris claro para el p */
    text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.7); /* Sombras más suaves */
}

/* Estilos para los servicios destacados */
.services {
    text-align: center;
    margin: 40px 0;
}

.services-list {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.service {
    text-align: center;
    margin: 15px;
    flex: 1 1 30%; /* Para asegurarse de que haya espacio para tres en una fila */
}

.service .image-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 15px;
}

.service img {
    border-radius: 50%;
    width: 200px;
    height: 200px;
    object-fit: cover;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.service-info h3 {
    margin-top: 15px;
}

.service-info p {
    font-size: 1rem;
    color: #555;
    margin-bottom: 10px;
}

.service .btn {
    background-color: #6dc066;
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    text-decoration: none;
}

.service .btn:hover {
    background-color: #57a853;
}

/* Propiedades destacadas */
.featured-properties {
    margin: 40px 0;
}

.featured-properties h2 {
    text-align: center;
    margin-bottom: 20px;
}

.property-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.property {
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    margin: 10px;
    flex: 1 1 calc(30% - 20px);
    transition: transform 0.3s ease;
}

.property:hover {
    transform: translateY(-5px);
}

.property img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

/* Llamado a la acción */
.cta {
    text-align: center;
    background-color: #4bc7a1;
    color: white;
    padding: 40px 20px;
    border-radius: 15px;
}

.cta h2 {
    margin-bottom: 20px;
}

.cta .btn {
    background-color: #6dc066;
    color: white;
    padding: 15px 30px;
    text-decoration: none;
    font-size: 1.2rem;
    border-radius: 25px;
}

.cta .btn:hover {
    background-color: #57a853;
}
</style>
