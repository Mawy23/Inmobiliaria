<div class="tab-pane show active" id="estadisticas" role="tabpanel" aria-labelledby="estadisticas-tab">
    <h2>Estadísticas</h2>
    <h3>Usuarios Registrados</h3>
    <p>Total de usuarios: <?= isset($totalUsuarios) ? $totalUsuarios : 'N/A' ?></p>
    <p>Administradores: <?= isset($totalAdmins) ? $totalAdmins : 'N/A' ?></p>
    <p>Agentes: <?= isset($totalAgentes) ? $totalAgentes : 'N/A' ?></p>
    <p>Clientes: <?= isset($totalClientes) ? $totalClientes : 'N/A' ?></p>

    <h3>Propiedades</h3>
    <p>Total de propiedades: <?= isset($totalPropiedades) ? $totalPropiedades : 'N/A' ?></p>
    <p>Disponibles: <?= isset($propiedadesDisponibles) ? $propiedadesDisponibles : 'N/A' ?></p>
    <p>Vendidas: <?= isset($propiedadesVendidas) ? $propiedadesVendidas : 'N/A' ?></p>
    <p>Alquiladas: <?= isset($propiedadesAlquiladas) ? $propiedadesAlquiladas : 'N/A' ?></p>

    <h3>Citas</h3>
    <p>Total de citas: <?= isset($totalCitas) ? $totalCitas : 'N/A' ?></p>
    <p>Pendientes: <?= isset($citasPendientes) ? $citasPendientes : 'N/A' ?></p>
    <p>Confirmadas: <?= isset($citasConfirmadas) ? $citasConfirmadas : 'N/A' ?></p>
    <p>Canceladas: <?= isset($citasCanceladas) ? $citasCanceladas : 'N/A' ?></p>

</div>
