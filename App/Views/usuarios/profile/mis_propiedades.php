<div class="tab-pane fade show active" id="mis_propiedades" role="tabpanel" aria-labelledby="mis_propiedades-tab">
    <h3>Mis Propiedades</h3>
    <div class="row">
        <?php if (isset($misPropiedades) && is_array($misPropiedades)): ?>
            <?php foreach ($misPropiedades as $propiedad): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($propiedad->titulo) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($propiedad->descripcion) ?></p>
                            <p class="card-text"><strong>Precio:</strong> <?= number_format($propiedad->precio, 2) ?> €</p>
                            <p class="card-text"><strong>Tipo:</strong> <?= ucfirst(htmlspecialchars($propiedad->tipo)) ?></p>
                            <p class="card-text"><strong>Dirección:</strong> <?= htmlspecialchars($propiedad->direccion) ?></p>
                            <p class="card-text"><strong>Ciudad:</strong> <?= htmlspecialchars($propiedad->ciudad) ?></p>
                            <p class="card-text"><strong>Estado:</strong> <?= htmlspecialchars($propiedad->estado) ?></p>
                            <p class="card-text"><strong>Código Postal:</strong> <?= htmlspecialchars($propiedad->codigo_postal) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p>No tienes propiedades.</p>
            </div>
        <?php endif; ?>
    </div>
</div>