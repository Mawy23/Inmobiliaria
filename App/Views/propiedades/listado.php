<?php if (!empty($propiedades)): ?>
    <style>
        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .propiedad-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .propiedad-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            background-color: #f9f9f9;
            width: 300px; /* Cambia este tamaño según tu diseño */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .propiedad-title {
            font-size: 1.5em;
            color: #007BFF;
        }

        .propiedad-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .propiedad-button:hover {
            background-color: #0056b3;
        }
    </style>

    <h2>Lista de Propiedades</h2>

    <!-- Contenedor de propiedades -->

    <div class="propiedad-container">
        <?php foreach ($propiedades as $propiedad): ?>
            <div class="propiedad-card">
                <h3 class="propiedad-title"><?php echo htmlspecialchars($propiedad->titulo); ?></h3>
                <p><?php echo htmlspecialchars($propiedad->descripcion); ?></p>
                <p>Precio: <?php echo htmlspecialchars($propiedad->precio); ?> €</p>
                <p>Tipo: <?php echo htmlspecialchars($propiedad->tipo); ?></p>
                <p>Dirección: <?php echo htmlspecialchars($propiedad->direccion); ?></p>
                <p>Ciudad: <?php echo htmlspecialchars($propiedad->ciudad); ?></p>
                <p>Estado: <?php echo htmlspecialchars($propiedad->estado); ?></p>
                <p>Código Postal: <?php echo htmlspecialchars($propiedad->codigo_postal); ?></p>
                <p>Agente ID: <?php echo htmlspecialchars($propiedad->id_agente); ?></p>
                <a class="propiedad-button" href="/Inmobiliaria/Public/PropiedadController/show/<?php echo $propiedad->id_propiedad; ?>">Ver detalles</a>
            </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <div class="no-propiedades">
        <h3>No se encontraron propiedades</h3>
        <p>Lo sentimos, no hay propiedades que coincidan con tus criterios de búsqueda.</p>
        <p>Prueba ajustando tus filtros o ampliando tus criterios de búsqueda.</p>
        <a href="/Inmobiliaria/Public/PropiedadController/index" class="btn-regresar">Volver a buscar</a>
    </div>
<?php endif; ?>

<style>
    .no-propiedades {
        text-align: center;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f9f9f9;
        margin: 20px 0;
    }

    .no-propiedades h3 {
        color: #dc3545; /* Color rojo para el mensaje de error */
        margin-bottom: 10px;
    }

    .no-propiedades p {
        color: #666; /* Color gris para el texto adicional */
        margin-bottom: 15px;
    }

    .btn-regresar {
        display: inline-block;
        padding: 10px 15px;
        background-color: #007bff; /* Color azul */
        color: white;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-regresar:hover {
        background-color: #0056b3; /* Color azul más oscuro en hover */
    }
</style>


