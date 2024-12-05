<?php if (!empty($propiedad)): ?>
    <div class="property-details">
        <h1><?php echo htmlspecialchars($propiedad->titulo); ?></h1>

        <div class="property-images">
            <?php if (!empty($propiedad->imagenes)): ?>
                <!-- Mostrar la URL de la imagen -->
                <img src="<?php echo htmlspecialchars($propiedad->imagenes[0]->url_imagen); ?>" alt="Imagen de la propiedad">
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

            <?php if ($session->get('id_usuario')): ?>
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
            <?php else: ?>
                <button class="btn btn-heart" onclick="alert('Por favor, inicia sesión o regístrate para agregar a favoritos.');">
                    🤍
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