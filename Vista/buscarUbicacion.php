<?php
include 'includes/header.php';
require_once('../Controlador/controladorUbicacion.php');
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

    $controlador = new controladorUbicacion();
    $ubicaciones = $controlador->listarUbicaciones();
    ?>

    <!--Vista para mostrar el listado de ubicaciones y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar ubicaciones -->
    <div class="bloque">
        <h2>Listado de ubicaciones</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorUbicacion.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="mueble">Mueble </option>
                        <option value="division1">Division 1</option>
                        <option value="division2">Division 2 </option>
                        <option value="division3 ">Division 3</option>
                    </select>

                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!--  Botón para buscar -->
                    <button type="submit"> Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!-- Botón para mostrar todos los registros (refrescar) -->
                    <button type="submit"> Mostrar todo
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>

                    <!-- Botón para agregar una nueva ubicación -->
                    <button type="button" onclick="window.location.href='../Vista/registroUbicacion.php'">
                        Agregar ubicación
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Mueble</th>
                        <th>Division 1</th>
                        <th>Division 2</th>
                        <th>Division 3</th>
                        <th>Editar / Eliminar </th>
                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $ubicacion): ?>
                            <tr>
                                <td><?php echo $ubicacion['mueble']; ?></td>
                                <td><?php echo $ubicacion['division1']; ?></td>
                                <td><?php echo $ubicacion['division2']; ?></td>
                                <td><?php echo $ubicacion['division3']; ?></td>
                                <td>
                                    <a href="../Controlador/controladorUbicacion.php?accion=actualizar&id=<?php echo htmlspecialchars($ubicacion['idubicacion'], ENT_QUOTES, 'UTF-8'); ?>"> <img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorUbicacion.php?accion=eliminar&id=<?php echo $ubicacion['idubicacion']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta Ubicación?');"> <img src="../Vista/img/eliminar.png" width="30px" height="30px"> </a>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron ubicaciones.</td>
                        </tr>
                    <?php endif ?>
                </table>

                <!-- Botón para regresar al menu de administrador -->
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