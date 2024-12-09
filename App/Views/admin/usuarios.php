<?php
// Asegúrate de que $usuarios está definida y es un array antes de usarla
$usuarios = isset($usuarios) && is_array($usuarios) ? $usuarios : [];
?>

<div>
    <h2>Gestión de Usuarios</h2>

    <!-- Formulario para crear un nuevo usuario -->
    <h3>Agregar Nuevo Usuario</h3>
    <form action="<?= $baseUrl ?>UsuariosController/store" method="POST">
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="apellido">Apellido</label>
        <input type="text" id="apellido" name="apellido" required>

        <label for="correo_electronico">Correo Electrónico</label>
        <input type="email" id="correo_electronico" name="correo_electronico" required>

        <label for="contraseña">Contraseña</label>
        <input type="password" id="contraseña" name="contraseña" required>

        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="telefono">

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
                    <!-- Botón para cargar datos de usuario en el formulario de edición -->
                    <form action="<?= $baseUrl ?>UsuariosController/edit/<?= $usuario->id_usuario ?>" method="POST" style="display:inline;">
                        <button type="submit">Editar</button>
                    </form>

                    <!-- Botón para eliminar usuario -->
                    <form action="<?= $baseUrl ?>UsuariosController/delete" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $usuario->id_usuario ?>">
                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Formulario para editar un usuario existente (solo se muestra si se cargó un usuario para editar) -->
    <?php if (isset($usuarioToEdit)): ?>
        <h3>Editar Usuario</h3>
        <form action="<?= $baseUrl ?>UsuariosController/update" method="POST">
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
                <option value="usuario" <?= $usuarioToEdit->rol === 'usuario' ? 'selected' : '' ?>>Usuario</option>
                <option value="editor" <?= $usuarioToEdit->rol === 'agente' ? 'selected' : '' ?>>Agente</option>
                <option value="admin" <?= $usuarioToEdit->rol === 'admin' ? 'selected' : '' ?>>Administrador</option>
            </select>

            <button type="submit">Actualizar Usuario</button>
        </form>
    <?php endif; ?>
</div>