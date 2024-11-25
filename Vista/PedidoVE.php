<?php
include 'includes/header.php';
require_once '../Controlador/controladorPedidoVE.php';


session_start();
$user = $_SESSION['usuario'];
if (isset($_SESSION['usuario'])) {
    echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
    ?>
    <a href="../Vista/logout.php">
     <img   src="../Vista/img/logout.png" class="image">
     <p class=" posicion"> Cerrar sesion</p></a>
<?php
  
    $controlador = new controladorPedidoVE();
    $pedidos = $controlador->listarPedidos();

?>
    <!--Vista para mostrar el listad de pedidos y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar pedidos-->
    <div class="bloque">
        <h2>Listado de pedidos</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorPedidoVE.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="cant">Cantidad</option>
                        <option value="nombrecliente">Nombre del cliente</option>
                        <option value="fechaPedido">Fecha de solicitud</option>
                        <option value="idproductoFinal">Producto</option>
                        <option value="idempleado">Empleado</option>
                        <option value="idestado">Estado del pedido</option>
                    </select>

                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!--Botón para buscar-->
                    <button type="submit">Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para mostrar todos los registros (refescar)-->
                    <button type="submit">Refrescar
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón paa agregar un nuevo pedido-->
                    <button type="button" onclick="window.location.href='../Vista/registroPedidoVE.php'">
                        Agregar Pedido
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Cantidad</th>
                        <th>Nombre del cliente</th>
                        <th>Fecha del pedido</th>
                        <th>Producto</th>
                        <th>Empleado</th>
                        <th>Estado del pedido</th>
                        <th>Editar / Eliminar </th>
                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $pedido): ?>
                            <tr>
                                <td><?php echo $pedido['cant']; ?></td>
                                <td><?php echo $pedido['nombrecliente']; ?></td>
                                <td><?php echo $pedido['fechaPedido']; ?></td>
                                <td><?php echo $pedido['productof']; ?></td>
                                <td><?php echo $pedido['empleado']; ?></td>
                                <td><?php echo $pedido['estado']; ?></td>
                                <td>
                                    <a href="../Controlador/controladorPedidoVE.php?accion=actualizar&id=<?php echo htmlspecialchars($pedido['serie'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorPedidoVE.php?accion=eliminar&id=<?php echo $pedido['serie']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este pedido?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron pedidos.</td>
                        </tr>
                    <?php endif ?>
                </table>

                <!--Botón para regresar al menu de empleado-->
                <button type="button" onclick="window.location.href='../Vista/empleado.php'">
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