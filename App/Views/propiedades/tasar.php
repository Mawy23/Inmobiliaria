<?php if ($idUsuario && $rol === 'cliente'): ?>
    <div class="register-form">
        <form action="<?= $baseUrl ?>TasacionController/store" method="POST">
            
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
<?php elseif ($idUsuario): ?>
    <p class="else">Solo los clientes pueden solicitar una tasación.</p>
<?php else: ?>
    <p class="else">Para solicitar la tasación, debes <a href="<?= $baseUrl ?>AuthController/login">iniciar sesión</a>.</p>
<?php endif; ?>
