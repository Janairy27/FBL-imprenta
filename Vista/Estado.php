<?php
include 'includes/header.php';
require_once '../Controlador/controladorEstado.php';


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



    $controlador = new controladorEstado();
    $estados = $controlador->listarEstados();
    ?>
    <!--Vista para mostrar el listad de estados y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar estados-->
    <div class="bloque">
        <h2>Listado de estados</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorEstado.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="estado">Estado de pedido</option>
                    </select>


                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!--Botón para buscar-->
                    <button type="submit">Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para mostrar todos los estados (refrescar) -->
                    <button type="submit"> Mostrar todo
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para agregar un nuevo estadp-->
                    <button type="button" onclick="window.location.href='../Vista/registroEstado.php'">
                        Agregar Estado
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">

                    </button>

                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Estado</th>
                        <th>Editar / Eliminar</th>
                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $estado): ?>
                            <tr>
                                <td><?php echo $estado['estado']; ?></td>
                                <td>
                                    <a href="../Controlador/controladorEstado.php?accion=actualizar&id=<?php echo htmlspecialchars($estado['idestado'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorEstado.php?accion=eliminar&id=<?php echo $estado['idestado']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este estado de pedido?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron estados.</td>
                        </tr>
                    <?php endif ?>
                </table>

                <!--Botón para regresar al menú de administrador-->
                <button type="button" onclick="window.location.href='../Vista/Pedido.php'">
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