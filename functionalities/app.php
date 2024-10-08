<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);

    // Aquí podrías agregar la lógica para enviar el mensaje por email o guardarlo en una base de datos.
    echo "Gracias, $nombre. Hemos recibido tu mensaje: '$mensaje'. Nos pondremos en contacto contigo en $email.";
} else {
    echo "Por favor, envía el formulario correctamente.";
}
?>
