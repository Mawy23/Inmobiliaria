<div class="tab-pane show active" id="citas" role="tabpanel" aria-labelledby="citas-tab">
    <h2>Ver Todas las Citas</h2>
    <!-- Calendario interactivo -->
    <h3>Calendario de Citas</h3>
    <div id="calendar"></div>
    <!-- Mostrar la lista de citas con opciones de edición y eliminación -->
    <h3>Lista de Citas</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ID Propiedad</th>
            <th>Cliente</th>
            <th>ID Agente</th>
            <th>Fecha y Hora</th>
            <th>Estado</th>
            <th>Disponible</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($citas as $cita): ?>
            <tr>
                <td><?= $cita->id_cita ?></td>
                <td><?= $cita->id_propiedad ?></td>
                <td>
                    <?php if (isset($usuarios[$cita->id_cliente])): ?>
                        <?= $usuarios[$cita->id_cliente]->nombre . ' ' . $usuarios[$cita->id_cliente]->apellido ?>
                    <?php else: ?>
                        <?= $cita->id_cliente ?>
                    <?php endif; ?>
                </td>
                <td><?= $cita->id_agente ?></td>
                <td><?= $cita->fecha_hora ?></td>
                <td><?= $cita->estado ?></td>
                <td><?= $cita->disponible ? 'Sí' : 'No' ?></td>
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
            <label for="edit_disponible">Disponible</label>
            <select id="edit_disponible" name="disponible">
                <option value="1" <?= $citaToEdit->disponible ? 'selected' : '' ?>>Sí</option>
                <option value="0" <?= !$citaToEdit->disponible ? 'selected' : '' ?>>No</option>
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
            <?php if (isset($historialCitas) && is_array($historialCitas)): ?>
                <?php foreach ($historialCitas as $cita): ?>
                    <tr>
                        <td><?= $cita->id_cita ?></td>
                        <td><?= $cita->id_propiedad ?></td>
                        <td><?= $cita->fecha_hora ?></td>
                        <td><?= $cita->estado ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay citas en el historial.</td>
                </tr>
            <?php endif; ?>
        </table>
    <?php endif; ?>

    <?php if ($rol === 'admin' || $rol === 'agente'): ?>
        <h3>Agregar Horas Disponibles para Visitas</h3>
        <form action="<?= $baseUrl ?>CitaController/addAvailableHours" method="POST">
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
            <label for="id_agente">Agente</label>
            <select id="id_agente" name="id_agente" required>
                <option value="">Seleccionar Agente</option>
                <?php foreach ($agentes as $agente): ?>
                    <option value="<?= $agente->id_usuario ?>"><?= $agente->nombre . ' ' . $agente->apellido ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Agregar Hora Disponible</button>
        </form>
    <?php endif; ?>
</div>
</div>
