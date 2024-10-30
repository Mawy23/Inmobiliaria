<!--
 *
 * Este archivo es responsable de gestionar las propiedades en el panel de administración.
 * Incluye las siguientes funcionalidades:
 *
 * 1. Formulario para crear una nueva propiedad.
 * 2. Mostrar una lista de propiedades con opciones para editar y eliminar cada propiedad.
 * 3. Formulario para editar una propiedad existente (solo se muestra si una propiedad está cargada para edición).
 *
 * El formulario para crear una nueva propiedad incluye campos para:
 * - Título
 * - Descripción
 * - Precio
 * - Tipo (Casa, Apartamento, Terreno)
 * - Dirección
 * - Ciudad
 * - Estado
 * - Código Postal
 * - ID del Agente
 *
 * La lista de propiedades muestra los siguientes detalles:
 * - ID
 * - Título
 * - Descripción
 * - Precio
 * - Tipo
 * - Dirección
 * - Ciudad
 * - Estado
 * - Código Postal
 * - Acciones (Editar, Eliminar)
 *
 * El formulario para editar una propiedad existente incluye los mismos campos que el formulario de creación,
 * pre-rellenados con los detalles actuales de la propiedad.
 -->
<?php
// Asegurarse de que $propiedades esté definido y sea un array
$propiedades = isset($propiedades) && is_array($propiedades) ? $propiedades : [];
?>

<div>
    <h2>Gestión de Propiedades</h2>

    <!-- Formulario para crear una nueva propiedad -->
    <h3>Agregar Nueva Propiedad</h3>
    <form action="<?= $baseUrl ?>PropiedadController/store" method="POST">
        <label for="titulo">Título</label>
        <input type="text" id="titulo" name="titulo" required>

        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" required></textarea>

        <label for="precio">Precio</label>
        <input type="number" id="precio" name="precio" step="0.01" required>

        <label for="tipo">Tipo</label>
        <select id="tipo" name="tipo" required>
            <option value="casa">Casa</option>
            <option value="departamento">Departamento</option>
            <option value="terreno">Terreno</option>
        </select>

        <label for="direccion">Dirección</label>
        <input type="text" id="direccion" name="direccion" required>

        <label for="ciudad">Ciudad</label>
        <input type="text" id="ciudad" name="ciudad" required>

        <label for="estado">Estado</label>
        <input type="text" id="estado" name="estado" required>

        <label for="codigo_postal">Código Postal</label>
        <input type="text" id="codigo_postal" name="codigo_postal" required>

        <label for="id_agente">ID Agente</label>
        <input type="number" id="id_agente" name="id_agente">

        <button type="submit">Crear Propiedad</button>
    </form>

    <!-- Mostrar la lista de propiedades con opciones de edición y eliminación -->
    <h3>Lista de Propiedades</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Tipo</th>
            <th>Dirección</th>
            <th>Ciudad</th>
            <th>Estado</th>
            <th>Código Postal</th>
            <th>Acciones</th>
        </tr>
        <?php if (!empty($propiedades)): ?>
            <?php foreach ($propiedades as $propiedad): ?>
                <tr>
                    <td><?= htmlspecialchars($propiedad->id_propiedad) ?></td>
                    <td><?= htmlspecialchars($propiedad->titulo) ?></td>
                    <td><?= htmlspecialchars($propiedad->descripcion) ?></td>
                    <td><?= number_format($propiedad->precio, 2) ?> €</td>
                    <td><?= ucfirst(htmlspecialchars($propiedad->tipo)) ?></td>
                    <td><?= htmlspecialchars($propiedad->direccion) ?></td>
                    <td><?= htmlspecialchars($propiedad->ciudad) ?></td>
                    <td><?= htmlspecialchars($propiedad->estado) ?></td>
                    <td><?= htmlspecialchars($propiedad->codigo_postal) ?></td>
                    <td>
                        <form action="<?= $baseUrl ?>propiedades/edit" method="GET" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($propiedad->id_propiedad) ?>">
                            <button type="submit">Editar</button>
                        </form>

                        <form action="<?= $baseUrl ?>propiedades/delete" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($propiedad->id_propiedad) ?>">
                            <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta propiedad?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">No hay propiedades disponibles en este momento.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>