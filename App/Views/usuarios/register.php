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


<style>
/* Contenedor principal del formulario de registro */
.register-form {
  margin: 30px auto; /* Centrado horizontal y margen superior */
  padding: 20px; /* Espaciado interno */
  width: 30%; /* Ancho completo */
  
}

/* Título del formulario */
.register-form h2 {
  font-size: 2em; /* Tamaño más grande para destacar el título */
  color: #333;
  margin-bottom: 25px; /* Espaciado inferior mayor */
  text-align: center;
  font-weight: bold;
}

/* Estilo de las etiquetas (labels) */
.register-form label {
  font-size: 1.2em; /* Tamaño de fuente ligeramente mayor */
  color: #555;
  display: block;
  margin-bottom: 8px; /* Espaciado más consistente */
}

/* Estilo de los campos de entrada (inputs) */
.register-form input {
  width: 100%; /* Ocupa el 100% del ancho del contenedor */
  padding: 15px; /* Aumenta el padding interno */
  margin-bottom: 20px; /* Espaciado inferior más amplio */
  border: 1px solid #ccc; /* Borde gris claro */
  border-radius: 6px; /* Bordes redondeados */
  font-size: 1.1em; /* Fuente más grande */
  box-sizing: border-box; /* Incluye el padding en el cálculo de ancho */
  background-color: #fff; /* Fondo blanco */
  transition: border-color 0.3s ease; /* Efecto suave al enfocar */
}

/* Estilo al enfocar un campo */
.register-form input:focus {
  border-color: #4CAF50; /* Resalta el borde en verde */
  outline: none;
}

/* Estilo para el botón de envío */
.register-form .submit-btn {
  width: 100%; /* Botón del mismo ancho que los campos */
  padding: 15px; /* Espaciado interno consistente */
  background-color: #4CAF50; /* Verde llamativo */
  color: white;
  font-size: 1.3em; /* Fuente más grande */
  font-weight: bold;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease; /* Animación de color y escala */
}

/* Efecto al pasar el mouse sobre el botón */
.register-form .submit-btn:hover {
  background-color: #45a049; /* Verde más oscuro */
  transform: scale(1.02); /* Ligero aumento de tamaño */
}

/* Estilo para el texto de enlace debajo del formulario */
.register-form .register-link {
  display: block;
  text-align: center;
  margin-top: 20px;
  font-size: 1.1em;
  color: #007bff;
  text-decoration: none;
}

/* Efecto hover en el enlace */
.register-form .register-link:hover {
  text-decoration: underline;
}

/* Estilo de los saltos de línea */
.register-form br {
  margin-bottom: 15px;
}


</style>