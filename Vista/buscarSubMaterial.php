<?php
include 'includes/header.php';
require_once '../Controlador/controladorSubMaterial.php';
session_start();
$user = $_SESSION['usuario'];
if (isset($_SESSION['usuario'])) {
    echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
    ?>
    <a href="../Vista/logout.php">
     <img   src="../Vista/img/logout.png" class="image">
     <p class=" posicion"> Cerrar sesion</p></a>
<?php
  

    $controlador = new controladorSubMaterial();
    $submateriales = $controlador->listarSubMateriales();
?>


    <!--Vista para mostrar el listado de submateriales y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar submateriales -->

    <div class="bloque">
        <h2>Listado de submateriales</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorSubMaterial.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="nomsubmaterial">Nombre submaterial</option>
                    </select>
                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!--Botón para buscar-->
                    <button type="submit"> Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para mostrar todo (Refescar)-->
                    <button type="submit"> Mostrar todo
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>


                    <!--Botón para agregar un nuevo submaterial -->
                    <button type="button" onclick="window.location.href='../Vista/registrarSubMaterial.php'">
                        Agregar submaterial
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>

                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>SubMaterial</th>
                        <th>Editar / Eliminar</th>

                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $submaterial): ?>
                            <tr>
                                <td><?php echo $submaterial['nomSubmaterial']; ?></td>
                                <td>
                                    <a href="../Controlador/controladorSubMaterial.php?accion=actualizar&id=<?php echo htmlspecialchars($submaterial['idsubmaterial'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorSubMaterial.php?accion=eliminar&id=<?php echo $submaterial['idsubmaterial']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este submaterial?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron submateriales.</td>
                        </tr>
                    <?php endif ?>
                </table>


                <!--Botón para regresar el menu de administrador -->

                <button type="button" onclick="window.location.href='../Vista/buscarMaterial.php'">
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