<div class="tab-pane fade show active" id="propiedades" role="tabpanel" aria-labelledby="propiedades-tab">
    <h2>Añadir y Modificar Propiedades</h2>
    <!-- Formulario para crear una nueva propiedad -->
    <h3>Agregar Nueva Propiedad</h3>
    <form action="<?= $baseUrl ?>PropiedadController/store" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="active_tab" value="propiedades">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" required>
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
        <label for="precio">Precio</label>
        <input type="number" id="precio" name="precio" step="0.01" required>
        <label for="tipo">Tipo</label>
        <select id="tipo" name="tipo" required>
            <option value="casa">Casa</option>
            <option value="departamento">Departamento</option>
            <option value="terreno">Terreno</option>
        </select>
        <label for="direccion">Dirección</label>
        <input type="text" id="direccion" name="direccion" required>
        <label for="ciudad">Ciudad</label>
        <input type="text" id="ciudad" name="ciudad" required>
        <label for="estado">Estado</label>
        <input type="text" id="estado" name="estado" required>
        <label for="codigo_postal">Código Postal</label>
        <input type="text" id="codigo_postal" name="codigo_postal" required>
        <label for="id_agente">Agente</label>
        <select id="id_agente" name="id_agente">
            <option value="">Seleccionar Agente</option>
            <?php foreach ($agentes as $agente): ?>
                <option value="<?= $agente->id_usuario ?>"><?= $agente->nombre . ' ' . $agente->apellido ?></option>
            <?php endforeach; ?>
        </select>
        <label for="imagenes">Imágenes</label>
        <input type="file" id="imagenes" name="imagenes[]" accept="image/*" multiple required>
        <button type="submit">Crear Propiedad</button>
    </form>
    <!-- Mostrar la lista de propiedades con opciones de edición y eliminación -->
    <h3>Lista de Propiedades</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Tipo</th>
            <th>Dirección</th>
            <th>Ciudad</th>
            <th>Estado</th>
            <th>Código Postal</th>
            <th>Acciones</th>
        </tr>
        <?php if (!empty($propiedades)): ?>
            <?php foreach ($propiedades as $propiedad): ?>
                <tr>
                    <td><?= htmlspecialchars($propiedad->id_propiedad) ?></td>
                    <td><?= htmlspecialchars($propiedad->titulo) ?></td>
                    <td><?= htmlspecialchars($propiedad->descripcion) ?></td>
                    <td><?= number_format($propiedad->precio, 2) ?> €</td>
                    <td><?= ucfirst(htmlspecialchars($propiedad->tipo)) ?></td>
                    <td><?= htmlspecialchars($propiedad->direccion) ?></td>
                    <td><?= htmlspecialchars($propiedad->ciudad) ?></td>
                    <td><?= htmlspecialchars($propiedad->estado) ?></td>
                    <td><?= htmlspecialchars($propiedad->codigo_postal) ?></td>
                    <td>
                        <?php if ($rol === 'admin'): ?>
                            <form action="<?= $baseUrl ?>PropiedadController/edit/<?= $propiedad->id_propiedad ?>" method="POST" style="display:inline;">
                                <input type="hidden" name="active_tab" value="propiedades">
                                <button type="submit">Editar</button>
                            </form>
                            <form action="<?= $baseUrl ?>PropiedadController/delete" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($propiedad->id_propiedad) ?>">
                                <input type="hidden" name="active_tab" value="propiedades">
                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta propiedad?')">Eliminar</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">No hay propiedades disponibles en este momento.</td>
            </tr>
        <?php endif; ?>
    </table>
    <!-- Formulario para editar una propiedad existente -->
    <?php if (isset($propiedadToEdit) && $rol === 'admin'): ?>
        <h3>Editar Propiedad</h3>
        <form action="<?= $baseUrl ?>PropiedadController/update" method="POST">
            <input type="hidden" name="active_tab" value="propiedades">
            <input type="hidden" name="id" value="<?= $propiedadToEdit->id_propiedad ?>">
            <label for="edit_titulo">Título</label>
            <input type="text" id="edit_titulo" name="titulo" value="<?= $propiedadToEdit->titulo ?>" required>
            <label for="edit_descripcion">Descripción</label>
            <textarea id="edit_descripcion" name="descripcion" required><?= $propiedadToEdit->descripcion ?></textarea>
            <label for="edit_precio">Precio</label>
            <input type="number" id="edit_precio" name="precio" step="0.01" value="<?= $propiedadToEdit->precio ?>" required>
            <label for="edit_tipo">Tipo</label>
            <select id="edit_tipo" name="tipo" required>
                <option value="casa" <?= $propiedadToEdit->tipo === 'casa' ? 'selected' : '' ?>>Casa</option>
                <option value="departamento" <?= $propiedadToEdit->tipo === 'departamento' ? 'selected' : '' ?>>Departamento</option>
                <option value="terreno" <?= $propiedadToEdit->tipo === 'terreno' ? 'selected' : '' ?>>Terreno</option>
            </select>
            <label for="edit_direccion">Dirección</label>
            <input type="text" id="edit_direccion" name="direccion" value="<?= $propiedadToEdit->direccion ?>" required>
            <label for="edit_ciudad">Ciudad</label>
            <input type="text" id="edit_ciudad" name="ciudad" value="<?= $propiedadToEdit->ciudad ?>" required>
            <label for="edit_estado">Estado</label>
            <input type="text" id="edit_estado" name="estado" value="<?= $propiedadToEdit->estado ?>" required>
            <label for="edit_codigo_postal">Código Postal</label>
            <input type="text" id="edit_codigo_postal" name="codigo_postal" value="<?= $propiedadToEdit->codigo_postal ?>" required>
            <label for="edit_id_agente">ID Agente</label>
            <input type="number" id="edit_id_agente" name="id_agente" value="<?= $propiedadToEdit->id_agente ?>">
            <button type="submit">Actualizar Propiedad</button>
        </form>
    <?php endif; ?>
</div>