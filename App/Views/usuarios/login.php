<div>
    <h2>Iniciar Sesión</h2>
    <form action="authenticate" method="POST">
        <label for="correo_electronico">Correo</label>
        <input type="email" id="correo_electronico" name="correo_electronico" required>
        <label for="contraseña">Contraseña</label>
        <input type="password" id="contraseña" name="contraseña" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
    <a href="<?= $baseUrl ?>AuthController/register">¿No tienes una cuenta? Regístrate</a>
</div>