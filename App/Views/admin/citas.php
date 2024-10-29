<div>
    <h2>Gestión de Citas</h2>
    
    <!-- Formulario para crear una nueva cita -->
    <h3>Agregar Nueva Cita</h3>
    <form action="<?= $baseUrl ?>citas/store" method="POST">
        <label for="id_propiedad">ID Propiedad</label>
        <input type="number" id="id_propiedad" name="id_propiedad" required>
        
        <label for="id_cliente">ID Cliente</label>
        <input type="number" id="id_cliente" name="id_cliente" required>
        
        <label for="fecha_hora">Fecha y Hora</label>
        <input type="datetime-local" id="fecha_hora" name="fecha_hora" required>
        
        <label for="estado">Estado</label>
        <select id="estado" name="estado">
            <option value="pendiente">Pendiente</option>
            <option value="confirmado">Confirmado</option>
            <option value="cancelado">Cancelado</option>
        </select>
        
        <button type="submit">Crear Cita</button>
    </form>

    <!-- Mostrar la lista de citas con opciones de edición y eliminación -->
    <h3>Lista de Citas</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ID Propiedad</th>
            <th>ID Cliente</th>
            <th>Fecha y Hora</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($citas as $cita): ?>
            <tr>
                <td><?= $cita->id_cita ?></td>
                <td><?= $cita->id_propiedad ?></td>
                <td><?= $cita->id_cliente ?></td>
                <td><?= $cita->fecha_hora ?></td>
                <td><?= $cita->estado ?></td>
                <td>
                    <!-- Botón para cargar datos de cita en el formulario de edición -->
                    <form action="<?= $baseUrl ?>citas/edit" method="GET" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $cita->id_cita ?>">
                        <button type="submit">Editar</button>
                    </form>

                    <!-- Botón para eliminar cita -->
                    <form action="<?= $baseUrl ?>citas/delete" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $cita->id_cita ?>">
                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cita?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Formulario para editar una cita existente (solo se muestra si se cargó una cita para editar) -->
    <?php if (isset($citaToEdit)): ?>
        <h3>Editar Cita</h3>
        <form action="<?= $baseUrl ?>citas/update" method="POST">
            <input type="hidden" name="id" value="<?= $citaToEdit->id_cita ?>">

            <label for="edit_id_propiedad">ID Propiedad</label>
            <input type="number" id="edit_id_propiedad" name="id_propiedad" value="<?= $citaToEdit->id_propiedad ?>" readonly>

            <label for="edit_id_cliente">ID Cliente</label>
            <input type="number" id="edit_id_cliente" name="id_cliente" value="<?= $citaToEdit->id_cliente ?>" readonly>

            <label for="edit_fecha_hora">Fecha y Hora</label>
            <input type="datetime-local" id="edit_fecha_hora" name="fecha_hora" value="<?= $citaToEdit->fecha_hora ?>" required>

            <label for="edit_estado">Estado</label>
            <select id="edit_estado" name="estado">
                <option value="pendiente" <?= $citaToEdit->estado == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="confirmado" <?= $citaToEdit->estado == 'confirmado' ? 'selected' : '' ?>>Confirmado</option>
                <option value="cancelado" <?= $citaToEdit->estado == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
            </select>

            <button type="submit">Actualizar Cita</button>
        </form>
    <?php endif; ?>
</div>
