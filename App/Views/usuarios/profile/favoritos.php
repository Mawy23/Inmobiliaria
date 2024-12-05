<div class="tab-pane fade show active" id="favoritos" role="tabpanel" aria-labelledby="favoritos-tab">
    <h3>Mis Propiedades Favoritas</h3>
    <div class="row">
        <?php if (isset($favoritos) && is_array($favoritos)): ?>
            <?php foreach ($favoritos as $favorito): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($favorito->titulo) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($favorito->descripcion) ?></p>
                            <a href="<?= $baseUrl ?>PropiedadesController/view/<?= $favorito->id_propiedad ?>" class="btn btn-primary">Ver</a>
                            <form action="<?= $baseUrl ?>FavoritosController/remove" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $favorito->id_propiedad ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p>No tienes propiedades favoritas.</p>
            </div>
        <?php endif; ?>
    </div>
</div>