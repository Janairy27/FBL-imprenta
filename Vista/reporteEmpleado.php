<?php
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : null;
$valor1 = isset($_GET['valor1']) ? $_GET['valor1'] : null;
$valor2 = isset($_GET['valor2']) ? $_GET['valor2'] : null;

if ($busqueda && $valor1 && $valor2) {
    include '../Controlador/controladorReporteEmpleado.php';
    $controlador = new controladorReporteEmpleado();
    $resultados = $controlador->contabilizarPedidos($busqueda, $valor1, $valor2);
}
?>

<?php
header('Content-Type:application/xls');
header('Content-Disposition: attachment; filename=ReporteEmpleados.xls');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
</head>
<h1>Reporte de empleados</h1>
<table class="table table-striped table-dark">
    <thead>
        <tr class="table-light">
            <th>Nombre</th>
            <th>Apellido paterno</th>
            <th>Apellido materno</th>
            <th>Fecha de nacimiento</th>
            <th>Dirección</th>
            <th>Correo electronico</th>
            <th>Total de pedidos gestionados</th>
        </tr>
    </thead>

    <?php

    if (isset($resultados)):  ?>
        <?php foreach ($resultados as $pedido): ?>
            <tr>
                <td><?php echo $pedido['nombre']; ?></td>
                <td><?php echo $pedido['apaterno']; ?></td>
                <td><?php echo $pedido['amaterno']; ?></td>
                <td><?php echo $pedido['naci']; ?></td>
                <td><?php echo $pedido['direccion']; ?></td>
                <td><?php echo $pedido['correo']; ?></td>
                <td><?php echo $pedido['pedidos']; ?></td>
            </tr>
        <?php endforeach ?>
    <?php endif ?>
</table>

</html>