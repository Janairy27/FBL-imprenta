<?php
include 'includes/header.php';
require_once '../Controlador/controladorAcabadoSuperficial.php';
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



    $controlador = new controladorAcabadoSuperficial();
    $acabados = $controlador->listarAcabados();
    ?>

    <!--Vista para mostrar el listad de cabadaos y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar acbados-->
    <div class="bloque">
        <h2>Listado de acabados</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorAcabadoSuperficial.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda">
                        <option value="nomAcabado">Nombre</option>
                    </select>
                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!--Botón para buscar acabado-->
                    <button type="submit">
                        Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para mostrar todos los registros (refescar)-->
                    <button type="submit">
                        Mostrar todo
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para agregar un nuevo acabado-->
                    <button type="button" onclick="window.location.href='../Vista/registroAcabadoSuperficial.php'">
                        Agregar Acabado superficial
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Nombre</th>
                        <th>Editar / Eliminar</th>

                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $acabado): ?>
                            <tr>
                                <td><?php echo $acabado['nomAcabado']; ?></td>

                                <td>
                                    <a href="../Controlador/controladorAcabadoSuperficial.php?accion=actualizar&id=<?php echo htmlspecialchars($acabado['idacabado'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorAcabadoSuperficial.php?accion=eliminar&id=<?php echo $acabado['idacabado']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este acabado?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron acabados superficiales.</td>
                        </tr>
                    <?php endif ?>
                </table>

                <!--Botón para regresar a la ventana del index del administrador -->
                <button type="button" onclick="window.location.href='../Vista/buscarColor.php'">
                    Regresar al menu
                    <img src="../Vista/img/regresar.png" alt="Agregar" style="width: 30px; height: 30px;">
                </button>

            </div>
    </div>

<?php
} else {
    header("Location:login.php");
}
?>