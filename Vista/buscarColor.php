<?php
include 'includes/header.php';
require_once '../Controlador/controladorColor.php';


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


    $controlador = new controladorColor();
    $colores = $controlador->listarColores();
    ?>
    <!--Vista para mostrar el listad de colores y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar colores-->

    <div class="bloque">
        <h2>Listado de colores</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorColor.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="nomColor">Nombre</option>
                    </select>
                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!-- Botón para buscar -->
                    <button type="submit">
                        Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!-- Botón para mostrar todos los colores (refrescar) -->
                    <button type="submit">
                        Mostrar todo
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>

                    <!-- Botón para agregar un  nuevo color -->
                    <button type="button" onclick="window.location.href='../Vista/registroColor.php'">
                        Agregar Color
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>

                    <!-- Botón para ver el listado transparencia -->
                    <button type="button" onclick="window.location.href='../Vista/buscarTransparencia.php'">
                        Transparencia
                        <img src="../Vista/img/transparencia.png" alt="Transparencia" style="width: 30px; height: 30px;">
                    </button>
                    <!-- Botón para ver el listado de Acabado Superficial -->
                    <button type="button" onclick="window.location.href='../Vista/buscarAcabadoSuperficial.php'">
                        Superficial
                        <img src="../Vista/img/textura.png" alt="Acabado" style="width: 30px; height: 30px;">
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
                        <?php foreach ($resultados as $color): ?>
                            <tr>
                                <td><?php echo $color['nomColor']; ?></td>

                                <td>
                                    <a href="../Controlador/controladorColor.php?accion=actualizar&id=<?php echo htmlspecialchars($color['idcolor'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorColor.php?accion=eliminar&id=<?php echo $color['idcolor']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este color?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron colores.</td>
                        </tr>
                    <?php endif ?>
                </table>

                <!-- Botón para regresar al menu de administrador -->
                <button type="button" onclick="window.location.href='../Vista/administrador.php'">
                    <img src="../Vista/img/regresar.png" alt="Agregar" style="width: 30px; height: 30px;">
                    Regresar
                </button>

            </div>
    </div>

<?php
} else {
    header("Location:login.php");
}
?>