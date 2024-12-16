<?php if ($idUsuario && $rol === 'cliente'): ?>
    <div class="register-form">
        <form action="<?= $baseUrl ?>TasacionController/store" method="POST">

            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>

            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>

            <label for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" placeholder="ejemplo@gmail.com" required>

            <label for="telefono">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="601 123 123" required>

            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección del piso a vender" required>


            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
<?php elseif ($idUsuario): ?>
    <p class="else">Solo los clientes pueden solicitar una tasación.</p>
<?php else: ?>
    <p class="else">Para solicitar la tasación, debes <a href="<?= $baseUrl ?>AuthController/login">iniciar sesión</a>.</p>
<?php endif; ?>