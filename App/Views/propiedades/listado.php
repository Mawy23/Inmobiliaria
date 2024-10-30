<?php if (!empty($propiedades)): ?>
    <h2>Lista de Propiedades</h2>
    <ul>
        <?php foreach ($propiedades as $propiedad): ?>
            <li>
                <h3><?php echo htmlspecialchars($propiedad->titulo); ?></h3>
                <p><?php echo htmlspecialchars($propiedad->descripcion); ?></p>
                <p>Precio: <?php echo htmlspecialchars($propiedad->precio); ?> €</p>
                <p>Tipo: <?php echo htmlspecialchars($propiedad->tipo); ?></p>
                <p>Dirección: <?php echo htmlspecialchars($propiedad->direccion); ?></p>
                <p>Ciudad: <?php echo htmlspecialchars($propiedad->ciudad); ?></p>
                <p>Estado: <?php echo htmlspecialchars($propiedad->estado); ?></p>
                <p>Código Postal: <?php echo htmlspecialchars($propiedad->codigo_postal); ?></p>
                <p>Agente ID: <?php echo htmlspecialchars($propiedad->id_agente); ?></p>
                <a href="/propiedades/<?php echo $propiedad->id_propiedad; ?>">Ver detalles</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No se encontraron propiedades.</p>
<?php endif; ?>
