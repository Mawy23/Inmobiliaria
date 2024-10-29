<!--
 *
 * Este archivo contiene el código HTML y PHP para la gestión de usuarios en el panel de administración.
 * Incluye las siguientes secciones:
 *
 * 1. Encabezado: Muestra el título "Gestión de Usuarios".
 *
 * 2. Formulario para Crear un Nuevo Usuario:
 *    - Acción: Envía al endpoint "usuarios/store".
 *    - Campos: Nombre, Apellido, Correo Electrónico, Contraseña, Teléfono.
 *    - Botón de Envío: "Crear Usuario".
 *
 * 3. Lista de Usuarios:
 *    - Muestra una tabla con las columnas: ID, Nombre, Apellido, Correo Electrónico, Teléfono, Rol, Acciones.
 *    - Cada fila de usuario incluye:
 *      - Botón de Editar: Envía al endpoint "usuarios/edit" con el ID del usuario.
 *      - Botón de Eliminar: Envía al endpoint "usuarios/delete" con el ID del usuario y una solicitud de confirmación.
 *
 * 4. Formulario para Editar un Usuario Existente (mostrado condicionalmente si se carga un usuario para editar):
 *    - Acción: Envía al endpoint "usuarios/update".
 *    - Campos: Nombre, Apellido, Correo Electrónico, Contraseña (opcional), Teléfono.
 *    - Botón de Envío: "Actualizar Usuario".
-->

<?php
// Asegúrate de que $usuarios está definida y es un array antes de usarla
$usuarios = isset($usuarios) && is_array($usuarios) ? $usuarios : [];
?>

<div>
    <h2>Gestión de Usuarios</h2>
    
    <!-- Formulario para crear un nuevo usuario -->
    <h3>Agregar Nuevo Usuario</h3>
    <form action="<?= $baseUrl ?>usuarios/store" method="POST">
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
                    <form action="<?= $baseUrl ?>usuarios/edit" method="GET" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $usuario->id_usuario ?>">
                        <button type="submit">Editar</button>
                    </form>

                    <!-- Botón para eliminar usuario -->
                    <form action="<?= $baseUrl ?>usuarios/delete" method="POST" style="display:inline;">
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
        <form action="<?= $baseUrl ?>usuarios/update" method="POST">
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

            <button type="submit">Actualizar Usuario</button>
        </form>
    <?php endif; ?>
</div>
