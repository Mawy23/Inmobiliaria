<!--
 *
 * Esta vista es responsable de mostrar la interfaz de programación de citas.
 * Incluye un formulario para agregar nuevas citas y una tabla para listar las citas programadas.
 *
 * Características:
 * - Formulario para programar una nueva cita con campos para ID de propiedad, ID de cliente, fecha y hora, y estado.
 * - Menú desplegable para seleccionar el estado de la cita (Pendiente, Confirmada, Cancelada).
 * - Tabla que muestra la lista de citas programadas con columnas para ID de cita, ID de propiedad, ID de cliente, fecha y hora, estado y acciones.
 * - Cada fila en la tabla incluye un botón para eliminar la cita correspondiente.
 *
 * Variables:
 * - $baseUrl: URL base para las acciones del formulario.
 * - $citas: Array de objetos de citas para ser mostrados en la tabla.
-->
 
<div>
    <h2>Agendar Cita</h2>

    <!-- Agregar un formulario para agendar una cita -->
    <h3>Agregar Nueva Cita</h3>
    <p>Por favor, ingrese los datos de la cita a agendar:</p>
    <form action="<?= $baseUrl ?>citas/store" method="POST">
        <label for="id_propiedad">ID de Propiedad</label>
        <input type="number" id="id_propiedad" name="id_propiedad" required>

        <label for="id_cliente">ID de Cliente</label>
        <input type="number" id="id_cliente" name="id_cliente" required>

        <label for="fecha_hora">Fecha y Hora</label>
        <input type="datetime-local" id="fecha_hora" name="fecha_hora" required>

        <label for="estado">Estado</label>
        <select id="estado" name="estado" required>
            <option value="pendiente">Pendiente</option>
            <option value="confirmada">Confirmada</option>
            <option value="cancelada">Cancelada</option>
        </select>

        <button type="submit">Agendar Cita</button>
    </form>

    <!-- Mostrar la lista de citas agendadas -->
    <h3>Lista de Citas Agendadas</h3>
    <table border="1">
        <tr>
            <th>ID Cita</th>
            <th>ID Propiedad</th>
            <th>ID Cliente</th>
            <th>Fecha y Hora</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php 
            // Verifica si $citas está definido y es un array
            if (isset($citas) && is_array($citas) && !empty($citas)): ?>
            <?php foreach ($citas as $cita): ?>
                <tr>
                    <td><?= htmlspecialchars($cita->id_cita) ?></td>
                    <td><?= htmlspecialchars($cita->id_propiedad) ?></td>
                    <td><?= htmlspecialchars($cita->id_cliente) ?></td>
                    <td><?= htmlspecialchars($cita->fecha_hora) ?></td>
                    <td><?= ucfirst(htmlspecialchars($cita->estado)) ?></td>
                    <td>
                        <!-- Botón para eliminar cita -->
                        <form action="<?= $baseUrl ?>citas/delete" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($cita->id_cita) ?>">
                            <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cita?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No hay citas agendadas.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>
