<div class="tab-pane fade show active" id="historial" role="tabpanel" aria-labelledby="historial-tab">
    <h3>Historial de Citas</h3>
    <div class="row">
        <?php if (isset($historialCitas) && is_array($historialCitas)): ?>
            <?php foreach ($historialCitas as $cita): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Cita #<?= htmlspecialchars($cita->id_cita) ?></h5>
                            <p class="card-text"><strong>ID Propiedad:</strong> <?= htmlspecialchars($cita->id_propiedad) ?></p>
                            <p class="card-text"><strong>Fecha y Hora:</strong> <?= htmlspecialchars($cita->fecha_hora) ?></p>
                            <p class="card-text"><strong>Estado:</strong> <?= htmlspecialchars($cita->estado) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p>No tienes citas en tu historial.</p>
            </div>
        <?php endif; ?>
    </div>
</div>