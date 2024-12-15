<div class="login-container">
    <h2 class="login-title">Iniciar Sesión</h2>
    <form class="login-form" action="authenticate" method="POST">
        <label for="correo_electronico" class="login-label">Correo</label>
        <input type="email" id="correo_electronico" name="correo_electronico" class="login-input" required>
        
        <label for="contraseña" class="login-label">Contraseña</label>
        <input type="password" id="contraseña" name="contraseña" class="login-input" required>
        
        <button type="submit" class="login-button">Iniciar Sesión</button>
    </form>
    <a href="<?= $baseUrl ?>AuthController/register" class="login-register-link">¿No tienes una cuenta? Regístrate</a>
</div>


<style>

.login-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    gap: 20px;
    padding: 20px;
}

/* Título */
.login-title {
  font-size: 2em;
  margin-bottom: 20px;
  text-align: center;
  color: #333;
  font-weight: 600;
}

/* Estilo del formulario */
.login-form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

/* Estilo de los labels y inputs */
.login-label {
  font-size: 1.1em;
  color: #555;
}

.login-input {
  padding: 12px;
  font-size: 1em;
  border: 1px solid #ddd;
  border-radius: 8px;
  background-color: #fafafa;
  outline: none;
  transition: border 0.3s ease;
}

.login-input:focus {
  border: 1px solid #6dc066;
}

/* Botón de inicio de sesión */
.login-button {
  padding: 14px;
  font-size: 1.1em;
  background-color: #6dc066;
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.login-button:hover {
  background-color: #57a853;
}

/* Enlace de registro */
.login-register-link {
  display: block;
  margin-top: 15px;
  text-align: center;
  color: #007BFF;
  font-size: 1em;
  text-decoration: none;
}

.login-register-link:hover {
  text-decoration: underline;
}
</style>