<?php
include 'includes/header.php';
require_once '../Controlador/controladorTransparencia.php';
session_start();
$user = $_SESSION['usuario'];
if (isset($_SESSION['usuario'])) {
    echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
    ?>
    <a href="../Vista/logout.php">
     <img   src="../Vista/img/logout.png" class="image">
     <p class=" posicion"> Cerrar sesion</p></a>
<?php
  

    $controlador = new controladorTransparencia();
    $transparencias = $controlador->listarTransparencias();
?>

    <!--Vista para mostrar el listado de transparencias y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar transparencias -->

    <div class="bloque">
        <h2>Listado de Transparencias</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorTransparencia.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="nomTransparencia">Nombre</option>
                    </select>
                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!-- Botón para buscar -->
                    <button type="submit"> Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>
                    <!-- Botón para mostrar todos los registros (refrescar) -->
                    <button type="submit"> Mostrar todo
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>

                    <!-- Botón para agregar nueva transparencia -->
                    <button type="button" onclick="window.location.href='../Vista/registroTransparencia.php'">
                        Agregar Transparencia
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
                        <?php foreach ($resultados as $transparencia): ?>
                            <tr>
                                <td><?php echo $transparencia['nomTransparencia']; ?></td>

                                <td>
                                    <a href="../Controlador/controladorTransparencia.php?accion=actualizar&id=<?php echo htmlspecialchars($transparencia['idtransparencia'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorTransparencia.php?accion=eliminar&id=<?php echo $transparencia['idtransparencia']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta transparencia?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron transparencias.</td>
                        </tr>
                    <?php endif ?>
                </table>

                <!-- Botón para regresar al menu de administrador -->
                <button type="button" onclick="window.location.href='../Vista/buscarColor.php'">
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