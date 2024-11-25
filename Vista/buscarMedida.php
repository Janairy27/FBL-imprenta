<?php
include 'includes/header.php';
require_once '../Controlador/controladorMedida.php';
session_start();
$user = $_SESSION['usuario'];
if (isset($_SESSION['usuario'])) {
    echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
    ?>
    <a href="../Vista/logout.php">
     <img   src="../Vista/img/logout.png" class="image">
     <p class=" posicion"> Cerrar sesion</p></a>
<?php
  

    $controlador = new controladorMedida();
    $medidas = $controlador->listarMedidas();
?>

    <!--Vista para mostrar el listado de medidads y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar medidas-->

    <div class="bloque">
        <h2>Listado de medidas</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorMedida.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="largo">Largo</option>
                        <option value="ancho"> Ancho</option>
                    </select>
                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!-- Botón para buscar -->
                    <button type="submit"> Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para mostrar todos (refrescar) -->
                    <button type="submit">Mostrar todo
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>

                    <!-- Botón para agregar una nueva medida -->
                    <button type="button" onclick="window.location.href='../Vista/registroMedida.php'">
                        Agregar Medida
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>
                    <!--Botón  para ver el listado Tipo de Medida -->
                    <button type="button" onclick="window.location.href='../Vista/buscarTipoMedida.php'">
                        Tipo Medida
                        <img src="../Vista/img/tipomedida.png" alt="Agregar tipomedia" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para ver el lsitado de Medida -->
                    <button type="button" onclick="window.location.href='../Vista/buscarPresentacion.php'">
                        Presentacion
                        <img src="../Vista/img/presentacion.png" alt="Agregar Presentacion" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para ver el listado Grosor-->
                    <button type="button" onclick="window.location.href='../Vista/buscarGrosor.php'">
                        Grosor
                        <img src="../Vista/img/grosor.png" alt="Agregar Grosor" style="width: 30px; height: 30px;">
                    </button>

                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Largo</th>
                        <th>Medida</th>
                        <th>Editar / Eliminar</th>

                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $medida): ?>
                            <tr>
                                <td><?php echo $medida['largo']; ?></td>
                                <td><?php echo $medida['ancho']; ?></td>
                                <td>
                                    <a href="../Controlador/controladorMedida.php?accion=actualizar&id=<?php echo htmlspecialchars($medida['idmedida'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorMedida.php?accion=eliminar&id=<?php echo $medida['idmedida']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta medida?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron medidas.</td>
                        </tr>
                    <?php endif ?>
                </table>

                <!-- Botón para regresar al menu de administrador -->
                <button type="button" onclick="window.location.href='../Vista/administrador.php'">
                    <img src="../Vista/img/regresar.png" alt="Agregar" style="width: 30px; height: 30px;">
                    <!--Regresar-->
                </button>

            </div>
    </div>

<?php
} else {
    header("Location:login.php");
}
?>