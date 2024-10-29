<!--
 *
 * Esta vista es responsable de gestionar las citas en la aplicación inmobiliaria.
 * Muestra una lista de citas programadas en formato de tabla y proporciona opciones para actualizar
 * el estado de cada cita o eliminar una cita.
 *
 * Características:
 * - Muestra una tabla con las siguientes columnas: ID Cita, ID Propiedad, ID Cliente, Fecha y Hora, Estado, Acciones.
 * - Para cada cita, muestra el ID, ID de la propiedad, ID del cliente, fecha y hora, y estado.
 * - Proporciona un formulario para actualizar el estado de una cita con opciones: Pendiente, Confirmada, Cancelada.
 * - Proporciona un formulario para eliminar una cita con una solicitud de confirmación.
 *
 * Variables:
 * - $citas: Un array de objetos de citas que se mostrarán en la tabla.
 * - $baseUrl: La URL base para las acciones de los formularios.
-->

<?php
// Asegúrate de que $citas está definida y es un array antes de usarla.
$citas = isset($citas) && is_array($citas) ? $citas : [];
?>

<div>
    <h2>Gestionar Citas</h2>

    <!-- Mostrar la lista de citas agendadas -->
    <table border="1">
        <tr>
            <th>ID Cita</th>
            <th>ID Propiedad</th>
            <th>ID Cliente</th>
            <th>Fecha y Hora</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        <?php if (!empty($citas)): ?>
            <?php foreach ($citas as $cita): ?>
                <tr>
                    <td><?= $cita->id_cita ?></td>
                    <td><?= $cita->id_propiedad ?></td>
                    <td><?= $cita->id_cliente ?></td>
                    <td><?= $cita->fecha_hora ?></td>
                    <td><?= ucfirst($cita->estado) ?></td>
                    <td>
                        <!-- Formulario para actualizar el estado de la cita -->
                        <form action="<?= $baseUrl ?>citas/update" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $cita->id_cita ?>">
                            <select name="estado" required>
                                <option value="pendiente" <?= $cita->estado == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                                <option value="confirmada" <?= $cita->estado == 'confirmada' ? 'selected' : '' ?>>Confirmada</option>
                                <option value="cancelada" <?= $cita->estado == 'cancelada' ? 'selected' : '' ?>>Cancelada</option>
                            </select>
                            <button type="submit">Actualizar</button>
                        </form>

                        <!-- Botón para eliminar cita -->
                        <form action="<?= $baseUrl ?>citas/delete" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $cita->id_cita ?>">
                            <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cita?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No hay citas para mostrar.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>
