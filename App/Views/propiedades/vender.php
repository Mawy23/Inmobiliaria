<div>
    <h1>Pide tu valoración gratuita</h1>
    <form method="POST" action="vender_inmueble.php">
        <input id="direccion" type="text" placeholder="Dirección" oninput="autocompleteDireccion()" />
        <ul id="sugerencias"></ul>
        <input type="text" name="nombre" placeholder="Nombre" required><br>
        <input type="text" name="apellido" placeholder="Apellido" required><br>
        <input type="email" name="email" placeholder="Correo Electrónico" required><br>
        <input type="tel" name="telefono" placeholder="Teléfono" required><br>

        <input type="submit" name="vender_inmueble" value="Enviar">
    </form>
</div>

<script>
    async function autocompleteDireccion() {
        const input = document.getElementById("direccion").value;
        if (input.length > 2) {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(input)}&format=json`);
            const data = await response.json();
            const sugerencias = document.getElementById("sugerencias");
            sugerencias.innerHTML = "";
            data.forEach(item => {
                const li = document.createElement("li");
                li.textContent = item.display_name;
                li.onclick = () => {
                    document.getElementById("direccion").value = item.display_name;
                    sugerencias.innerHTML = "";
                };
                sugerencias.appendChild(li);
            });
        }
    }
</script>