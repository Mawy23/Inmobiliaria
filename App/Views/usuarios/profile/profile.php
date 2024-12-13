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
        <?php endif; ?>
        <?php if ($rol === 'cliente'): ?>
            <li class="nav-item">
                <a class="nav-link <?= $active_tab === 'favoritos' ? 'active' : '' ?>" id="favoritos-tab" data-toggle="tab" href="#favoritos" role="tab" aria-controls="favoritos" aria-selected="<?= $active_tab === 'favoritos' ? 'true' : 'false' ?>">Favoritos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $active_tab === 'historial' ? 'active' : '' ?>" id="historial-tab" data-toggle="tab" href="#historial" role="tab" aria-controls="historial" aria-selected="<?= $active_tab === 'historial' ? 'true' : 'false' ?>">Historial de Citas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $active_tab === 'mis_propiedades' ? 'active' : '' ?>" id="mis_propiedades-tab" data-toggle="tab" href="#mis_propiedades" role="tab" aria-controls="mis_propiedades" aria-selected="<?= $active_tab === 'mis_propiedades' ? 'true' : 'false' ?>">Mis Propiedades</a>
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
        <?php endif; ?>
        <?php if ($rol === 'cliente'): ?>
            <div class="tab-pane fade <?= $active_tab === 'favoritos' ? 'show active' : '' ?>" id="favoritos" role="tabpanel" aria-labelledby="favoritos-tab">
                <?php include 'favoritos.php'; ?>
            </div>
            <div class="tab-pane fade <?= $active_tab === 'historial' ? 'show active' : '' ?>" id="historial" role="tabpanel" aria-labelledby="historial-tab">
                <?php include 'historial.php'; ?>
            </div>
            <div class="tab-pane fade <?= $active_tab === 'mis_propiedades' ? 'show active' : '' ?>" id="mis_propiedades" role="tabpanel" aria-labelledby="mis_propiedades-tab">
                <?php include 'mis_propiedades.php'; ?>
            </div>
        <?php endif; ?>
        <div class="tab-pane fade <?= $active_tab === 'citas' ? 'show active' : '' ?>" id="citas" role="tabpanel" aria-labelledby="citas-tab">
            <?php include 'citas.php'; ?>
        </div>
    </div>
</div>