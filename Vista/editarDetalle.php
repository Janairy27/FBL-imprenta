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
        $query = "select detalle.folio, detalle.descuento, detalle.subtotal, detalle.iva, detalle.total,
        detalle.serie, concat(pedido.nombrecliente, ', ', pedido.fechaPedido, ', ', productofinal.nombre) as datos from
        detalle inner join pedido on pedido.serie = detalle.serie inner join productofinal on 
        pedido.idproductoFinal = productofinal.idproductoFinal where detalle.folio = ?; ";

        $stmt = $conn->prepare($query);
        if (!$stmt) {
            die("Error en la preparación de la consulta de pedido " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $detalles = $result->fetch_assoc();

        if (!$detalles) {
            echo "<p>Error: No se encontró el detalle.</p>";
            exit;
        }
    } else {
        echo "<p>Error: id no proporcionado.</p>";
        exit;
    }

    require_once '../Controlador/controladorDetalle.php';
    $controlador = new controladorDetalle();
    $pedidos = $controlador->obtenerPedidos();

?>

    <!--vista para la actualización de detalle-->
    <div class="bloque">
        <h2>Actualización de detalle</h2>
        <form method="POST" name="frmdetalle" id="frmdetalle" action="../Controlador/controladorDetalle.php?accion=actualizar"
            onsubmit="return validarDetalle();" class="formulario">

            <input type="hidden" name="id" value="<?php echo htmlspecialchars($detalles['folio']); ?>">

            <label>Descuento</label>
            <input type="text" name="descuento" id="descuento" placeholder="Descuento" value="<?php echo htmlspecialchars($detalles['descuento']); ?>"
                onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">
            <p class="alert alert-danger" id="desc" name="desc" style="display: none;">
                Favor de llenar el campo
            </p>

            <label>Subtotal</label>
            <input type="text" name="subtotal" id="subtotal" placeholder="Subtotal" value="<?php echo htmlspecialchars($detalles['subtotal']); ?>"
                onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">
            <p class="alert alert-danger" id="sub" name="sub" style="display: none;">
                Favor de llenar el campo
            </p>

            <label>IVA</label>
            <input type="text" name="iva" id="iva" placeholder="IVA" value="<?php echo htmlspecialchars($detalles['iva']); ?>"
                onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">
            <p class="alert alert-danger" id="iv" name="iv" style="display: none;">
                Favor de llenar el campo
            </p>

            <label>Total</label>
            <input type="text" name="total" id="total" placeholder="Total" value="<?php echo htmlspecialchars($detalles['total']); ?>"
                onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">
            <p class="alert alert-danger" id="tot" name="tot" style="display: none;">
                Favor de llenar el campo
            </p>

            <label>Pedido</label>
            <select name="serie" id="serie">
                <?php foreach ($pedidos as $pedido): ?>
                    <option value="<?php echo $pedido['serie']; ?>"
                        <?php echo ($pedido['serie'] == $detalles['serie']) ? 'selected' : ''; ?>>
                        <?php echo $pedido['datos']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="alert alert-danger" id="ped" name="ped" style="display: none;">
                Favor de seleccionar un producto
            </p>

            <!--Botón para guardar los cambios-->
            <button type="submit"> Guardar cambios
                <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
            </button>

            <!-- Botón para cancelar y regresar al listado de detalle-->
            <button type="button" onclick="window.location.href='../Vista/Detalle.php';">
                <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
                Cancelar</button>
        </form>
        <script src="../Controlador/js/validaciones.php"></script>
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