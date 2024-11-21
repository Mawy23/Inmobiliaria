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
            justify-content: space-between;
            /* Espacio entre los elementos del navbar */

        }

        .nav-item button {
            font-size: 0.85rem;
            /* Tamaño más pequeño para los botones */
            margin-left: 10px;
            /* Espacio entre botones */
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
                        <a class="nav-link" href="<?= $baseUrl ?>PropiedadController">Comprar casa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>Home/citas">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>test">Page Not Found</a>
                    </li>
                </ul>
                <ul class="navbar-nav"> <!-- Botones a la derecha -->
                    <?php if ($idUsuario) : ?>
                        <li class="nav-item">
                            <?php if ($rol == 'admin') : ?>
                                <a class="nav-link" href="<?= $baseUrl ?>Home/profile"><?= $nombre ?></a>
                            <?php elseif ($rol == 'agente') : ?>
                                <a class="nav-link" href="<?= $baseUrl ?>Home/profileAgent"><?= $nombre ?></a>
                            <?php else : ?>
                                <a class="nav-link" href="<?= $baseUrl ?>Home/profileUser"><?= $nombre ?></a>
                            <?php endif; ?>
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

</html>