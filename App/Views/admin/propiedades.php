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
        <?php foreach ($propiedades as $propiedad): ?>
            <tr>
                <td><?= $propiedad->id_propiedad ?></td>
                <td><?= $propiedad->titulo ?></td>
                <td><?= $propiedad->descripcion ?></td>
                <td><?= number_format($propiedad->precio, 2) ?> €</td>
                <td><?= ucfirst($propiedad->tipo) ?></td>
                <td><?= $propiedad->direccion ?></td>
                <td><?= $propiedad->ciudad ?></td>
                <td><?= $propiedad->estado ?></td>
                <td><?= $propiedad->codigo_postal ?></td>
                <td>
                    <!-- Botón para cargar datos de propiedad en el formulario de edición -->
                    <form action="<?= $baseUrl ?>propiedades/edit" method="GET" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $propiedad->id_propiedad ?>">
                        <button type="submit">Editar</button>
                    </form>

                    <!-- Botón para eliminar propiedad -->
                    <form action="<?= $baseUrl ?>propiedades/delete" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $propiedad->id_propiedad ?>">
                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta propiedad?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Formulario para editar una propiedad existente (solo se muestra si se cargó una propiedad para editar) -->
    <?php if (isset($propiedadToEdit)): ?>
        <h3>Editar Propiedad</h3>
        <form action="<?= $baseUrl ?>propiedades/update" method="POST">
            <input type="hidden" name="id" value="<?= $propiedadToEdit->id_propiedad ?>">

            <label for="edit_titulo">Título</label>
            <input type="text" id="edit_titulo" name="titulo" value="<?= $propiedadToEdit->titulo ?>" required>

            <label for="edit_descripcion">Descripción</label>
            <textarea id="edit_descripcion" name="descripcion" required><?= $propiedadToEdit->descripcion ?></textarea>

            <label for="edit_precio">Precio</label>
            <input type="number" id="edit_precio" name="precio" value="<?= $propiedadToEdit->precio ?>" step="0.01" required>

            <label for="edit_tipo">Tipo</label>
            <select id="edit_tipo" name="tipo" required>
                <option value="casa" <?= $propiedadToEdit->tipo == 'casa' ? 'selected' : '' ?>>Casa</option>
                <option value="departamento" <?= $propiedadToEdit->tipo == 'departamento' ? 'selected' : '' ?>>Departamento</option>
                <option value="terreno" <?= $propiedadToEdit->tipo == 'terreno' ? 'selected' : '' ?>>Terreno</option>
            </select>

            <label for="edit_direccion">Dirección</label>
            <input type="text" id="edit_direccion" name="direccion" value="<?= $propiedadToEdit->direccion ?>" required>

            <label for="edit_ciudad">Ciudad</label>
            <input type="text" id="edit_ciudad" name="ciudad" value="<?= $propiedadToEdit->ciudad ?>" required>

            <label for="edit_estado">Estado</label>
            <input type="text" id="edit_estado" name="estado" value="<?= $propiedadToEdit->estado ?>" required>

            <label for="edit_codigo_postal">Código Postal</label>
            <input type="text" id="edit_codigo_postal" name="codigo_postal" value="<?= $propiedadToEdit->codigo_postal ?>" required>

            <label for="edit_id_agente">ID Agente</label>
            <input type="number" id="edit_id_agente" name="id_agente" value="<?= $propiedadToEdit->id_agente ?>" required>

            <button type="submit">Actualizar Propiedad</button>
        </form>
    <?php endif; ?>
</div>
