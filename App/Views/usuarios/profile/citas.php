<div class="tab-pane show active" id="citas" role="tabpanel" aria-labelledby="citas-tab">
    <h2>Ver Todas las Citas</h2>
    <!-- Calendario interactivo -->
    <h3>Calendario de Citas</h3>
    <div id="calendar"></div>
    <!-- Mostrar la lista de citas con opciones de edición y eliminación -->
    <h3>Lista de Citas</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>ID Propiedad</th>
            <th>Cliente</th>
            <th>ID Agente</th>
            <th>Fecha y Hora</th>
            <th>Estado</th>
            <th>Disponible</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($citas as $cita): ?>
            <?php if ($rol === 'admin' || $rol === 'agente' || $cita->id_cliente == $session->get('id_usuario')): ?>
                <tr>
                    <td><?= $cita->id_cita ?></td>
                    <td><?= $cita->id_propiedad ?></td>
                    <td>
                        <?php if (isset($usuarios[$cita->id_cliente])): ?>
                            <?= $usuarios[$cita->id_cliente]->nombre . ' ' . $usuarios[$cita->id_cliente]->apellido ?>
                        <?php else: ?>
                            <?= $cita->id_cliente ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $cita->id_agente ?></td>
                    <td><?= $cita->fecha_hora ?></td>
                    <td><?= $cita->estado ?></td>
                    <td><?= $cita->disponible ? 'Sí' : 'No' ?></td>
                    <td>
                        <?php if ($rol === 'admin'): ?>
                            <form action="<?= $baseUrl ?>CitaController/edit/<?= $cita->id_cita ?>" method="POST" style="display:inline;">
                                <input type="hidden" name="active_tab" value="citas">
                                <button type="submit">Editar</button>
                            </form>
                            <form action="<?= $baseUrl ?>CitaController/delete" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $cita->id_cita ?>">
                                <input type="hidden" name="active_tab" value="citas">
                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta cita?')">Eliminar</button>
                            </form>
                        <?php endif; ?>
                        <?php if ($rol === 'cliente' && strtotime($cita->fecha_hora) > time()): ?>
                            <form action="<?= $baseUrl ?>CitaController/cancel" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $cita->id_cita ?>">
                                <input type="hidden" name="active_tab" value="citas">
                                <button type="submit" onclick="return confirm('¿Estás seguro de que deseas cancelar esta cita?')">Cancelar</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    </table>
    <!-- Formulario para editar una cita existente -->
    <?php if (isset($citaToEdit) && $rol === 'admin'): ?>
        <h3>Editar Cita</h3>
        <form action="<?= $baseUrl ?>CitaController/update" method="POST">
            <input type="hidden" name="active_tab" value="citas">
            <input type="hidden" name="id" value="<?= $citaToEdit->id_cita ?>">
            <label for="edit_id_propiedad">ID Propiedad</label>
            <input type="number" id="edit_id_propiedad" name="id_propiedad" value="<?= $citaToEdit->id_propiedad ?>" readonly>
            <label for="edit_fecha_hora">Fecha y Hora</label>
            <input type="datetime-local" id="edit_fecha_hora" name="fecha_hora" value="<?= $citaToEdit->fecha_hora ?>" required>
            <label for="edit_estado">Estado</label>
            <select id="edit_estado" name="estado">
                <option value="pendiente" <?= $citaToEdit->estado == 'pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="confirmado" <?= $citaToEdit->estado == 'confirmado' ? 'selected' : '' ?>>Confirmado</option>
                <option value="cancelado" <?= $citaToEdit->estado == 'cancelado' ? 'selected' : '' ?>>Cancelado</option>
            </select>
            <label for="edit_disponible">Disponible</label>
            <select id="edit_disponible" name="disponible">
                <option value="1" <?= $citaToEdit->disponible ? 'selected' : '' ?>>Sí</option>
                <option value="0" <?= !$citaToEdit->disponible ? 'selected' : '' ?>>No</option>
            </select>
            <button type="submit">Actualizar Cita</button>
        </form>
    <?php endif; ?>
    <?php if ($rol === 'cliente'): ?>
        <h3>Historial de Citas</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>ID Propiedad</th>
                <th>Fecha y Hora</th>
                <th>Estado</th>
            </tr>
            <?php if (isset($historialCitas) && is_array($historialCitas)): ?>
                <?php foreach ($historialCitas as $cita): ?>
                    <tr>
                        <td><?= $cita->id_cita ?></td>
                        <td><?= $cita->id_propiedad ?></td>
                        <td><?= $cita->fecha_hora ?></td>
                        <td><?= $cita->estado ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No hay citas en el historial.</td>
                </tr>
            <?php endif; ?>
        </table>
    <?php endif; ?>

    <?php if ($rol === 'admin' || $rol === 'agente'): ?>
        <h3>Agregar Horas Disponibles para Visitas</h3>
        <form action="<?= $baseUrl ?>CitaController/addAvailableHours" method="POST">
            <input type="hidden" name="active_tab" value="citas">
            <label for="id_propiedad">Propiedad</label>
            <select id="id_propiedad" name="id_propiedad" required>
                <option value="">Seleccionar Propiedad</option>
                <?php foreach ($propiedades as $propiedad): ?>
                    <option value="<?= $propiedad->id_propiedad ?>"><?= $propiedad->titulo ?></option>
                <?php endforeach; ?>
            </select>
            <label for="fecha_hora">Fecha y Hora</label>
            <input type="datetime-local" id="fecha_hora" name="fecha_hora" required>
            <label for="id_agente">Agente</label>
            <select id="id_agente" name="id_agente" required>
                <option value="">Seleccionar Agente</option>
                <?php foreach ($agentes as $agente): ?>
                    <option value="<?= $agente->id_usuario ?>"><?= $agente->nombre . ' ' . $agente->apellido ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Agregar Hora Disponible</button>
        </form>
    <?php endif; ?>
