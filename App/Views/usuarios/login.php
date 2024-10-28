<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
<body>

<button onclick="togglePopup('loginPopup')">Iniciar Sesión</button>

<div id="loginPopup" class="popup">
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Usuario" required><br>
        <input type="password" name="password" placeholder="Contraseña" required><br>
        <input type="submit" name="login" value="Iniciar Sesión">
    </form>
    <button onclick="togglePopup('loginPopup')">Cerrar</button>
</div>

<div id="overlay" class="overlay" onclick="closeAllPopups()"></div>

<script>
    function togglePopup(popupId) {
        var popup = document.g
