<?php
use Core\Session;

$session = Session::getInstance();
$idUsuario = $session->get('id_usuario');
$nombre = $session->get('nombre');
$rol = $session->get('rol');
?>

<head>
    <!-- Bootstrap core CSS -->
    <link href="<?= $baseUrl ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom styles for this template -->
    <link href="<?= $baseUrl ?>css/style.css" rel="stylesheet">
    <link href="<?= $baseUrl ?>css/btn-heart.css" rel="stylesheet">
</head>

<body class="header">
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="<?= $baseUrl ?>">
                <img src="<?= $baseUrl ?>img/logo.png" alt="Casa Nova" height="60">
            </a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto"> <!-- Espacio para otros elementos en la izquierda -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>Home">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>PropiedadController">Busca Tu Casa</a>
                    </li>
                    <?php if ($rol === 'cliente'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $baseUrl ?>PropiedadController/comparar">Compara</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>TasacionController/create">Vende tu Casa</a>
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
                            <a class="btn-header" href="<?= $baseUrl ?>AuthController/login">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn-header" href="<?= $baseUrl ?>AuthController/register">Registrarse</a>
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
