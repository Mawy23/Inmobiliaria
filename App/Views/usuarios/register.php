<div class="register-form">
    <h2>Registrarse</h2>
    <form action="store" method="POST">
        <!-- Campo para Nombre -->
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" maxlength="50" required>
        <br><br>

        <!-- Campo para Apellido -->
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" maxlength="50" required>
        <br><br>

        <!-- Campo para Correo Electrónico -->
        <label for="correo_electronico">Correo Electrónico:</label>
        <input type="email" id="correo_electronico" name="correo_electronico" maxlength="100" required>
        <br><br>

        <!-- Campo para Teléfono (Opcional) -->
        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" maxlength="15">
        <br><br>

        <!-- Campo para Contraseña -->
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" maxlength="255" required>
        <br><br>

        <!-- Campo para Confirmar Contraseña -->
        <label for="confirmar_contraseña">Confirmar Contraseña:</label>
        <input type="password" id="confirmar_contraseña" name="confirmar_contraseña" maxlength="255" required>
        <br><br>

        <!-- botón de envío -->
        <button class="submit-btn" type="submit">Registrarse</button>
    </form>
    <!-- Enlace para redirigir a la página de login -->
    <a class="register-link" href="<?= $baseUrl ?>AuthController/login">¿Ya tienes cuenta? Inicia sesión</a>
</div>
