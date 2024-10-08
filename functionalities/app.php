<?php

echo '<link rel="stylesheet" href="../styles/styles.css">';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asegúrate de recibir correctamente los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    if (!empty($nombre) && !empty($email) && !empty($mensaje)) {
        // Mensaje de confirmación
        echo "Gracias, $nombre. Hemos recibido tu mensaje: '$mensaje'. Nos pondremos en contacto contigo en $email.";
    } else {
        echo "Por favor, completa todos los campos.";
    }
} else {
    echo "No se envió el formulario correctamente.";
}
?>
