<?php
include 'includes/header.php';
require_once '../Controlador/controladorMarca.php';
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


    $controlador = new controladorMarca();
    $marcas = $controlador->listarMarcas();
    ?>

    <!--Vista para mostrar el listado de marcas y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar marcas-->

    <div class="bloque">
        <h2>Listado de marcas</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorMarca.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="nomMarca">Nombre</option>
                        <option value="descripcion">Descripción</option>
                    </select>
                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!--  Botón para buscar -->
                    <button type="submit"> Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!-- Botón para mostrar todos (refrescar) -->
                    <button type="submit"> Mostrar todo
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>

                    <!-- Botón para agregar uuna nueva marca -->
                    <button type="button" onclick="window.location.href='../Vista/registrarMarca.php'">
                        Agregar Marca
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Editar / Eliminar</th>

                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $marca): ?>
                            <tr>
                                <td><?php echo $marca['nomMarca']; ?></td>
                                <td><?php echo $marca['descripcion']; ?></td>

                                <td>
                                    <a href="../Controlador/controladorMarca.php?accion=actualizar&id=<?php echo htmlspecialchars($marca['idmarca'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorMarca.php?accion=eliminar&id=<?php echo $marca['idmarca']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta marca?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron marcas.</td>
                        </tr>
                    <?php endif ?>
                </table>

                <!-- Botón para regresar al menu de administrador -->
                <button type="button" onclick="window.location.href='../Vista/buscarProveedor.php'">
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