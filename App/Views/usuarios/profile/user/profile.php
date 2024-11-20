<div class="container">
    <h1>Bienvenido, Usuario <?= $nombre ?></h1>
    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="resumen-tab" data-toggle="tab" href="#resumen" role="tab" aria-controls="resumen" aria-selected="true">Resumen</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="citas-tab" data-toggle="tab" href="#citas" role="tab" aria-controls="citas" aria-selected="false">Citas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="propiedades-tab" data-toggle="tab" href="#propiedades" role="tab" aria-controls="propiedades" aria-selected="false">Propiedades</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="wishlist-tab" data-toggle="tab" href="#wishlist" role="tab" aria-controls="wishlist" aria-selected="false">Wishlist</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="perfil-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="perfil" aria-selected="false">Modificar Perfil</a>
        </li>
    </ul>
    <div class="tab-content" id="profileTabsContent">
        <div class="tab-pane fade show active" id="resumen" role="tabpanel" aria-labelledby="resumen-tab">
            <h2>Resumen</h2>
            <!-- Contenido del resumen -->
        </div>
        <div class="tab-pane fade" id="citas" role="tabpanel" aria-labelledby="citas-tab">
            <h2>Calendario de Citas</h2>
            <ul>
                <!-- Listar citas del usuario -->
            </ul>
        </div>
        <div class="tab-pane fade" id="propiedades" role="tabpanel" aria-labelledby="propiedades-tab">
            <h2>Tus Propiedades</h2>
            <ul>
                <!-- Listar propiedades del usuario -->
            </ul>
        </div>
        <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
            <h2>Tu Wishlist</h2>
            <ul>
                <!-- Listar wishlist del usuario -->
            </ul>
        </div>
        <div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
            <h2>Modificar Información Personal</h2>
            <!-- Formulario para modificar información personal -->
        </div>
    </div>
</div>
