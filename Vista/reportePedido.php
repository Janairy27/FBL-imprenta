
<?php
include 'includes/header.php';

session_start();
$user = $_SESSION['usuario'];
if (isset($_SESSION['usuario'])) {
    echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
    ?>
    <a href="../Vista/logout.php">
     <img   src="../Vista/img/logout.png" class="image">
     <p class=" posicion"> Cerrar sesion</p></a>
<?php
  

?>

<div class="bloque">
    <h2>Listado de cantidad de insumos para realizar productos</h1>

    <div class="contenedor-formulario">
        <form method='POST' action="../Controlador/controladorReporteInsumoProducto.php?accion=buscar"
        clas="formulario">

            <label for="busqueda">Buscar por:</label>
            <select name="busqueda" id="busqueda" class="opciones">
                <option value="fechaPedido">Fecha</option>
            </select>

            <input type="text" name="valor1" placeholder="Ingrese la fecha inicial" require>
            <input type="text" name="valor2" placeholder="Ingrese la fecha límite" require>
            <button type="submit">Buscar
            <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
            </button>

            <button type="submit" formaction="../Controlador/controladorReporteInsumoProducto.php?accion=actualizar">Mostrar todo
            <img src="../Vista/img/refrescar.png" alt="Buscar" style="width: 30px; height: 30px;">
            </button>
            <button type="button">
                <a href="../Vista/reportePedidoInsumo.php?busqueda=<?php echo isset($_POST['busqueda']) ? htmlspecialchars($_POST['busqueda']) : ''; ?>&valor1=<?php echo isset($_POST['valor1']) ? htmlspecialchars($_POST['valor1']) : ''; ?>&valor2=<?php echo isset($_POST['valor2']) ? htmlspecialchars($_POST['valor2']) : ''; ?>">
                Generar reporte</a>
            </button>

        </form>
    </div>

    <div class ="table-responsive">
        <table class="table tabla">
            <tr class="table-light">
                <th>Producto</th>
                <th>Cantidad de Insumos requeridos</th>
            </tr>
            <?php if(isset($resultados)):  ?>
                <?php foreach($resultados as $inProd): ?>
                    <tr>                        
                        <td><?php echo $inProd['productof']; ?></td>
                        <td><?php echo $inProd['cantidad']; ?></td>
                    </tr>
                    <?php endforeach ?>
                <?php endif ?>
        </table>
        <button type="button"  onclick="window.location.href='../Vista/reportesVP.php'" >Regresar
            <img src="../Vista/img/regresar.png" alt="Regresar" style="width: 30px; height: 30px;" >

        </button>
    </div>
</div>

<?php
}else{
  header("Location:login.php");
}
?>