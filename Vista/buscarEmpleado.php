<?php
include 'includes/header.php';
require_once '../Controlador/controladorEmpleado.php';
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

    $controlador = new controladorEmpleado();
    $empleados = $controlador->listarEmpleados();
    ?>

    <!--Vista para mostrar el listad de empleados y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar empleados-->


    <div class="bloque">
        <h2>Listado de empleados</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorEmpleado.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="nomb">Nombre</option>
                        <option value="apaterno">Apellido paterno</option>
                        <option value="direccion">Dirección</option>
                        <option value="telefono">Número teléfonico</option>
                        <option value="correo">Correo electronico</option>
                    </select>
                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!-- Botón para buscar -->
                    <button type="submit">Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!-- Botón para mostrar todos los empleados (refrescar) -->
                    <button type="submit">
                        Mostrar todo
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>

                    <!-- Botón para agregar un nuevo empleado -->
                    <button type="button" onclick="window.location.href='../Vista/registroEmpleado.php'">
                        Agregar empleado
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">
                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Nombre</th>
                        <th>Apellido paterno</th>
                        <th>Apellido materno</th>
                        <th>Fecha de nacimiento</th>
                        <th>Dirección</th>
                        <th>Numero telefonico</th>
                        <th>Correo electronico</th>
                        <th>Rol empresarial</th>
                        <th>Editar / Eliminar</th>
                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $empleado): ?>
                            <tr>
                                <td><?php echo $empleado['nomb']; ?></td>
                                <td><?php echo $empleado['apaterno']; ?></td>
                                <td><?php echo $empleado['amaterno']; ?></td>
                                <td><?php echo $empleado['fecnaci']; ?></td>
                                <td><?php echo $empleado['direccion']; ?></td>
                                <td><?php echo $empleado['telefono']; ?></td>
                                <td><?php echo $empleado['correo']; ?></td>
                                <td><?php echo $empleado['rol']; ?></td>
                                <td>
                                    <a href="../Controlador/controladorEmpleado.php?accion=actualizar&id=<?php echo htmlspecialchars($empleado['idempleado'], ENT_QUOTES, 'UTF-8'); ?>"><img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorEmpleado.php?accion=eliminar&id=<?php echo $empleado['idempleado']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este empleado?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">No se encontraron empleado.</td>
                        </tr>
                    <?php endif ?>
                </table>


            </div>

            <!-- Botón para regresar al menu de administrador-->
            <button type="button" onclick="window.location.href='../Vista/administrador.php'">
                Regresar
                <img src="../Vista/img/regresar.png" alt="Regresar" style="width: 30px; height: 30px;">
            </button>
    </div>

<?php
} else {
    header("Location:login.php");
}
?>