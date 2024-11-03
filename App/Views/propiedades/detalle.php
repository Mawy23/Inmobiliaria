<?php if (!empty($propiedad)): ?>
    <style>

        h2 {
            color: #333;
        }

        .detalle-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .detalle-item {
            margin-bottom: 15px;
        }

        .detalle-label {
            font-weight: bold;
            color: #007BFF;
        }

        .volver-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .volver-button:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="detalle-container">
        <h2><?php echo htmlspecialchars($propiedad->titulo); ?></h2>
        <div class="detalle-item">
            <span class="detalle-label">Descripción:</span>
            <p><?php echo htmlspecialchars($propiedad->descripcion); ?></p>
        </div>
        <div class="detalle-item">
            <span class="detalle-label">Precio:</span>
            <p><?php echo htmlspecialchars($propiedad->precio); ?> €</p>
        </div>
        <div class="detalle-item">
            <span class="detalle-label">Tipo:</span>
            <p><?php echo htmlspecialchars($propiedad->tipo); ?></p>
        </div>
        <div class="detalle-item">
            <span class="detalle-label">Dirección:</span>
            <p><?php echo htmlspecialchars($propiedad->direccion); ?></p>
        </div>
        <div class="detalle-item">
            <span class="detalle-label">Ciudad:</span>
            <p><?php echo htmlspecialchars($propiedad->ciudad); ?></p>
        </div>
        <div class="detalle-item">
            <span class="detalle-label">Estado:</span>
            <p><?php echo htmlspecialchars($propiedad->estado); ?></p>
        </div>
        <div class="detalle-item">
            <span class="detalle-label">Código Postal:</span>
            <p><?php echo htmlspecialchars($propiedad->codigo_postal); ?></p>
        </div>
        <div class="detalle-item">
            <span class="detalle-label">Agente ID:</span>
            <p><?php echo htmlspecialchars($propiedad->id_agente); ?></p>
        </div>

        <a class="volver-button" href="/Inmobiliaria/Public/PropiedadController">Volver a la lista</a>
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
