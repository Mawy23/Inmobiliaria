<div class="login-container">
    <h2 class="login-title">Iniciar Sesión</h2>
    <?php if (isset($_GET['error'])): ?>
        <div class="error-message"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>
    <form class="login-form" action="authenticate" method="POST">
        <label for="correo_electronico" class="login-label">Correo</label>
        <input type="email" id="correo_electronico" name="correo_electronico" class="login-input" required>
        
        <label for="contraseña" class="login-label">Contraseña</label>
        <input type="password" id="contraseña" name="contraseña" class="login-input" required>
        
        <button type="submit" class="login-button">Iniciar Sesión</button>
    </form>
    <a href="<?= $baseUrl ?>AuthController/register" class="login-register-link">¿No tienes una cuenta? Regístrate</a>
</div>
