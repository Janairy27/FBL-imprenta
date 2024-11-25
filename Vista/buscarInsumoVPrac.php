<?php
include 'includes/header.php';
require_once '../Controlador/controladorPracticante.php';

session_start();
$user = $_SESSION['usuario'];
if (isset($_SESSION['usuario'])) {
    echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
    ?>
    <a href="../Vista/logout.php">
     <img   src="../Vista/img/logout.png" class="image">
     <p class=" posicion"> Cerrar sesion</p></a>
<?php
  

    $controlador = new controladorPracticante();
    $insumos = $controlador->listarInsumos();

?>
    <!--Vista para mostrar el listado de insumos y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar insumos-->

    <div class="bloque">
        <h2>Listado de insumos</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorPracticante.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="nomInsumo">Insumo</option>
                        <option value="fechacompra">Fecha de compra</option>
                        <option value="cantidad">Cantidad</option>
                        <option value="rendimiento">Rendimiento</option>
                        <option value="idubicacion">Ubicacion</option>
                        <option value="idcolor">Color</option>
                        <option value="idtransparencia">Transparencia</option>
                        <option value="idacabado">Acabado Superficial</option>
                        <option value="idpresentacion">Presentacion</option>
                        <option value="idtipomedida">Tipo de medida</option>
                        <option value="idmedida">Medida</option>
                        <option value="idgrosor">Grosor</option>
                        <option value="idmaterial">Material</option>
                        <option value="idproveedor">Proveedor</option>
                        <option value="idmarca">Marca</option>
                        <option value="idsubmaterial">SubMaterial</option>
                    </select>

                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!-- Botón para buscar -->
                    <button type="submit"> Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!-- Botón para mostrar todos (refrescar)  -->
                    <button type="submit"> Mostrar todo
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>

                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Insumo</th>
                        <th>Fecha de compra</th>
                        <th>Fecha de uso</th>
                        <th>Cantidad</th>
                        <th>Rendimiento</th>
                        <th>Precio</th>
                        <th>Disponibilidad</th>
                        <th>Ubicacion</th>
                        <th>Color</th>
                        <th>Transparencia</th>
                        <th>Acabado Superficial</th>
                        <th>Presentacion</th>
                        <th>Tipo de medida</th>
                        <th>Medida</th>
                        <th>Grosor</th>
                        <th>Material</th>
                        <th>Proveedor</th>
                        <th>Marca</th>
                        <th>SubMaterial</th>
                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $insumo): ?>
                            <tr>
                                <td><?php echo $insumo['nomInsumo']; ?></td>
                                <td><?php echo $insumo['fechacompra']; ?></td>
                                <td><?php echo $insumo['fechauso'];  ?></td>
                                <td><?php echo $insumo['cantidad'];  ?></td>
                                <td><?php echo $insumo['rendimiento'];  ?></td>
                                <td><?php echo $insumo['precio'];  ?></td>
                                <td><?php echo $insumo['disponibilidad'];  ?></td>
                                <td><?php echo $insumo['ubicacion'];  ?></td>
                                <td><?php echo $insumo['color'];  ?></td>
                                <td><?php echo $insumo['transparencia'];  ?></td>
                                <td><?php echo $insumo['acabado'];  ?></td>
                                <td><?php echo $insumo['presentacion'];  ?></td>
                                <td><?php echo $insumo['tipomedida'];  ?></td>
                                <td><?php echo $insumo['medida'];  ?></td>
                                <td><?php echo $insumo['grosor'];  ?></td>
                                <td><?php echo $insumo['material'];  ?></td>
                                <td><?php echo $insumo['proveedor'];  ?></td>
                                <td><?php echo $insumo['marca'];  ?></td>
                                <td><?php echo $insumo['submaterial'];  ?></td>
                                
                            </tr>
                        <?php endforeach ?>
                        <?php else: ?>
                        <tr>
                            <td colspan="19" class="text-center">No se encontraron insumos.</td>
                        </tr>
                    <?php endif ?>
                </table>

                <!-- Botón para regresar al menu de administrador -->
                <button type="button" onclick="window.location.href='../Vista/practicante.php'">
                    Regresar
                    <img src="../Vista/img/regresar.png" alt="Regresar" style="width: 30px; height: 30px;">
                </button>
            </div>
    </div>

<?php
} else {
    header("Location:login.php");
}
?>