</div>
</div>


<style>
/* Contenedor principal */
.tab-pane {
    padding: 25px;
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    border-radius: 8px;
}

/* Títulos */
.tab-pane h2, .tab-pane h3 {
    font-size: 1.8rem;
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 20px;
}

/* Calendario */
#calendar {
    margin-bottom: 40px;
}

/* Tablas */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 40px;
}

table th, table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #e0e0e0;
    font-size: 1rem;
}

table th {
    background-color: #3498db;
    color: white;
    font-weight: bold;
}

table tr:nth-child(even) {
    background-color: #f5f5f5;
}

table td {
    color: #7f8c8d;
}

table td button {
    padding: 6px 14px;
    background-color: #3498db;
    border: none;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
}

table td button:hover {
    background-color: #2980b9;
}

table td button:focus {
    outline: none;
}

/* Estilo para los formularios */
form {
    margin-bottom: 40px;
}

form label {
    display: block;
    margin-bottom: 10px;
    font-size: 1rem;
    font-weight: bold;
    color: #2c3e50;
}

form input, form select, form button, form textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 1rem;
}

form input:focus, form select:focus, form button:focus, form textarea:focus {
    border-color: #3498db;
    outline: none;
}

/* Botones en formularios */
form button {
    background-color: #3498db;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
}

form button:hover {
    background-color: #2980b9;
}

/* Deshabilitar botón */
form button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

/* Estilo de las filas de la tabla */
table tr:hover {
    background-color: #e9f0f7;
}

table tr:last-child td {
    border-bottom: none;
}

/* Alineación de botones dentro de las tablas */
button[type="submit"] {
    margin-right: 10px;
}

/* Estilo para las opciones de estado */
select {
    width: 50%;
    padding: 10px;
    font-size: 1rem;
}

/* Estilo para los mensajes cuando no hay datos */
td[colspan="4"] {
    text-align: center;
    font-weight: bold;
    color: #7f8c8d;
}

/* Estilo del formulario de agregar horas disponibles */
form input[type="datetime-local"] {
    width: auto;
    display: inline-block;
}

form select {
    width: auto;
    display: inline-block;
    margin-right: 10px;
}

form input, form select, form button {
    width: 100%;
}

/* Estilo para dispositivos móviles */
@media (max-width: 768px) {
    .table-wrapper {
        overflow-x: auto; /* Habilitar el desplazamiento horizontal */
        -webkit-overflow-scrolling: touch; /* Mejora el desplazamiento en dispositivos táctiles */
        margin-bottom: 15px; /* Agregar algo de espacio debajo del contenedor */
    }

    table {
        width: 100%; /* Asegura que la tabla ocupe todo el ancho disponible */
        font-size: 0.9rem;
        overflow-x: auto; /* Asegura que el contenido de la tabla se pueda desplazar horizontalmente */
        display: block; /* Para permitir el desplazamiento */
    }

    table th, table td {
        white-space: nowrap; /* Evitar que el texto se divida en varias líneas */
        padding: 8px; /* Espaciado en celdas */
    }

    table th {
        font-size: 0.9rem;
    }

    table td {
        font-size: 0.9rem;
        word-wrap: break-word; /* Romper palabras largas */
        white-space: normal; /* Permitir que el texto se ajuste al ancho de la celda */
    }

    /* Estilo para los formularios de acciones (botones) */
    table form {
        display: inline-block; /* Asegura que los formularios se alineen en línea */
        width: auto; /* No forzar el ancho */
        margin: 5px 0; /* Espacio entre los formularios */
    }

    /* Ajustar el tamaño de los botones */
    table button {
        font-size: 0.8rem; /* Reducir el tamaño de los botones en dispositivos pequeños */
        padding: 8px 12px; /* Espaciado más pequeño */
        margin: 2px; /* Reducir el margen entre botones */
        width: 100%; /* Hacer que los botones se ajusten al ancho disponible */
        box-sizing: border-box; /* Asegurarse de que el padding y los márgenes no desborden */
    }

    form input, form select, form button {
        width: 100%; /* Asegura que los formularios sean más amigables en pantallas pequeñas */
    }
}
</style>
