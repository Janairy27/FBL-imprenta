<?php
include 'includes/header.php';
include '../Controlador/controladorPedido.php';


session_start();
$user = $_SESSION['usuario'];
if (isset($_SESSION['usuario'])) {
    echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
?>
    <a href="../Vista/logout.php">
        <img src="../Vista/img/logout.png" class="image">
        <p class=" posicion"> Cerrar sesion</p>
    </a>
    <?php



    /**Traer los litasdos de todas las tablas a utilizar
     */
    $proceso = isset($pedido);
    $controlador = new controladorPedido();
    $productosf = $controlador->obtenerListaProductof();
    $empleados = $controlador->obtenerListaEmpleados();
    $estados = $controlador->obtenerListaEstados();
    ?>

    <!-- Formulario de registro de pedido-->

    <div class="bloque">
        <h2>Registro de pedidos</h2>
        <form method="POST" name="frmpedido" id="frmpedido" action="../Controlador/controladorPedido.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>"
            onsubmit="return validarPedido();" class="formulario">

            <?php if ($proceso):  ?>
                <input type="hidden" name="id" value="<?php echo $pedido['serie']; ?>">
            <?php endif; ?>

            <label>Cantidad</label>
            <input type="text" name="cant" id="cant" placeholder="Cantidad de productos" value="<?php echo $proceso ? $pedido['cant'] : ''; ?>"
                onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">
            <p class="alert alert-danger" id="can" name="can" style="display: none;">
                Favor de llenar el campo
            </p>

            <label>Nombre del cliente</label>
            <input type="text" name="nombrecliente" id="nombrecliente" placeholder="Nombre del cliente" value="<?php echo $proceso ? $pedido['nombrecliente'] : ''; ?>">
            <p class="alert alert-danger" id="nombc" name="nombc" style="display: none;">
                Favor de llenar el campo
            </p>

            <label>Fecha de pedido</label>
            <input type="date" name="fechaPedido" id="fechaPedido" placeholder="YYYY-MM-DD" value="<?php echo $proceso ? $pedido['fechaPedido'] : ''; ?>">
            <p class="alert alert-danger" id="fechap" name="fechap" style="display: none;">
                Favor de llenar el campo
            </p>

            <label>Producto</label>
            <select name="idproductoFinal" id="idproductoFinal">
                <option value="">Seleccionar:</option>
                <?php foreach ($productosf as $productof): ?>
                    <option value="<?php echo $productof['idproductoFinal']; ?>">
                        <?php echo $productof['productof']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="alert alert-danger" id="producto" name="producto" style="display: none;">
                Favor de seleccionar un producto
            </p>

            <label>Empleado</label>
            <label><?php echo ("Usuario:  $user") ?></label>
            <select name="idempleado" id="idempleado">
                <option value="">Seleccionar:</option>
                <?php foreach ($empleados as $empleado): ?>
                    <option value="<?php echo $empleado['idempleado']; ?>">
                        <?php echo $empleado['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Estado</label>
            <select name="idestado" id="idestado">
                <option value="">Seleccionar:</option>
                <?php foreach ($estados as $estado): ?>
                    <option value="<?php echo $estado['idestado']; ?>">
                        <?php echo $estado['estado']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="alert alert-danger" id="estado" name="estado" style="display: none;">
                Favor de seleccionar un estado del pedido
            </p>

            <button type="submit">Guardar
                <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
            </button>
            <p class="alert alert-success" id="btn" name="btn" style="display: none;">
                Procesando datos
            </p>
            <script src="../Controlador/js/validaciones.js"></script>
        </form>

        <!--Botón para cancelar y regresa al listado de pedido-->
        <button type="button" onclick="window.location.href='../Vista/Pedido.php'">
            Cancelar
            <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
        </button>

    </div>
<?php
} else {
    header("Location:login.php");
}
?>