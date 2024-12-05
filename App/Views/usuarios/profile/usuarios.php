<div class="tab-pane fade show active" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
    <h2>Modificar Usuarios</h2>
    <!-- Formulario para crear un nuevo usuario -->
    <h3>Agregar Nuevo Usuario</h3>
    <form action="<?= $baseUrl ?>UsuariosController/store" method="POST">
        <input type="hidden" name="active_tab" value="usuarios">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" required>
        <label for="correo_electronico">Correo Electrónico</label>
        <input type="email" id="correo_electronico" name="correo_electronico" required>
        <label for="contraseña">Contraseña</label>
        <input type="password" id="contraseña" name="contraseña" required>
        <label for="confirmar_contraseña">Confirmar Contraseña</label>
        <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" required>
        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="telefono">
        <label for="rol">Rol</label>
        <select id="rol" name="rol" required>
            <option value="cliente">Cliente</option>
            <option value="agente">Agente</option>
            <option value="admin">Administrador</option>
        </select>
        <button type="submit">Crear Usuario</button>
    </form>
    <!-- Mostrar la lista de usuarios con opciones de edición y eliminación -->
    <h3>Lista de Usuarios</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo Electrónico</th>
            <th>Teléfono</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario->id_usuario ?></td>
                <td><?= $usuario->nombre ?></td>
                <td><?= $usuario->apellido ?></td>
                <td><?= $usuario->correo_electronico ?></td>
                <td><?= $usuario->telefono ?></td>
                <td><?= ucfirst($usuario->rol) ?></td>
                <td>
                    <?php if ($rol === 'admin'): ?>
                        <form action="<?= $baseUrl ?>UsuariosController/edit/<?= $usuario->id_usuario ?>" method="POST" style="display:inline;">
                            <input type="hidden" name="active_tab" value="usuarios">
                            <button type="submit">Editar</button>
                        </form>
                        <form action="<?= $baseUrl ?>UsuariosController/delete" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $usuario->id_usuario ?>">
                            <input type="hidden" name="active_tab" value="usuarios">
                            <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- Formulario para editar un usuario existente -->
    <?php if (isset($usuarioToEdit) && $rol === 'admin'): ?>
        <h3>Editar Usuario</h3>
        <form action="<?= $baseUrl ?>UsuariosController/update" method="POST">
            <input type="hidden" name="active_tab" value="usuarios">
            <input type="hidden" name="id" value="<?= $usuarioToEdit->id_usuario ?>">
            <label for="edit_nombre">Nombre</label>
            <input type="text" id="edit_nombre" name="nombre" value="<?= $usuarioToEdit->nombre ?>" required>
            <label for="edit_apellido">Apellido</label>
            <input type="text" id="edit_apellido" name="apellido" value="<?= $usuarioToEdit->apellido ?>" required>
            <label for="edit_correo_electronico">Correo Electrónico</label>
            <input type="email" id="edit_correo_electronico" name="correo_electronico" value="<?= $usuarioToEdit->correo_electronico ?>" required>
            <label for="edit_contraseña">Contraseña</label>
            <input type="password" id="edit_contraseña" name="contraseña" placeholder="Dejar en blanco si no deseas cambiarla">
            <label for="edit_telefono">Teléfono</label>
            <input type="text" id="edit_telefono" name="telefono" value="<?= $usuarioToEdit->telefono ?>">
            <label for="edit_rol">Rol</label>
            <select id="edit_rol" name="rol">
                <option value="cliente" <?= $usuarioToEdit->rol === 'cliente' ? 'selected' : '' ?>>Cliente</option>
                <option value="agente" <?= $usuarioToEdit->rol === 'agente' ? 'selected' : '' ?>>Agente</option>
                <option value="admin" <?= $usuarioToEdit->rol === 'admin' ? 'selected' : '' ?>>Administrador</option>
            </select>
            <button type="submit">Actualizar Usuario</button>
        </form>
    <?php endif; ?>
    <?php if ($rol === 'cliente'): ?>
        <h3>Mis Propiedades Favoritas</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($favoritos as $favorito): ?>
                <tr>
                    <td><?= $favorito->id_propiedad ?></td>
                    <td><?= $favorito->titulo ?></td>
                    <td><?= $favorito->descripcion ?></td>
                    <td>
                        <form action="<?= $baseUrl ?>FavoritosController/remove" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $favorito->id_propiedad ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>