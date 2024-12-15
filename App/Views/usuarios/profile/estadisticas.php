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

    <h3>Estadísticas de Búsqueda</h3>
    <canvas id="searchStatsChart" width="400" height="200"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('searchStatsChart').getContext('2d');
        const searchStatsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($searchStatsLabels) ?>,
                datasets: [{
                    label: 'Búsquedas por Tipo',
                    data: <?= json_encode($searchStatsData['tipo']) ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>
