<div class="container">
    <h2>Buscar Propiedades</h2>

    <!-- Barra de Filtros -->
    <form class="search-form" action="/Inmobiliaria/Public/PropiedadController/" method="GET">
       <!-- <label for="tipo">Tipo de Propiedad:</label>-->
        <select name="tipo" id="tipo">
            <option value="">Todos</option>
            <option value="departamento" <?php echo isset($_GET['tipo']) && $_GET['tipo'] === 'departamento' ? 'selected' : ''; ?>>Departamento</option>
            <option value="casa" <?php echo isset($_GET['tipo']) && $_GET['tipo'] === 'casa' ? 'selected' : ''; ?>>Casa</option>
            <option value="terreno" <?php echo isset($_GET['tipo']) && $_GET['tipo'] === 'terreno' ? 'selected' : ''; ?>>Terreno</option>
            <option value="local" <?php echo isset($_GET['tipo']) && $_GET['tipo'] === 'local' ? 'selected' : ''; ?>>Local</option>
        </select>

       <!-- <label for="precio_min">Precio Mínimo:</label>-->
        <input type="number" name="precio_min" id="precio_min" placeholder="Precio mínimo" value="<?php echo isset($_GET['precio_min']) ? htmlspecialchars($_GET['precio_min']) : ''; ?>" />

       <!-- <label for="precio_max">Precio Máximo:</label>-->
        <input type="number" name="precio_max" id="precio_max" placeholder="Precio máximo" value="<?php echo isset($_GET['precio_max']) ? htmlspecialchars($_GET['precio_max']) : ''; ?>" />
        
       <!-- <label for="ciudad">Ciudad:</label>-->
        <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" value="<?php echo isset($_GET['ciudad']) ? htmlspecialchars($_GET['ciudad']) : ''; ?>" />

        <button type="submit">Filtrar</button>
    </form>
</div>