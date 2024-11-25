<?php
include 'includes/header.php';
require_once '../Controlador/controladorInsumoProducto.php';


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

    /**Asignación de las listas generadas desde el modelo dependiendo de la información recopilada
     * con el fin de tener una mejor visión de los datos con los que se ingresarán en el 
     * formulario
     */
    $controlador = new controladorInsumoProd();
    $insumop = $controlador->listarprodInusmo();
    $productosf = $controlador->obtenerListaProductof();
    $insumos = $controlador->obtenerListaInsumoProd();
    ?>

    <div class="bloque">
        <h2>Listado de insumos para realizar los productos</h1>
            <!-- Creación de la tabla general que estará mostrando la información de búsqueda o información almacenada en toda la tabla  -->
            <div class="tabla">
                <div class="contenedor-formulario">
                    <form method='POST' action="../Controlador/controladorInsumoProducto.php?accion=buscar"
                        clas="formulario">
                        <label for="busqueda">Buscar por:</label>
                        <select name="busqueda" id="busqueda" class="opciones">
                            <option value="idproductoFinal">producto final</option>
                            <option value="idinsumos">Insumo</option>
                            <option value="cantidadInsumo">Cantidad</option>
                            <option value="medidaProducto">Tipo de medida</option>
                        </select>

                        <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>
                        <button type="submit">Buscar
                            <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                        </button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table tabla">
                        <tr class="table-light">
                            <th>Producto final</th>
                            <th>Insumo</th>
                            <th>Cantidad de insumo</th>
                            <th>Tipo de medida</th>
                            <th>Editar / Eliminar</th>
                        </tr>
                        <?php if (isset($resultados)): ?>
                            <?php foreach ($resultados as $productoin): ?>
                                <tr>
                                    <!-- Impresión en cada uno de los registros, el nombre de las variables corresponde al alias que
                     fue definida en la consulta correspondiente  -->
                                    <td><?php echo $productoin['prodf']; ?></td>
                                    <td><?php echo $productoin['insumo']; ?></td>
                                    <td><?php echo $productoin['cant']; ?></td>
                                    <td><?php echo $productoin['medida']; ?></td>
                                    <td>
                                        <a href="../Controlador/controladorInsumoProducto.php?accion=actualizar&id=<?php echo htmlspecialchars($productoin['idinsumoProducto'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                        <a href="../Controlador/controladorInsumoProducto.php?accion=eliminar&id=<?php echo $productoin['idinsumoProducto']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta información?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </table>
                </div>
                <button type="button" onclick="window.location.href='../Vista/Pedido.php'">
                    Regresar
                    <img src="../Vista/img/regresar.png" alt="Regresar" style="width: 10px; height: 10px;">
                </button>
            </div>
            <br><br>
            <!-- Formulario que servirá para pder modifnca información de algun registro, obtendrá el id desde la misma 
     url que se encuentre seleccionando, en las listas por default mostrará la información que corresponde a 
     el id que fue seleccionado  -->
            <div class="formulario">
                <?php
                $proceso = isset($productoin);
                if ($proceso && isset($productoin)): ?>
                    <h2>Editar registro</h2>
                    <form method="POST" name="frminsumoprod" id="frminsumoprod" action="../Controlador/controladorInsumoProducto.php?accion=actualizar"
                        class="formulario-derecha">

                        <input type="hidden" name="id" value="<?php echo $productoin['idinsumoProducto']; ?>">

                        <label for="idproductoFinal">Producto final</label>
                        <select name="idproductoFinal" id="idproductoFinal" required>
                            <option value="">Seleccionar:</option>
                            <?php foreach ($productosf as $productof): ?>
                                <option
                                    value="<?php echo htmlspecialchars($productof['idproductoFinal'], ENT_QUOTES, 'UTF-8'); ?>"
                                    <?php echo isset($productoin['idproductoFinal']) && $productof['idproductoFinal'] == $productoin['idproductoFinal'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($productof['productof'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="alert alert-danger" id="prod" name="prod" style="display: none;">
                            Favor de seleccionar un producto
                        </p>

                        <label for="idinsumos">Insumo</label>
                        <select name="idinsumos" id="idinsumos" required>
                            <option value="">Seleccionar:</option>
                            <?php foreach ($insumos as $insumo): ?>
                                <option
                                    value="<?php echo htmlspecialchars($insumo['idinsumos'], ENT_QUOTES, 'UTF-8'); ?>"
                                    <?php echo isset($productoin['idinsumos']) && $insumo['idinsumos'] == $productoin['idinsumos'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($insumo['nombre'], ENT_QUOTES, 'UTF-8'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <p class="alert alert-danger" id="insu" style="display: none;">
                            Favor de seleccionar un insumo
                        </p>

                        <label>Cantidad</label>
                        <input type="number" name="cantidadInsumo" id="cantidadInsumo" placeholder="Total de producto a utilizar"
                            value="<?php echo htmlspecialchars($productoin['cantidadInsumo'] ?? ''); ?>" step="0.01" min="0">
                        <p class="alert alert-danger" id="cant" name="cant" style="display: none;">
                            Favor de llenar el campo
                        </p>

                        <label>Medida</label>
                        <input
                            type="text"
                            name="medidaProducto"
                            id="medidaProducto"
                            placeholder="Medida (mtr, mm, ltr)"
                            value="<?php echo htmlspecialchars($productoin['medidaProducto'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                            required>
                        <p class="alert alert-danger" id="med" style="display: none;">
                            Favor de llenar el campo
                        </p>


                        <button type="submit">Actualizar
                            <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
                        </button>
                    </form>
                <?php else: ?>
                    <!-- formulario para poder ingresar un nuevo registro  -->
                    <h2>Registro de insumo para producto</h2>
                    <form method="POST" name="frminsumoprod" id="frminsumoprod" action="../Controlador/controladorInsumoProducto.php?accion=crear" class="formulario">
                        <label>Producto final</label>
                        <select name="idproductoFinal" id="idproductoFinal">
                            <option value="">Seleccionar:</option>
                            <?php foreach ($productosf as $productof): ?>
                                <option value="<?php echo $productof['idproductoFinal']; ?>"><?php echo $productof['productof']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Insumo</label>
                        <select name="idinsumos" id="idinsumos">
                            <option value="">Seleccionar:</option>
                            <?php foreach ($insumos as $insumo): ?>
                                <option value="<?php echo $insumo['idinsumos']; ?>"><?php echo $insumo['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>

                        <label>Cantidad</label>
                        <input type="text" name="cantidadInsumo" id="cantidadInsumo" placeholder="Total de producto a utilizar" required>

                        <label>Medida</label>
                        <input type="text" name="medidaProducto" id="medidaProducto" placeholder="Medida (mtr, mm, ltr)" required>

                        <button type="submit">Guardar
                            <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;"></button>
                    </form>
                <?php endif; ?>

                <button type="button" onclick="window.location.href='../Vista/Pedido.php'">
                    Cancelar
                    <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
            </div>

    </div>
<?php
} else {
    header("Location:login.php");
}
?>