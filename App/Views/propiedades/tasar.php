<form action="<?= $baseUrl ?>TasacionController/store" method="POST">
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" required>
    </div>
    <div class="form-group">
        <label for="apellido">Apellido</label>
        <input type="text" class="form-control" id="apellido" name="apellido" required>
    </div>
    <div class="form-group">
        <label for="correo">Correo</label>
        <input type="email" class="form-control" id="correo" name="correo" required>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
