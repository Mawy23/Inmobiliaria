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
            <table class="table">
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
                            <td><?= htmlspecialchars($propiedad->titulo) ?></td>
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
        <table class="table">
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
                        <td><?= htmlspecialchars($propiedad->titulo) ?></td>
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