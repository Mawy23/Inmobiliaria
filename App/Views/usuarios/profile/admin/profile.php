<div class="container">
    <h1>¡Hola, <?= $nombre ?>!</h1>
    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="true">Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="propiedades-tab" data-toggle="tab" href="#propiedades" role="tab" aria-controls="propiedades" aria-selected="false">Propiedades</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="citas-tab" data-toggle="tab" href="#citas" role="tab" aria-controls="citas" aria-selected="false">Citas</a>
        </li>
    </ul>
    <!-- Contenido de las pestañas -->
    <div class="tab-content" id="profileTabsContent">
        <!-- Pestaña de Usuarios -->
        <div class="tab-pane fade show active" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
            <h2>Modificar Usuarios</h2>
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
                            <form action="<?= $baseUrl ?>UsuariosController/edit/<?= $usuario->id_usuario ?>" method="POST" style="display:inline;">
                                <input type="hidden" name="active_tab" value="usuarios">
                                <button type="submit">Editar</button>
                            </form>
                            <form action="<?= $baseUrl ?>UsuariosController/delete" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $usuario->id_usuario ?>">
                                <input type="hidden" name="active_tab" value="usuarios">
                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- Formulario para editar un usuario existente -->
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
                        <option value="cliente" <?= $usuarioToEdit->rol === 'cliente' ? 'selected' : '' ?>>Cliente</option>
                        <option value="agente" <?= $usuarioToEdit->rol === 'agente' ? 'selected' : '' ?>>Agente</option>
                        <option value="admin" <?= $usuarioToEdit->rol === 'admin' ? 'selected' : '' ?>>Administrador</option>
                    </select>
                    <button type="submit">Actualizar Usuario</button>
                </form>
            <?php endif; ?>
        </div>
        <div class="tab-pane fade" id="propiedades" role="tabpanel" aria-labelledby="propiedades-tab">
            <h2>Añadir y Modificar Propiedades</h2>
            <!-- Formulario para crear una nueva propiedad -->
            <h3>Agregar Nueva Propiedad</h3>
            <form action="<?= $baseUrl ?>PropiedadController/store" method="POST">
                <label for="titulo">Título</label>
                <input type="text" id="titulo" name="titulo" required>
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" required></textarea>
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" step="0.01" required>
                <label for="tipo">Tipo</label>
                <select id="tipo" name="tipo" required>
                    <option value="casa">Casa</option>
                    <option value="departamento">Departamento</option>
                    <option value="terreno">Terreno</option>
                </select>
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" required>
                <label for="ciudad">Ciudad</label>
                <input type="text" id="ciudad" name="ciudad" required>
                <label for="estado">Estado</label>
                <input type="text" id="estado" name="estado" required>
                <label for="codigo_postal">Código Postal</label>
                <input type="text" id="codigo_postal" name="codigo_postal" required>
                <label for="id_agente">ID Agente</label>
                <input type="number" id="id_agente" name="id_agente">
                <button type="submit">Crear Propiedad</button>
            </form>
            <!-- Mostrar la lista de propiedades con opciones de edición y eliminación -->
            <h3>Lista de Propiedades</h3>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Tipo</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Estado</th>
                    <th>Código Postal</th>
                    <th>Acciones</th>
                </tr>
                <?php if (!empty($propiedades)): ?>
                    <?php foreach ($propiedades as $propiedad): ?>
                        <tr>
                            <td><?= htmlspecialchars($propiedad->id_propiedad) ?></td>
                            <td><?= htmlspecialchars($propiedad->titulo) ?></td>
                            <td><?= htmlspecialchars($propiedad->descripcion) ?></td>
                            <td><?= number_format($propiedad->precio, 2) ?> €</td>
                            <td><?= ucfirst(htmlspecialchars($propiedad->tipo)) ?></td>
                            <td><?= htmlspecialchars($propiedad->direccion) ?></td>
                            <td><?= htmlspecialchars($propiedad->ciudad) ?></td>
                            <td><?= htmlspecialchars($propiedad->estado) ?></td>
                            <td><?= htmlspecialchars($propiedad->codigo_postal) ?></td>
                            <td>
                                <form action="<?= $baseUrl ?>PropiedadController/edit/<?= $propiedad->id_propiedad ?>" method="POST" style="display:inline;">
                                    <input type="hidden" name="active_tab" value="propiedades">
                                    <button type="submit">Editar</button>
                                </form>
                                <form action="<?= $baseUrl ?>PropiedadController/delete" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($propiedad->id_propiedad) ?>">
                                    <input type="hidden" name="active_tab" value="propiedades">
                                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta propiedad?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">No hay propiedades disponibles en este momento.</td>
                    </tr>
                <?php endif; ?>
            </table>
            <!-- Formulario para editar una propiedad existente -->
            <?php if (isset($propiedadToEdit)): ?>
                <h3>Editar Propiedad</h3>
                <form action="<?= $baseUrl ?>PropiedadController/update" method="POST">
                    <input type="hidden" name="id" value="<?= $propiedadToEdit->id_propiedad ?>">
                    <label for="edit_titulo">Título</label>
                    <input type="text" id="edit_titulo" name="titulo" value="<?= $propiedadToEdit->titulo ?>" required>
                    <label for="edit_descripcion">Descripción</label>
                    <textarea id="edit_descripcion" name="descripcion" required><?= $propiedadToEdit->descripcion ?></textarea>
                    <label for="edit_precio">Precio</label>
                    <input type="number" id="edit_precio" name="precio" step="0.01" value="<?= $propiedadToEdit->precio ?>" required>
                    <label for="edit_tipo">Tipo</label>
                    <select id="edit_tipo" name="tipo" required>
                        <option value="casa" <?= $propiedadToEdit->tipo === 'casa' ? 'selected' : '' ?>>Casa</option>
                        <option value="departamento" <?= $propiedadToEdit->tipo === 'departamento' ? 'selected' : '' ?>>Departamento</option>
                        <option value="terreno" <?= $propiedadToEdit->tipo === 'terreno' ? 'selected' : '' ?>>Terreno</option>
                    </select>
                    <label for="edit_direccion">Dirección</label>
                    <input type="text" id="edit_direccion" name="direccion" value="<?= $propiedadToEdit->direccion ?>" required>
                    <label for="edit_ciudad">Ciudad</label>
                    <input type="text" id="edit_ciudad" name="ciudad" value="<?= $propiedadToEdit->ciudad ?>" required>
                    <label for="edit_estado">Estado</label>
                    <input type="text" id="edit_estado" name="estado" value="<?= $propiedadToEdit->estado ?>" required>
                    <label for="edit_codigo_postal">Código Postal</label>
                    <input type="text" id="edit_codigo_postal" name="codigo_postal" value="<?= $propiedadToEdit->codigo_postal ?>" required>
                    <label for="edit_id_agente">ID Agente</label>
                    <input type="number" id="edit_id_agente" name="id_agente" value="<?= $propiedadToEdit->id_agente ?>">
                    <button type="submit">Actualizar Propiedad</button>
                </form>
            <?php endif; ?>
        </div>
        <div class="tab-pane fade" id="citas" role="tabpanel" aria-labelledby="citas-tab">
            <h2>Ver Todas las Citas</h2>
            <!-- Formulario para crear una nueva cita -->
            <h3>Agregar Nueva Cita</h3>
            <form action="<?= $baseUrl ?>CitaController/store" method="POST">
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
                            <form action="<?= $baseUrl ?>CitaController/edit/<?= $cita->id_cita ?>" method="POST" style="display:inline;">
                                <input type="hidden" name="active_tab" value="citas">
                                <button type="submit">Editar</button>
                            </form>
                            <form action="<?= $baseUrl ?>CitaController/delete" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $cita->id_cita ?>">
                                <input type="hidden" name="active_tab" value="citas">
                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cita?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- Formulario para editar una cita existente -->
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
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var activeTab = '<?= isset($_POST['active_tab']) ? $_POST['active_tab'] : 'usuarios' ?>';
        var tabElement = document.querySelector('#' + activeTab + '-tab');
        var tabContentElement = document.querySelector('#' + activeTab);
        if (tabElement && tabContentElement) {
            // Desactivar todas las pestañas y contenido
            document.querySelectorAll('.nav-link').forEach(function (link) {
                link.classList.remove('active');
            });
            document.querySelectorAll('.tab-pane').forEach(function (pane) {
                pane.classList.remove('show', 'active');
            });
            // Activar la pestaña y contenido correspondiente
            tabElement.classList.add('active');
            tabContentElement.classList.add('show', 'active');
        }
    });
</script>
