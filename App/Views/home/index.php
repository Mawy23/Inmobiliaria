<div class="container">
    <h2>Nuestras Propiedades</h2>
        
    <!-- Formulario de búsqueda -->
    <form class="search-form" method="GET" action="search_results.php">
        <input type="text" placeholder="Buscar por nombre..." aria-label="Buscar por nombre">
        
        <select aria-label="Tipo de propiedad">
            <option value="">Seleccione un tipo</option>
            <option value="casa">Casa</option>
            <option value="departamento">Departamento</option>
            <option value="villa">Villa</option>
        </select>
        
        <input type="number" placeholder="Precio mínimo" aria-label="Precio mínimo">
        <input type="number" placeholder="Precio máximo" aria-label="Precio máximo">
        
        <button type="submit">Buscar</button>
    </form>

    <div class="property-container">
        <div class="property">
            <img src="https://via.placehold er.com/600x400" alt="Propiedad 1">
            <h2>Casa en la Playa</h2>
            <p>Hermosa casa con vista al mar, ubicada en una zona tranquila.</p>
            <p>Precio: $500,000 USD</p>
        </div>


        <div class="property">
            <img src="https://via.placeholder.com/600x400" alt="Propiedad 2">
            <h2>Departamento en la Ciudad</h2>
            <p>Moderno departamento en el corazón de la ciudad, cerca de todos los servicios.</p>
            <p>Precio: $300,000 USD</p>
        </div>

        <div class="property">
            <img src="https://via.placeholder.com/600x400" alt="Propiedad 3">
            <h2>Villa en el Campo</h2>
            <p>Amplia villa con jardín y piscina, perfecta para disfrutar de la naturaleza.</p>
            <p>Precio: $750,000 USD</p>
        </div>
    </div>
</div>
