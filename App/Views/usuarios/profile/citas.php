<div class="tab-pane fade show active" id="citas" role="tabpanel" aria-labelledby="citas-tab">
    <h2>Ver Todas las Citas</h2>
    <h3>Agregar Nueva Cita</h3>
    <form action="<?= $baseUrl ?>CitaController/store" method="POST">
        <input type="hidden" name="active_tab" value="citas">
        <label for="id_propiedad">Propiedad</label>
        <select id="id_propiedad" name="id_propiedad" required>
            <option value="">Seleccionar Propiedad</option>
            <?php foreach ($propiedades as $propiedad): ?>
                <option value="<?= $propiedad->id_propiedad ?>"><?= $propiedad->titulo ?></option>
            <?php endforeach; ?>
        </select>
        <label for="fecha_hora">Fecha y Hora</label>
        <input type="datetime-local" id="fecha_hora" name="fecha_hora" required>
        <label for="estado">Estado</label>
        <select id="estado" name="estado">
            <option value="pendiente">Pendiente</option>
            <option value="confirmado">Confirmado</option>
            <option value="cancelado">Cancelado</option>
        </select>
        <label for="id_agente">Agente</label>
        <select id="id_agente" name="id_agente">
            <option value="">Seleccionar Agente</option>
            <?php foreach ($agentes as $agente): ?>
                <option value="<?= $agente->id_usuario ?>"><?= $agente->nombre . ' ' . $agente->apellido ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Crear Cita</button>
    </form>
    <!-- Calendario interactivo -->
    <h3>Calendario de Citas</h3>
    <div id="calendar"></div>
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
                    <?php if ($rol === 'admin'): ?>
                        <form action="<?= $baseUrl ?>CitaController/edit/<?= $cita->id_cita ?>" method="POST" style="display:inline;">
                            <input type="hidden" name="active_tab" value="citas">
                            <button type="submit">Editar</button>
                        </form>
                        <form action="<?= $baseUrl ?>CitaController/delete" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $cita->id_cita ?>">
                            <input type="hidden" name="active_tab" value="citas">
                            <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cita?')">Eliminar</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- Formulario para editar una cita existente -->
    <?php if (isset($citaToEdit) && $rol === 'admin'): ?>
        <h3>Editar Cita</h3>
        <form action="<?= $baseUrl ?>CitaController/update" method="POST">
            <input type="hidden" name="active_tab" value="citas">
            <input type="hidden" name="id" value="<?= $citaToEdit->id_cita ?>">
            <label for="edit_id_propiedad">ID Propiedad</label>
            <input type="number" id="edit_id_propiedad" name="id_propiedad" value="<?= $citaToEdit->id_propiedad ?>" readonly>
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
    <?php if ($rol === 'cliente'): ?>
        <h3>Historial de Citas</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>ID Propiedad</th>
                <th>Fecha y Hora</th>
                <th>Estado</th>
            </tr>
            <?php foreach ($historialCitas as $cita): ?>
                <tr>
                    <td><?= $cita->id_cita ?></td>
                    <td><?= $cita->id_propiedad ?></td>
                    <td><?= $cita->fecha_hora ?></td>
                    <td><?= $cita->estado ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
</div>
