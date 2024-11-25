<?php
include 'includes/header.php';
include '../Controlador/controladorDetalle.php';


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



    $proceso = isset($detalle);
    $controlador = new controladorDetalle();
    $pedidos = $controlador->obtenerListaPedidos();

    ?>

    <body data-context="registroDetalle">
        <!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
                <!-- Botón de cierre manual con evento para redirigir -->
                <button type="button" class="btn-close" id="closeButton" aria-label="Close">Aceptar</button>
            </div>
        <?php endif; ?>
        <!-- Formulario de registro de detalle -->

        <div class="bloque">
            <h2>Registro de detalle de pedidos</h2>
            <form method="POST" name="frmdetalle" id="frmdetalle" action="../Controlador/controladorDetalle.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>"
                onsubmit="return validarDetalle();" class="formulario">

                <?php if ($proceso):  ?>
                    <input type="hidden" name="id" value="<?php echo $detalle['folio']; ?>">
                <?php endif; ?>

                <label>Descuento</label>
                <input type="text" name="descuento" id="descuento" placeholder="Descuento" value="<?php echo $proceso ? $detalle['descuento'] : ''; ?>"
                    onkeypress="
                        if(event.keyCode<46 || event.keyCode >57){
                            event.returnValue=false;
                        }">
                <p class="alert alert-danger" id="desc" name="desc" style="display: none;">
                    Favor de llenar el campo
                </p>

                <label>Subtotal</label>
                <input type="text" name="subtotal" id="subtotal" placeholder="Subtotal" value="<?php echo $proceso ? $detalle['subtotal'] : ''; ?>"
                    onkeypress="
                        if(event.keyCode<46 || event.keyCode >57){
                            event.returnValue=false;
                        }">
                <p class="alert alert-danger" id="sub" name="sub" style="display: none;">
                    Favor de llenar el campo
                </p>

                <label>IVA</label>
                <input type="text" name="iva" id="iva" placeholder="IVA" value="<?php echo $proceso ? $detalle['iva'] : ''; ?>"
                    onkeypress="
                        if(event.keyCode<46 || event.keyCode >57){
                            event.returnValue=false;
                        }">
                <p class="alert alert-danger" id="iv" name="iv" style="display: none;">
                    Favor de llenar el campo
                </p>

                <label>Total</label>
                <input type="text" name="total" id="total" placeholder="Total" value="<?php echo $proceso ? $detalle['total'] : ''; ?>"
                    onkeypress="
                        if(event.keyCode<46 || event.keyCode >57){
                            event.returnValue=false;
                        }">
                <p class="alert alert-danger" id="tot" name="tot" style="display: none;">
                    Favor de llenar el campo
                </p>

                <label>Pedido</label>
                <select name="serie" id="serie">
                    <option value="">Seleccionar:</option>
                    <?php foreach ($pedidos as $pedido): ?>
                        <option value="<?php echo $pedido['serie']; ?>">
                            <?php echo $pedido['datos']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="alert alert-danger" id="ped" name="ped" style="display: none;">
                    Favor de seleccionar un producto
                </p>

                <button type="submit">Guardar
                    <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
                </button>
                <p class="alert alert-success" id="btn" name="btn" style="display: none;">
                    Procesando datos
                </p>
                <script src="../Controlador/js/validaciones.js"></script>
            </form>
            <!--Botón para cancelar y regresa al listado de detalle-->
            <button type="button" onclick="window.location.href='../Vista/Detalle.php'">
                Cancear
                <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
            </button>
        </div>
    </body>
<?php
} else {
    header("Location:login.php");
}
?>