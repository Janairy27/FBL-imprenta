<?php


// Obtener parámetros de la URL
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : null;
$valor1 = isset($_GET['valor1']) ? $_GET['valor1'] : null;

// Verificar si se recibieron parámetros
if ($busqueda && $valor1) {
    include '../Controlador/controladorReporteInsumo.php';
    $controlador = new controladorReporteInsumo();
    $resultados = $controlador->reporteInsumo($busqueda, $valor1);

    // Encabezados para la descarga en Excel si hay resultados
    if (!empty($resultados)) {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename=ReporteInsumos.xls');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <h1>Reporte de insumos</h1>
    <table class="table table-striped table-dark">
        <thead>
            <tr class="table-light">
                <th>Valor</th>
                <th>Total de insumos</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($resultados) && !empty($resultados)): ?>
                <?php foreach ($resultados as $insumo): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($insumo['valor'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($insumo['cantinsumos'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="text-center">No se encontraron resultados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>