<?php
use Core\Session;

$session = Session::getInstance();
$idUsuario = $session->get('id_usuario');
$nombre = $session->get('nombre');
$rol = $session->get('rol');
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title><?= $title ?? '' ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?= $baseUrl ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    

    <style>
        /* Estilos generales del navbar */
        .navbar {
            background: rgba(0, 0, 0, 0.8);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff;
        }

        .navbar-brand:hover {
            color: #f8f9fa;
        }

        /* Botón de hamburguesa más grande */
        .navbar-toggler {
            border: none;
            width: 60px; /* Anchura del botón */
            height: 60px; /* Altura del botón */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            padding: 0;
        }

        /* Ícono del botón de hamburguesa */
        .navbar-toggler-icon {
            width: 30px; /* Anchura de las líneas */
            height: 3px; /* Altura de las líneas */
            background-color: white;
            position: relative;
        }

        .navbar-toggler-icon::before,
        .navbar-toggler-icon::after {
            content: '';
            width: 30px;
            height: 3px;
            background-color: white;
            position: absolute;
            left: 0;
        }

        .navbar-toggler-icon::before {
            top: -8px; /* Separación de la línea superior */
        }

        .navbar-toggler-icon::after {
            top: 8px; /* Separación de la línea inferior */
        }

        /* Sin animaciones al expandir */
        .navbar-toggler.collapsed .navbar-toggler-icon::before,
        .navbar-toggler.collapsed .navbar-toggler-icon::after {
            transform: none;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="<?= $baseUrl ?>css/style.css" rel="stylesheet">
    <link href="<?= $baseUrl ?>css/btn-heart.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="<?= $baseUrl ?>">PHP MVC</a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto"> <!-- Espacio para otros elementos en la izquierda -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>PropiedadController">Lista de Propiedades</a>
                    </li>
                    <?php if ($rol === 'cliente'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $baseUrl ?>PropiedadController/comparar">Comparar Propiedades</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>TasacionController/create">Solicitar Tasación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>UsuariosController">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>test">Page Not Found</a>
                    </li>
                </ul>
                <ul class="navbar-nav"> <!-- Botones a la derecha -->
                    <?php if ($idUsuario) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $baseUrl ?>Home/profile"><?= $nombre ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $baseUrl ?>AuthController/logout">Cerrar Sesión</a>
                        </li>
                    <?php else : ?>

                        <li class="nav-item">
                            <a class="btn btn-primary" href="<?= $baseUrl ?>AuthController/login">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-secondary" href="<?= $baseUrl ?>AuthController/register">Registrarse</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>

    <script src="<?= $baseUrl ?>js/jquery.min.js"></script>
    <script src="<?= $baseUrl ?>js/bootstrap.bundle.min.js"></script>
</body>

</html>