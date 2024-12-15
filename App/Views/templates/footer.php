</main>

<footer class="footer mt-auto">
    <div class="container">
        <div class="footer-content">
            <!-- Sección: Quiénes somos -->
            <div>
                <h5>Quiénes somos</h5>
                <p>Somos una empresa dedicada a ofrecer las mejores propiedades para ti. Nuestra misión es ayudarte a encontrar tu hogar ideal.</p>
            </div>

            <!-- Sección: Contacto -->
            <div>
                <h5>Contacto</h5>
                <ul>
                    <li><i class="fas fa-envelope"></i> <a href="mailto:contacto@ejemplo.com">contacto@ejemplo.com</a></li>
                    <li><i class="fas fa-phone"></i> +34 123 456 789</li>
                    <li><i class="fas fa-map-marker-alt"></i> Calle Ficticia, 123, Ciudad</li>
                </ul>
            </div>

            <!-- Sección: Enlaces útiles -->
            <div>
                <h5>Enlaces útiles</h5>
                <ul>
                    <li><a href="<?= $baseUrl ?>Home">Inicio</a></li>
                    <li><a href="<?= $baseUrl ?>PropiedadController">Propiedades</a></li>
                    <li><a href="<?= $baseUrl ?>UsuariosController">Usuarios</a></li>
                    <li><a href="<?= $baseUrl ?>AuthController/register">Registrarse</a></li>
                </ul>
            </div>
        </div>

        <!-- Nota final -->
        <div class="text-center">
            <span>&copy; <?= date('Y') ?> PHP MVC. Todos los derechos reservados.</span>
        </div>
    </div>
</footer>


<script src="<?= $baseUrl ?>js/jquery-3.5.1.slim.min.js"></script>
<script src="<?= $baseUrl ?>js/bootstrap.bundle.min.js"></script>

</body>
</html>
