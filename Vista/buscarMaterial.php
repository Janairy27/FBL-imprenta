<?php
include 'includes/header.php';
require_once '../Controlador/controladorMaterial.php';
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


    $controlador = new controladorMaterial();
    $materiales = $controlador->listarMateriales();
    ?>

    <!--Vista para mostrar el listado de materiales y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar materiales -->

    <div class="bloque">
        <h2>Listado de materiales</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorMaterial.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="nomMaterial">Nombre material</option>
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

                    <!-- Boto para agregar un neuvo material-->

                    <button type="button" onclick="window.location.href='../Vista/registrarMaterial.php'">
                        Agregar Material
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>

                    <!-- Botoón que ayuda para agrear un nuevo submaterial, este boton direcciona para 
     poder ver la vista de buscar submaterial-->
                    <button type="button" onclick="window.location.href='../Vista/buscarSubMaterial.php'">
                        Submaterial
                        <img src="../Vista/img/submaterial.png" alt="SubMaterial" style="width: 30px; height: 30px;">
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Material</th>
                        <th>Editar / Eliminar</th>

                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $material): ?>
                            <tr>
                                <td><?php echo $material['nomMaterial']; ?></td>
                                <td>
                                    <a href="../Controlador/controladorMaterial.php?accion=actualizar&id=<?php echo htmlspecialchars($material['idmaterial'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorMaterial.php?accion=eliminar&id=<?php echo $material['idmaterial']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este submaterial?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron materiales.</td>
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