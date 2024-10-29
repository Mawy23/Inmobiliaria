<!doctype html>
<html lang="es" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title><?= $title ?? '' ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?= $baseUrl ?>css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .navbar {
            justify-content: space-between; /* Espacio entre los elementos del navbar */
        }

        .nav-item button {
            font-size: 0.85rem; /* Tamaño más pequeño para los botones */
            margin-left: 10px; /* Espacio entre botones */
        }

        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 30px; /* Aumentar el padding para un popup más grande */
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1050; /* Asegúrate de que el popup esté por encima */
            width: 400px; /* Ancho fijo para el popup */
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040; /* Asegúrate de que el overlay esté por debajo del popup */
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="<?= $baseUrl ?>css/style.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="<?= $baseUrl ?>">PHP MVC</a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto"> <!-- Espacio para otros elementos en la izquierda -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>Home/busquedaInmuebles">Busqueda Inmuebles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>Home/examplewithargs">Example With Args</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>test">Page Not Found</a>
                    </li>
                </ul>
                <ul class="navbar-nav"> <!-- Botones a la derecha -->
                    <li class="nav-item">
                        <button class="btn btn-primary" onclick="togglePopup('loginPopup')">Iniciar Sesión</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-secondary" onclick="togglePopup('registerPopup')">Registrar</button>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">

    <!-- Ventana emergente para Login -->
    <div id="loginPopup" class="popup">
        <h2>Iniciar Sesión</h2>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Usuario" required><br>
            <input type="password" name="password" placeholder="Contraseña" required><br>
            <input type="submit" name="login" value="Iniciar Sesión">
        </form>
        <button onclick="togglePopup('loginPopup')">Cerrar</button>
    </div>

    <!-- Ventana emergente para Registro -->
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
            if (popup.style.display === "block") {
                popup.style.display = "none";
                overlay.style.display = "none";
            } else {
                popup.style.display = "block";
                overlay.style.display = "block";
            }
        }

        function closeAllPopups() {
            document.getElementById('loginPopup').style.display = "none";
            document.getElementById('registerPopup').style.display = "none";
            document.getElementById('overlay').style.display = "none";
        }
    </script>
</body>
</html>
