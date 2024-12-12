<?php if (!empty($propiedad)): ?>
    <div class="property-details">
        <h1><?php echo htmlspecialchars($propiedad->titulo); ?></h1>

        <div class="property-images">
            <?php if (!empty($propiedad->imagenes)): ?>
                <div id="carouselImages" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($propiedad->imagenes as $index => $imagen): ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen->imagen); ?>" alt="Imagen de la propiedad">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselImages" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselImages" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </div>
            <?php else: ?>
                <img src="https://via.placeholder.com/600x400" alt="Imagen de la propiedad">
            <?php endif; ?>
        </div>

        <div class="property-info">
            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($propiedad->descripcion); ?></p>
            <p><strong>Precio:</strong> $<?php echo htmlspecialchars($propiedad->precio); ?></p>
            <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($propiedad->ciudad); ?></p>
            <p><strong>Estado:</strong> <?php echo htmlspecialchars($propiedad->estado); ?></p>
            <p><strong>Dirección:</strong> <?php echo htmlspecialchars($propiedad->direccion); ?></p>
            <p><strong>Código postal:</strong> <?php echo htmlspecialchars($propiedad->codigo_postal); ?></p>
            <p><strong>Tipo:</strong> <?php echo htmlspecialchars($propiedad->tipo); ?></p>

            <?php if ($session->get('id_usuario') && $session->get('rol') === 'cliente'): ?>
                <form action="<?= $baseUrl ?>FavoritosController/toggle" method="POST" style="display:inline;">
                    <input type="hidden" name="id_propiedad" value="<?= $propiedad->id_propiedad ?>">
                    <button type="submit" class="btn btn-heart" style="color: <?= $propiedad->isFavorito($session->get('id_usuario')) ? 'red' : 'grey' ?>;">
                        <?php if ($propiedad->isFavorito($session->get('id_usuario'))): ?>
                            ❤️
                        <?php else: ?>
                            🤍
                        <?php endif; ?>
                    </button>
                </form>
                <button class="btn btn-agendar" onclick="document.getElementById('agendarModal').style.display='block'">
                    Agendar Cita
                </button>
            <?php elseif (!$session->get('id_usuario')): ?>
                <button class="btn btn-heart" onclick="document.getElementById('loginModal').style.display='block'">
                    🤍
                </button>
                <button class="btn btn-agendar" onclick="document.getElementById('loginModal').style.display='block'">
                    Agendar Cita
                </button>
            <?php endif; ?>
        </div>

        <a class="volver-button" href="<?= $baseUrl ?>PropiedadController">Volver a la lista</a>
    </div>

<?php else: ?>
    <div class="no-propiedades">
        <h3>No se encontraron propiedades</h3>
        <p>Lo sentimos, no hay propiedades que coincidan con tus criterios de búsqueda.</p>
        <p>Prueba ajustando tus filtros o ampliando tus criterios de búsqueda.</p>
        <a href="<?= $baseUrl ?>PropiedadController/index" class="btn-regresar">Volver a buscar</a>
    </div>
<?php endif; ?>

<!-- Modal -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="document.getElementById('loginModal').style.display='none'">&times;</span>
        <h2>Inicia sesión o regístrate</h2>
        <p>Por favor, inicia sesión o regístrate para agregar a favoritos.</p>
        <a href="<?= $baseUrl ?>AuthController/login" class="btn">Iniciar sesión</a>
        <a href="<?= $baseUrl ?>AuthController/register" class="btn">Registrarse</a>
    </div>
</div>

<!-- Modal para agendar cita -->
<div id="agendarModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="document.getElementById('agendarModal').style.display='none'">&times;</span>
        <h2>Agendar Cita</h2>
        <form action="<?= $baseUrl ?>CitaController/agendar" method="POST">
            <input type="hidden" name="id_propiedad" value="<?= $propiedad->id_propiedad ?>">
            <label for="agente">Seleccionar Agente:</label>
            <select name="id_agente" id="agente" required>
                <?php foreach ($agentes as $agente): ?>
                    <option value="<?= $agente->id_usuario ?>"><?= htmlspecialchars($agente->nombre) ?></option>
                <?php endforeach; ?>
            </select>
            <label for="fecha">Seleccionar Fecha:</label>
            <input type="date" name="fecha" id="fecha" required>
            <label for="hora">Seleccionar Hora:</label>
            <input type="time" name="hora" id="hora" required>
            <button type="submit" class="btn">Agendar</button>
        </form>
    </div>
</div>

<style>
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    margin: 10px;
    background-color: #4CAF50;
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
}

.btn:hover {
    background-color: #45a049;
}

.btn-agendar {
    display: inline-block;
    padding: 10px 20px;
    margin: 10px;
    background-color: #007BFF;
    color: white;
    text-align: center;
    text-decoration: none;
    border-radius: 5px;
}

.btn-agendar:hover {
    background-color: #0056b3;
}
</style>