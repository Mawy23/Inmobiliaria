<?php
// Incluir encabezados HTML
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inmobiliaria ABC - Mensaje Enviado</title>
    <link rel="stylesheet" href="../styles/styles.css"> <!-- Ajusta la ruta al CSS -->
</head>
<body>
    <header>
        <h1>Inmobiliaria ABC</h1>
    </header>

    <section>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = htmlspecialchars($_POST['nombre']);
            $email = htmlspecialchars($_POST['email']);
            $mensaje = htmlspecialchars($_POST['mensaje']);

            if (!empty($nombre) && !empty($email) && !empty($mensaje)) {
                // Mensaje de confirmación
                echo "<p>Gracias, $nombre. Hemos recibido tu mensaje: '$mensaje'. Nos pondremos en contacto contigo en $email.</p>";
            } else {
                echo "<p>Por favor, completa todos los campos.</p>";
            }
        } else {
            echo "<p>No se envió el formulario correctamente.</p>";
        }
        ?>
    </section>

    <footer>
        <p>&copy; 2024 Inmobiliaria ABC. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
