<div class="container">
    <h1>¡Hola, <?= $nombre ?>!</h1>
    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
        <?php if ($rol === 'admin' || $rol === 'agente'): ?>
            <li class="nav-item">
                <a class="nav-link <?= $active_tab === 'usuarios' ? 'active' : '' ?>" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="<?= $active_tab === 'usuarios' ? 'true' : 'false' ?>">Usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $active_tab === 'propiedades' ? 'active' : '' ?>" id="propiedades-tab" data-toggle="tab" href="#propiedades" role="tab" aria-controls="propiedades" aria-selected="<?= $active_tab === 'propiedades' ? 'true' : 'false' ?>">Propiedades</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $active_tab === 'tasaciones' ? 'active' : '' ?>" id="tasaciones-tab" data-toggle="tab" href="#tasaciones" role="tab" aria-controls="tasaciones" aria-selected="<?= $active_tab === 'tasaciones' ? 'true' : 'false' ?>">Tasaciones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $active_tab === 'estadisticas' ? 'active' : '' ?>" id="estadisticas-tab" data-toggle="tab" href="#estadisticas" role="tab" aria-controls="estadisticas" aria-selected="<?= $active_tab === 'estadisticas' ? 'true' : 'false' ?>">Estadísticas</a>
            </li>
        <?php endif; ?>
        <?php if ($rol === 'cliente'): ?>
            <li class="nav-item">
                <a class="nav-link <?= $active_tab === 'favoritos' ? 'active' : '' ?>" id="favoritos-tab" data-toggle="tab" href="#favoritos" role="tab" aria-controls="favoritos" aria-selected="<?= $active_tab === 'favoritos' ? 'true' : 'false' ?>">Favoritos</a>
            </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="nav-link <?= $active_tab === 'citas' ? 'active' : '' ?>" id="citas-tab" data-toggle="tab" href="#citas" role="tab" aria-controls="citas" aria-selected="<?= $active_tab === 'citas' ? 'true' : 'false' ?>">Citas</a>
        </li>
    </ul>
    <!-- Contenido de las pestañas -->
    <div class="tab-content" id="profileTabsContent">
        <?php if ($rol === 'admin' || $rol === 'agente'): ?>
            <div class="tab-pane fade <?= $active_tab === 'usuarios' ? 'show active' : '' ?>" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
                <?php include 'usuarios.php'; ?>
            </div>
            <div class="tab-pane fade <?= $active_tab === 'propiedades' ? 'show active' : '' ?>" id="propiedades" role="tabpanel" aria-labelledby="propiedades-tab">
                <?php include 'propiedades.php'; ?>
            </div>
            <div class="tab-pane fade <?= $active_tab === 'tasaciones' ? 'show active' : '' ?>" id="tasaciones" role="tabpanel" aria-labelledby="tasaciones-tab">
                <?php include 'tasaciones.php'; ?>
            </div>
            <div class="tab-pane fade <?= $active_tab === 'estadisticas' ? 'show active' : '' ?>" id="estadisticas" role="tabpanel" aria-labelledby="estadisticas-tab">
                <?php include 'estadisticas.php'; ?>
            </div>
        <?php endif; ?>
        <?php if ($rol === 'cliente'): ?>
            <div class="tab-pane fade <?= $active_tab === 'favoritos' ? 'show active' : '' ?>" id="favoritos" role="tabpanel" aria-labelledby="favoritos-tab">
                <?php include 'favoritos.php'; ?>
            </div>
        <?php endif; ?>
        <div class="tab-pane fade <?= $active_tab === 'citas' ? 'show active' : '' ?>" id="citas" role="tabpanel" aria-labelledby="citas-tab">
            <?php include 'citas.php'; ?>
        </div>
    </div>
</div>