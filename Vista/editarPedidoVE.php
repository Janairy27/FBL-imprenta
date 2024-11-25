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
  

    $id = $_GET['id'] ?? null;
    if ($id) {
        $query = "select pedido.serie, pedido.cant, pedido.nombrecliente, pedido.fechaPedido, 
        pedido.idproductoFinal, productoFinal.nombre as productof, pedido.idempleado, 
        concat(empleado.nomb, ' ',empleado.apaterno) as empleado, pedido.idestado, 
        estado.estado as estado from pedido 
        inner join productoFinal on productoFinal.idproductoFinal = pedido.idproductoFinal 
        inner join empleado on empleado.idempleado = pedido.idempleado
        inner join estado on estado.idestado = pedido.idestado 
        where pedido.serie = ? ;";

        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Error en la preparación de la consulta de pedido " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $pedidos = $result->fetch_assoc();

        if (!$pedidos) {
            echo "<p>Error: No se encontró el pedido.</p>";
            exit;
        }
    } else {
        echo "<p>Error: id no proporcionado.</p>";
        exit;
    }

    require_once '../Controlador/controladorPedidoVE.php';
    $controlador = new controladorPedidoVE();
    $productosf = $controlador->obtenerProductof();
    $empleados = $controlador->obtenerEmpleados();
    $estados = $controlador->obtenerEstados();

?>
    <!--Formulario de actualización de pedidos-->
    <div class="bloque">
        <h2>Actualización de pedidos</h2>
        <form method="POST" name="frmpedido" id="frmpedido" action="../Controlador/controladorPedidoVE.php?accion=actualizar"
            onsubmit="return validarPedido();" class="formulario">

            <input type="hidden" name="id" value="<?php echo htmlspecialchars($pedidos['serie']); ?>">

            <label>Cantidad</label>
            <input type="text" name="cant" id="cant" placeholder="Cantidad de productos" value="<?php echo htmlspecialchars($pedidos['cant']); ?>"
                onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">
            <p class="alert alert-danger" id="can" name="can" style="display: none;">
                Favor de llenar el campo
            </p>

            <label>Nombre del cliente</label>
            <input type="text" name="nombrecliente" id="nombrecliente" placeholder="Nombre del cliente" value="<?php echo htmlspecialchars($pedidos['nombrecliente']); ?>">
            <p class="alert alert-danger" id="nombc" name="nombc" style="display: none;">
                Favor de llenar el campo
            </p>

            <label>Fecha de pedido</label>
            <input type="text" name="fechaPedido" id="fechaPedido" placeholder="YYYY-MM-DD" value="<?php echo htmlspecialchars($pedidos['fechaPedido']); ?>">
            <p class="alert alert-danger" id="fechap" name="fechap" style="display: none;">
                Favor de llenar el campo
            </p>

            <label>Producto</label>
            <select name="idproductoFinal" id="idproductoFinal">
                <?php foreach ($productosf as $productof): ?>
                    <option value="<?php echo $productof['idproductoFinal']; ?>"
                        <?php echo ($productof['idproductoFinal'] == $pedidos['idproductoFinal']) ? 'selected' : ''; ?>>
                        <?php echo $productof['productof']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="alert alert-danger" id="producto" name="producto" style="display: none;">
                Favor de seleccionar un producto
            </p>

            <label>Empleado</label>
            <select name="idempleado" id="idempleado">
                <?php foreach ($empleados as $empleado): ?>
                    <option value="<?php echo $empleado['idempleado']; ?>"
                        <?php echo ($empleado['idempleado'] == $pedidos['idempleado']) ? 'selected' : ''; ?>>
                        <?php echo $empleado['nombre']; ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Estado</label>
            <select name="idestado" id="idestado">
                <?php foreach ($estados as $estado): ?>
                    <option value="<?php echo $estado['idestado']; ?>"
                        <?php echo ($estado['idestado'] == $pedidos['idestado']) ? 'selected' : ''; ?>>
                        <?php echo $estado['estado']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="alert alert-danger" id="estado" name="estado" style="display: none;">
                Favor de seleccionar un estado del pedido
            </p>

            <!--Botón para guardar cambios-->
            <button type="submit"> Guardar cambios
                <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
            </button>

            <!--Botón para cancelar y regresar al listado de pedidos-->
            <button type="button" onclick="window.location.href='../Vista/PedidoVE.php';">Cancelar
                <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
            </button>
            <script src="../Controlador/js/validaciones.js"></script>
        </form>
    </div>
<?php
    // Cerrar conexión y liberar recursos
    $stmt->close();
    $conn->close();
} else {
    header("Location:login.php");
}
?>