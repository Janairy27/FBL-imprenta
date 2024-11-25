<?php
include 'includes/header.php';
require_once '../Controlador/controladorBaja.php';

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

    $controlador = new controladorBaja();
    $bajas = $controlador->listarBajas();

    ?>
    <!--Vista para mostrar el listad de las bajas y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar bajas --></div>
    <div class="bloque">
        <h2>Listado de bajas</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorBaja.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="cantBaja">Cantidad</option>
                        <option value="fechabaja">Fecha de la baja</option>
                        <option value="motivo">Motivo</option>
                        <option value="idinsumos">Insumos</option>
                        <option value="idempleado">Empleado</option>
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

                    <!-- Boton para registrar una nueva baja  -->
                    <button type="button" onclick="window.location.href='../Vista/registroBaja.php'">
                        Agregar baja
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Cantidad</th>
                        <th>Fecha de la baja</th>
                        <th>Motivo</th>
                        <th>Insumo</th>
                        <th>Empleado</th>
                        <th>Editar / Elimnar</th>
                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $baja): ?>
                            <tr>
                                <td><?php echo $baja['cantBaja']; ?></td>
                                <td><?php echo $baja['fechaBaja']; ?></td>
                                <td><?php echo $baja['motivo']; ?></td>
                                <td><?php echo $baja['insumos'];  ?></td>
                                <td><?php echo $baja['nombre'];  ?></td>
                                <td>
                                    <a href="../Controlador/controladorBaja.php?accion=actualizar&id=<?php echo htmlspecialchars($baja['idbaja'], ENT_QUOTES, 'UTF-8'); ?>"> <img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorBaja.php?accion=eliminar&id=<?php echo $baja['idbaja']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar esta baja?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron bajas.</td>
                        </tr>
                    <?php endif ?>
                </table>
                <!-- Botón para regresar al menu del administrador  -->
                <button type="button" onclick="window.location.href='../Vista/administrador.php'">
                    Regresar
                    <img src="../Vista/img/regresar.png" alt="Regresar" style="width: 30px; height: 30px;">
                </button>
            </div>
    </div>

<?php
} else {
    header("Location:login.php");
}
?>