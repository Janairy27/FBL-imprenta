<?php
include 'includes/header.php';
require_once '../Controlador/controladorProveedor.php';
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

    $controlador = new controladorProveedor();
    $proveedores = $controlador->listarProveedores();
    ?>
    <!--Vista para mostrar el listado de proveedores y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar proveedores -->



    <div class="bloque">
        <h2>Listado de proveedores</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorProveedor.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="Nomproveedor">Nombre</option>
                        <option value="direccion">Direccion</option>
                        <option value="telefono">Número teléfonico</option>
                        <option value="correo">Correo electronico</option>
                    </select>
                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!-- Botón para buscar-->
                    <button type="submit"> Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Bottón para mostrar todos (refrescar)-->
                    <button type="submit"> Mostrar todo
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para agregar un nuevo proveedor-->
                    <button type="button" onclick="window.location.href='../Vista/registrarProveedor.php'">
                        Agregar proveedor
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Boton para ver el listado de marcas-->
                    <button type="button" onclick="window.location.href='../Vista/buscarMarca.php'">
                        Marca
                        <img src="../Vista/img/marca.png" alt="Marca" style="width: 30px; height: 30px;">
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Contacto</th>
                        <th>Numero telefonico</th>
                        <th>Correo electronico</th>
                        <th>Número de cliente</th>
                        <th>Editar / Eliminar</th>

                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $proveedor): ?>
                            <tr>
                                <td><?php echo $proveedor['Nomproveedor']; ?></td>
                                <td><?php echo $proveedor['direccion']; ?></td>
                                <td><?php echo $proveedor['contacto']; ?></td>
                                <td><?php echo $proveedor['telefono']; ?></td>
                                <td><?php echo $proveedor['correo']; ?></td>
                                <td><?php echo $proveedor['NoCliente']; ?></td>

                                <td>
                                    <a href="../Controlador/controladorProveedor.php?accion=actualizar&id=<?php echo htmlspecialchars($proveedor['idproveedor'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorProveedor.php?accion=eliminar&id=<?php echo $proveedor['idproveedor']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este proveedor?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron proveedores.</td>
                        </tr>
                    <?php endif ?>
                </table>
            </div>

            <!--Botón para regresar al menu de administrador-->
            <button type="button" onclick="window.location.href='../Vista/administrador.php'">
                Regresar
                <img src="../Vista/img/regresar.png" alt="Regresar" style="width: 30px; height: 30px;">
            </button>
    </div>


<?php
} else {
    header("Location:login.php");
}
?>