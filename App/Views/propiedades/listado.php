<div class="container">
<?php if (!empty($propiedades)): ?>

    <h2>Lista de Propiedades</h2>

    <!-- Contenedor de propiedades -->

    <div class="property-container">
    <?php foreach ($propiedades as $propiedad): ?>
        <div class="property">
            <a href="/Inmobiliaria/Public/PropiedadController/show/<?php echo $propiedad->id_propiedad; ?>">
                
                <?php if (!empty($propiedad->imagenes)): ?>
                    <!-- Mostrar la URL de la imagen -->
                    <img src="<?php echo htmlspecialchars($propiedad->imagenes[0]->url_imagen); ?>" alt="Imagen de la propiedad">
                <?php else: ?>
                    <img src="https://via.placeholder.com/600x400" alt="Imagen de la propiedad">
                <?php endif; ?>
                    
                <h2><?php echo htmlspecialchars($propiedad->titulo); ?></h2>
                <p><?php echo htmlspecialchars($propiedad->descripcion); ?></p>
                <p class="price">Precio: <?php echo htmlspecialchars($propiedad->precio); ?> &#36;</p>
            </a>
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

</div>


