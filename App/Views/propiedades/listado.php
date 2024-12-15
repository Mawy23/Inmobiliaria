<div class="container">

    <h2>Lista de Propiedades</h2>
    <?php if (!empty($propiedades)): ?>

        <!-- Contenedor de propiedades con clase condicional -->
        <div class="property-container <?php echo count($propiedades) === 1 ? 'single-property' : ''; ?>">
            <?php foreach ($propiedades as $propiedad): ?>
                <div class="property">
                    <a href="<?= $baseUrl ?>PropiedadController/show/<?= $propiedad->id_propiedad ?>" class="property-link">
                        <?php if (!empty($propiedad->imagenes)): ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($propiedad->imagenes[0]->imagen); ?>" alt="Imagen de la propiedad">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/600x400" alt="Imagen de la propiedad">
                        <?php endif; ?>

                        <h2><?php echo htmlspecialchars($propiedad->titulo); ?></h2>
                        <p><?php echo htmlspecialchars($propiedad->descripcion); ?></p>
                        <p class="price">Precio: <?php echo htmlspecialchars($propiedad->precio); ?> &#36;</p>
                    </a>
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
                    <?php elseif (!$session->get('id_usuario')): ?>
                        <button class="btn btn-heart" onclick="document.getElementById('loginModal').style.display='block'">
                            🤍
                        </button>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="no-propiedades">
            <h3>No se encontraron propiedades</h3>
            <p>Lo sentimos, no hay propiedades que coincidan con tus criterios de búsqueda.</p>
            <p>Prueba ajustando tus filtros o ampliando tus criterios de búsqueda.</p>
        </div>
    <?php endif; ?>


    <?php if ($userRole == 'admin' || $userRole == 'agente'): ?>
        <!-- Eliminar el gráfico de estadísticas de búsqueda -->
    <?php endif; ?>

</div>

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
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
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

    .property-link {
        text-decoration: none;
        color: inherit;
    }

    .property-link:hover .property {
        border: 1px solid #ccc;
    }
</style>