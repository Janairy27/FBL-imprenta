<?php
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : null;
$valor1 = isset($_GET['valor1']) ? $_GET['valor1'] : null;
$valor2 = isset($_GET['valor2']) ? $_GET['valor2'] : null;

if ($busqueda && $valor1 && $valor2) {
    include '../Controlador/controladorReporteInsumoProducto.php';
    $controlador = new controladorReporteInsumoProducto();
    $resultados = $controlador->contabilizarInsumos($busqueda, $valor1, $valor2);
}
?>

<?php
            header('Content-Type:application/xls');
            header('Content-Disposition: attachment; filename=ReporteCantidadInsumos.xls');
?>
<h1>Reporte de cantidad de insumos utilizados para productos finales</h1>
<table class="table table-striped table-dark">
<thead>
    <tr class="table-light">
            <th>Producto</th>
            <th>Cantidad de Insumos requeridos</th>
        </tr>
    </thead>
<?php 

    if(isset($resultados)):  ?>
        <?php foreach($resultados as $inProd): ?>
            <tr>                        
                <td><?php echo $inProd['productof']; ?></td>
                <td><?php echo $inProd['cantidad']; ?></td>
            </tr>
        <?php endforeach ?>
    <?php endif ?>
</table>
