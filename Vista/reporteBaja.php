<?php
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : null;
$valor1 = isset($_GET['valor1']) ? $_GET['valor1'] : null;
$valor2 = isset($_GET['valor2']) ? $_GET['valor2'] : null;

if ($busqueda && $valor1 && $valor2) {
    include '../Controlador/controladorReporteBaja.php';
    $controlador = new controladorReporteBaja();
    $resultados = $controlador->reporteBajaFecha($busqueda, $valor1, $valor2);
}
?>

<?php
header('Content-Type:application/xls');
header('Content-Disposition: attachment; filename=ReporteBaja.xls');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
</head>
<h1>Reporte de bajas</h1>
<table class="table table-striped table-dark">
    <thead>
        <tr class="table-light">
            <th>Motivo</th>
            <th>Fecha de baja</th>
            <th>Nombre del insumo</th>
            <th>Fecha de compra</th>
            <th>Nombre empleado</th>
            <th>Apellido paterno</th>
            <th>Correo electronico</th>

        </tr>
    </thead>
    <?php

    if (isset($resultados)):  ?>
        <?php foreach ($resultados as $baja): ?>
            <tr>
                <td><?php echo $baja['motivo']; ?></td>
                <td><?php echo $baja['fechaBaja']; ?></td>
                <td><?php echo $baja['insumo']; ?></td>
                <td><?php echo $baja['fecha']; ?></td>
                <td><?php echo $baja['nombre']; ?></td>
                <td><?php echo $baja['apaterno']; ?></td>
                <td><?php echo $baja['correo']; ?></td>
            </tr>
        <?php endforeach ?>
    <?php endif ?>
</table>

</html>