<div class="tab-pane fade show active" id="tasaciones" role="tabpanel" aria-labelledby="tasaciones-tab">
    <h2>Tasaciones</h2>
    <?php if (isset($tasaciones) && is_array($tasaciones) && count($tasaciones) > 0): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasaciones as $tasacion): ?>
                    <tr>
                        <td><?= htmlspecialchars($tasacion->id_tasacion) ?></td>
                        <td><?= htmlspecialchars($tasacion->nombre) ?></td>
                        <td><?= htmlspecialchars($tasacion->apellido) ?></td>
                        <td><?= htmlspecialchars($tasacion->correo) ?></td>
                        <td>
                            <form action="<?= $baseUrl ?>TasacionController/edit<?= htmlspecialchars($tasacion->id_tasacion) ?>" method="post" style="display:inline;">
                                <button type="submit">Editar</button>
                            </form>
                            <form action="<?= $baseUrl ?>TasacionController/delete" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($tasacion->id_tasacion) ?>">
                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta tasación?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay tasaciones disponibles.</p>
    <?php endif; ?>
</div>
