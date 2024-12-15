<div class="container">
    <h2>Buscar Propiedades</h2>

    <form class="search-form" action="/Inmobiliaria/Public/PropiedadController/" method="GET">
        <!-- Tipo de Propiedad -->
        <select name="tipo" id="tipo">
            <option value="">Todos</option>
            <option value="departamento">Departamento</option>
            <option value="casa">Casa</option>
            <option value="terreno">Terreno</option>
            <option value="local">Local</option>
        </select>

        <!-- Precio mínimo -->
        <input type="number" name="precio_min" id="precio_min" placeholder="Precio mínimo" />

        <!-- Precio máximo -->
        <input type="number" name="precio_max" id="precio_max" placeholder="Precio máximo" />

        <!-- Ciudad -->
        <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" />

        <!-- Botón de filtrar -->
        <button type="submit">Filtrar</button>
    </form>
</div>