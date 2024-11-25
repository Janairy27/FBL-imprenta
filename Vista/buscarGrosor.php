<?php
include 'includes/header.php';
require_once '../Controlador/controladorGrosor.php';
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


    $controlador = new controladorGrosor();
    $grosores = $controlador->listarGrosores();
    ?>
<!--Vista para mostrar el listado de grosores y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar grosores-->


<div class="bloque">
    <h2>Listado de grosores</h1>

        <div class="contenedor-formulario">
            <form method='POST' action="../Controlador/controladorGrosor.php?accion=buscar" clas="formulario">
                <label for="busqueda">Buscar por:</label>
                <select name="busqueda" id="busqueda" class="opciones">
                    <option value="cantGrosor">Cantidad</option>
                    <option value="flexibilidad">Flexibilidad</option>
                </select>
                <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                <!-- Botón para buscar -->
                <button type="submit"> Buscar
                    <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                </button>

                <!-- Botón para mostrar todos (refrescar) -->
                <button type="submit"> Mostrar todo
                    <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                </button>

                <!-- Botón para agregar un nuevo grosor -->
                <button type="button" onclick="window.location.href='../Vista/registroGrosor.php'">
                    Agregar grosor
                    <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                </button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table tabla">
                <tr class="table-light">
                    <th>Cantidad</th>
                    <th>Unidad de Medida</th>
                    <th>Flexibilidad</th>
                    <th>Editar / Eliminar</th>

                </tr>
                <?php if (isset($resultados) && count($resultados) > 0): ?>
                <?php foreach ($resultados as $grosor): ?>
                <tr>
                    <td><?php echo $grosor['cantGrosor']; ?></td>
                    <td><?php echo $grosor['unidadMedida']; ?></td>
                    <td><?php echo $grosor['flexibilidad']; ?></td>

                    <td>
                        <a
                            href="../Controlador/controladorGrosor.php?accion=actualizar&id=<?php echo htmlspecialchars($grosor['idgrosor'], ENT_QUOTES, 'UTF-8'); ?>"><img
                                src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                        <a href="../Controlador/controladorGrosor.php?accion=eliminar&id=<?php echo $grosor['idgrosor']; ?>"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este grosor?');"><img
                                src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                    </td>
                </tr>
                <?php endforeach ?>
                <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No se encontraron grosores.</td>
                </tr>
                <?php endif ?>
            </table>

            <!--Botón para regresar al menu de administrador-->
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