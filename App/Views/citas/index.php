<?php if (!empty($citas)): ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID Cita</th>
                <th>ID Propiedad</th>
                <th>ID Cliente</th>
                <th>ID Agente</th>
                <th>Fecha y Hora</th>
                <th>Estado</th>
                <th>Disponible</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($citas as $cita): ?>
                <tr>
                    <td><?= htmlspecialchars($cita->id_cita) ?></td>
                    <td><?= htmlspecialchars($cita->id_propiedad) ?></td>
                    <td><?= htmlspecialchars($cita->id_cliente ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($cita->id_agente) ?></td>
                    <td><?= htmlspecialchars($cita->fecha_hora) ?></td>
                    <td><?= htmlspecialchars($cita->estado) ?></td>
                    <td><?= htmlspecialchars($cita->disponible ? 'Sí' : 'No') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No tienes citas programadas.</p>
<?php endif; ?>
