<?php
include 'includes/header.php';
require_once '../Controlador/controladorProdFinal.php';


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


    $controlador = new controladorProdFinal();
    $productos = $controlador->listarProdFinal();
    ?>
    <!--Vista para mostrar el listad de productos finales y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar productos finales-->
    <div class="bloque">
        <h2>Listado de productos finales</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorProdFinal.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="">Seleccionar:</option>
                        <option value="nombre">Nombre</option>
                        <option value="precio">Precio</option>
                    </select>

                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>
                    <!--Botón para buscar-->
                    <button type="submit">Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para mostrar todos los registros (refescar)-->
                    <button type="submit">Mostar todo
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón paa agregar un nuevo pedido-->
                    <button type="button" onclick="window.location.href='../Vista/registroProdFinal.php'">
                        Agregar Pedido
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Editar / Eliminar</th>
                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $producto): ?>
                            <tr>
                                <td><?php echo $producto['nombre']; ?></td>
                                <td><?php echo $producto['precio']; ?></td>
                                <td>
                                    <a href="../Controlador/controladorProdFinal.php?accion=actualizar&id=<?php echo htmlspecialchars($producto['idproductoFinal'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorProdFinal.php?accion=eliminar&id=<?php echo $producto['idproductoFinal']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron productos finales.</td>
                        </tr>
                    <?php endif ?>
                </table>
                <!--Botón para regresar al menu de administrador-->
                <button type="button" onclick="window.location.href='../Vista/administrador.php'">
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