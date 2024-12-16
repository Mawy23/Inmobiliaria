<div class="container">
    <h2>Comparar Propiedades</h2>
    <form class="search-form" method="get" action="<?= $baseUrl ?>PropiedadController/comparar">
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="tipo">Tipo</label>
                <select class="form-control" id="tipo" name="tipo" style="height: auto;">
                    <option value="">Todos</option>
                    <?php foreach ($tipos as $tipo): ?>
                        <option value="<?= htmlspecialchars($tipo) ?>" <?= isset($_GET['tipo']) && $_GET['tipo'] == $tipo ? 'selected' : '' ?>><?= htmlspecialchars($tipo) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="precio_min">Precio Mínimo</label>
                <input type="number" class="form-control" id="precio_min" name="precio_min" style="height: auto;" value="<?= htmlspecialchars($_GET['precio_min'] ?? '') ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="precio_max">Precio Máximo</label>
                <input type="number" class="form-control" id="precio_max" name="precio_max" style="height: auto;" value="<?= htmlspecialchars($_GET['precio_max'] ?? '') ?>">
            </div>
            <div class="form-group col-md-3">
                <label for="ciudad">Ciudad</label>
                <select class="form-control" id="ciudad" name="ciudad" style="height: auto;">
                    <option value="">Todas</option>
                    <?php foreach ($ciudades as $ciudad): ?>
                        <option value="<?= htmlspecialchars($ciudad) ?>" <?= isset($_GET['ciudad']) && $_GET['ciudad'] == $ciudad ? 'selected' : '' ?>><?= htmlspecialchars($ciudad) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
        <a href="<?= $baseUrl ?>PropiedadController/comparar" class="btn btn-secondary">Reiniciar Filtros</a>
    </form>
    <form method="post" action="<?= $baseUrl ?>PropiedadController/comparar?<?= http_build_query($_GET) ?>">
        <?php if (!empty($propiedades)): ?>
            <table class="comparar-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Precio</th>
                        <th>Tipo</th>
                        <th>Ciudad</th>
                        <th>Estado</th>
                        <th>Dirección</th>
                        <th>Seleccionar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($propiedades as $propiedad): ?>
                        <tr>
                            <td class="titulo"><?= htmlspecialchars($propiedad->titulo) ?></td>
                            <td><?= htmlspecialchars($propiedad->precio) ?> €</td>
                            <td><?= htmlspecialchars($propiedad->tipo) ?></td>
                            <td><?= htmlspecialchars($propiedad->ciudad) ?></td>
                            <td><?= htmlspecialchars($propiedad->estado) ?></td>
                            <td><?= htmlspecialchars($propiedad->direccion) ?></td>
                            <td><input type="checkbox" name="propiedades[]" value="<?= $propiedad->id_propiedad ?>"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Comparar</button>
        <?php else: ?>
            <p>No se encontraron propiedades con los filtros aplicados.</p>
        <?php endif; ?>
    </form>
    <?php if (!empty($propiedadesComparar)): ?>
        <h3>Propiedades Seleccionadas</h3>
        <table class="comparar-table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Precio</th>
                    <th>Tipo</th>
                    <th>Ciudad</th>
                    <th>Estado</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($propiedadesComparar as $propiedad): ?>
                    <tr>
                        <td class="titulo"><?= htmlspecialchars($propiedad->titulo) ?></td>
                        <td><?= htmlspecialchars($propiedad->precio) ?> €</td>
                        <td><?= htmlspecialchars($propiedad->tipo) ?></td>
                        <td><?= htmlspecialchars($propiedad->ciudad) ?></td>
                        <td><?= htmlspecialchars($propiedad->estado) ?></td>
                        <td><?= htmlspecialchars($propiedad->direccion) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<style>
/* Estilos para la tabla de comparación */
.comparar-table {
    width: 100%; /* Ocupa todo el ancho del contenedor */
    border-collapse: collapse; /* Elimina el espacio entre bordes */
    margin-bottom: 20px; /* Espaciado inferior */
    font-size: 1em; /* Tamaño de fuente */
    background-color: #fff; /* Fondo blanco */
    border-radius: 8px; /* Bordes redondeados */
    overflow: hidden; /* Oculta bordes externos al redondear */
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05); /* Sombra ligera */
}

/* Encabezados de tabla */
.comparar-table thead {
    background-color: #4CAF50; /* Verde llamativo */
    color: white;
}

.comparar-table th {
    padding: 12px 15px;
    text-align: left;
    font-weight: bold;
}

/* Filas de tabla */
.comparar-table tbody tr {
    border-bottom: 1px solid #ddd;
    transition: background-color 0.3s ease;
}

.comparar-table tbody tr:hover {
    background-color: #f1f1f1; /* Cambio de color al pasar el ratón */
}

.comparar-table td {
    padding: 12px 15px;
    color: #555; /* Texto gris */
}

/* Estilos para dispositivos móviles */
@media (max-width: 768px) {
    .comparar-table thead {
        display: none; /* Ocultar encabezados en móviles */
    }
    
    .comparar-table tbody tr {
        display: block; /* Convertir las filas en bloques */
        margin-bottom: 20px; /* Espaciado entre filas */
    }

    .titulo {
        font-weight: bold;
        background-color: #4CAF50; /* Verde llamativo */
        color: white;
    }

    .comparar-table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
        position: relative;
        padding: 10px 15px;
    }

    .comparar-table td:before {
        content: attr(data-label); /* Etiquetas para cada celda */
        font-weight: bold;
        color: #333; /* Texto oscuro */
        text-align: left;
        padding-right: 10px; /* Espaciado entre la etiqueta y el valor */
    }
}
</style>
