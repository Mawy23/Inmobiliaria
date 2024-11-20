<div class="container">
    <h1>Bienvenido, Agente <?= $nombre ?></h1>
    <?php if (\Core\Session::isAdmin()): ?>
        <a href="<?= $baseUrl ?>Home/profile">Volver al Panel de Administración</a>
    <?php endif; ?>
    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="citas-tab" data-toggle="tab" href="#citas" role="tab" aria-controls="citas" aria-selected="true">Citas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="propiedades-tab" data-toggle="tab" href="#propiedades" role="tab" aria-controls="propiedades" aria-selected="false">Propiedades</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="peticiones-tab" data-toggle="tab" href="#peticiones" role="tab" aria-controls="peticiones" aria-selected="false">Peticiones de Venta</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="clientes-tab" data-toggle="tab" href="#clientes" role="tab" aria-controls="clientes" aria-selected="false">Clientes</a>
        </li>
    </ul>
    <div class="tab-content" id="profileTabsContent">
        <div class="tab-pane fade show active" id="citas" role="tabpanel" aria-labelledby="citas-tab">
            <h2>Calendario de Citas</h2>
            <ul>
                <!-- Listar citas del agente -->
            </ul>
            <h2>Añadir Citas</h2>
            <!-- Formulario para añadir citas -->
        </div>
        <div class="tab-pane fade" id="propiedades" role="tabpanel" aria-labelledby="propiedades-tab">
            <h2>Tus Propiedades</h2>
            <ul>
                <!-- Listar propiedades del agente -->
            </ul>
        </div>
        <div class="tab-pane fade" id="peticiones" role="tabpanel" aria-labelledby="peticiones-tab">
            <h2>Peticiones de Venta</h2>
            <ul>
                <!-- Listar peticiones de venta -->
            </ul>
        </div>
        <div class="tab-pane fade" id="clientes" role="tabpanel" aria-labelledby="clientes-tab">
            <h2>Tus Clientes</h2>
            <ul>
                <!-- Listar clientes del agente -->
            </ul>
            <h2>Modificar Clientes</h2>
            <!-- Formulario para modificar clientes -->
        </div>
    </div>
</div>
