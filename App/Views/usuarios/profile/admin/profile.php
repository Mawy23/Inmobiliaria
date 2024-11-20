<div class="container">
    <h1>Bienvenido, Administrador <?= $nombre ?></h1>
    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab" aria-controls="usuarios" aria-selected="true">Usuarios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="propiedades-tab" data-toggle="tab" href="#propiedades" role="tab" aria-controls="propiedades" aria-selected="false">Propiedades</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="citas-tab" data-toggle="tab" href="#citas" role="tab" aria-controls="citas" aria-selected="false">Citas</a>
        </li>
    </ul>
    <div class="tab-content" id="profileTabsContent">
        <div class="tab-pane fade show active" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
            <h2>Modificar Usuarios</h2>
            <!-- Formulario para modificar usuarios -->
        </div>
        <div class="tab-pane fade" id="propiedades" role="tabpanel" aria-labelledby="propiedades-tab">
            <h2>Añadir y Modificar Propiedades</h2>
            <!-- Formulario para añadir y modificar propiedades -->
        </div>
        <div class="tab-pane fade" id="citas" role="tabpanel" aria-labelledby="citas-tab">
            <h2>Ver Todas las Citas</h2>
            <!-- Listar todas las citas -->
        </div>
    </div>
</div>
