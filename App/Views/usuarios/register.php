<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
</head>
<body>
<body>

<button onclick="togglePopup('registerPopup')">Registrar</button>

<div id="registerPopup" class="popup">
    <h2>Registrar</h2>
    <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="Usuario" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <input type="submit" name="register" value="Registrar">
    </form>
    <button onclick="togglePopup('registerPopup')">Cerrar</button>
</div>

<div id="overlay" class="overlay" onclick="closeAllPopups()"></div>

<script>
    function togglePopup(popupId) {
        var popup = document.getElementById(popupId);
        var overlay = document.getElementById('overlay');
        popup.style.display = (popup.style.display === "block") ? "none" : "block";
        overlay.style.display = (overlay.style.display === "block") ? "none" : "block";
    }

    function closeAllPopups() {
        document.getElementById('registerPopup').style.display = "none";
        document.getElementById('overlay').style.display = "none";
    }
</script>

</body>
</html>
