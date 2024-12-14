<?php if ($idUsuario && $rol === 'cliente'): ?>
    <form action="<?= $baseUrl ?>TasacionController/store" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
<?php elseif ($idUsuario): ?>
    <p>Solo los clientes pueden solicitar una tasación.</p>
<?php else: ?>
    <p>Para solicitar la tasación, debes <a href="<?= $baseUrl ?>AuthController/login">iniciar sesión</a>.</p>
<?php endif; ?>
