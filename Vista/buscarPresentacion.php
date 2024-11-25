<?php
include 'includes/header.php';
require_once '../Controlador/controladorPresentacion.php';
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

    $controlador = new controladorPresentacion();
    $presentaciones = $controlador->listarPresentaciones();
    ?>
    <!--Vista para mostrar el listado de presentaciones y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar presentaciones -->


    <div class="bloque">
        <h2 class="texto2">Listado de presentaciones </h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorPresentacion.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="nomPresentacion">Presentacion</option>
                    </select>
                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>
                    <!--Botoón para buscar-->
                    <button type="submit"> Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para ver todos (refrescar)-->
                    <button type="submit"> Mostrar todo
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>
                    <!--Botón para agregar una nueva presentacion-->
                    <button type="button" onclick="window.location.href='../Vista/registroPresentacion.php'">
                        Agregar Presentacion
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>

                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Presentacion</th>
                        <th>Editar / Eliminar</th>

                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $presentacion): ?>
                            <tr>
                                <td><?php echo $presentacion['nomPresentacion']; ?></td>
                                <td>
                                    <a href="../Controlador/controladorPresentacion.php?accion=actualizar&id=<?php echo htmlspecialchars($presentacion['idpresentacion'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorPresentacion.php?accion=eliminar&id=<?php echo $presentacion['idpresentacion']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta presentacion?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron presentaciones.</td>
                        </tr>
                    <?php endif ?>
                </table>
                <!-- Botón para regresar al menu de administrador-->
                <button type="button" onclick="window.location.href='../Vista/buscarMedida.php'">
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