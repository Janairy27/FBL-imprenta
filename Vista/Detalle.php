<?php
include 'includes/header.php';
require_once '../Controlador/controladorDetalle.php';

session_start();
$user = $_SESSION['usuario'];
if (isset($_SESSION['usuario'])) {
    echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
    ?>
    <a href="../Vista/logout.php">
     <img   src="../Vista/img/logout.png" class="image">
     <p class=" posicion"> Cerrar sesion</p></a>
<?php
  
    $controlador = new controladorDetalle();
    $detalles = $controlador->listarDetalle();

?>
    <!--Vista para mostrar el listado de detalles y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar detalles -->
    <div class="bloque">
        <h2>Listado de detalle</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorDetalle.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="descuento">Descuento</option>
                        <option value="total">Total</option>
                        <option value="serie">Pedido</option>
                    </select>

                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!--Botón para buscar-->
                    <button type="submit">Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para mostrar todos los registros (refrescar) -->
                    <button type="submit">Refrescar
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>


                    <!-- Botón para agregar un nuevo detalle-->
                    <button type="button" onclick="window.location.href='../Vista/registroDetalle.php'">
                        Agregar Detalle
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>

                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Descuento</th>
                        <th>Subtotal</th>
                        <th>IVA</th>
                        <th>Total</th>
                        <th>Pedido</th>
                        <th>Editar / Eliminar</th>
                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $detalle): ?>
                            <tr>
                                <td><?php echo $detalle['descuento']; ?></td>
                                <td><?php echo $detalle['subtotal']; ?></td>
                                <td><?php echo $detalle['iva']; ?></td>
                                <td><?php echo $detalle['total']; ?></td>
                                <td><?php echo $detalle['pedido']; ?></td>
                                <td>
                                    <a href="../Controlador/controladorDetalle.php?accion=actualizar&id=<?php echo htmlspecialchars($detalle['folio'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorDetalle.php?accion=eliminar&id=<?php echo $detalle['folio']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este detalle del pedido?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron detalles de pedidos.</td>
                        </tr>
                    <?php endif ?>
                </table>

                <!--Botón para regresar al menu del administrador -->
                <button type="button" onclick="window.location.href='../Vista/Pedido.php'">
                    Regresar
                    <img src="../Vista/img/regresar.png" alt="Agregar" style="width: 30px; height: 30px;">
                </button>
            </div>
    </div>

<?php
} else {
    header("Location:login.php");
}
?>