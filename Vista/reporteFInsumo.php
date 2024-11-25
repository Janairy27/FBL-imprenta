<?php
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : null;
$valor1 = isset($_GET['valor1']) ? $_GET['valor1'] : null;
$valor2 = isset($_GET['valor2']) ? $_GET['valor2'] : null;

if ($busqueda && $valor1 && $valor2) {
    include '../Controlador/controladorReporteFechaInsumo.php';
    $controlador = new controladorReporteFechaInsumo();
    $resultados = $controlador->reporteFechaInsumo($busqueda, $valor1, $valor2);
}
?>
<?php
header('Content-Type: application/vnd.ms-excel; charset=iso-8859-1');
header('Content-Disposition: attachment; filename=proveedores.xls');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
</head>

<h1>Reporte para los insumo dañados </h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>Proveedor</td>
            <td>Contacto</td>
            <td>Correo</td>
            <td>Insumo</td>
            <td>Baja</td>
            <td>Total de insumos</td>
        </tr>
    </thead>
    <?php

    if (isset($resultados)):  ?>
        <?php foreach ($resultados as $insumo): ?>
            <tr>
                <td><?php echo $insumo['Nomproveedor']; ?></td>
                <td><?php echo $insumo['contacto']; ?></td>
                <td><?php echo $insumo['correo']; ?></td>
                <td><?php echo $insumo['insumo']; ?></td>
                <td><?php echo $insumo['baja']; ?></td>
                <td><?php echo $insumo['cantinsumo']; ?></td>

            </tr>
        <?php endforeach ?>
    <?php endif ?>
</table>

</html>