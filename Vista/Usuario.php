<?php
include 'includes/header.php';
require_once '../Controlador/controladorUsuario.php';


session_start();
$user = $_SESSION['usuario'];
if (isset($_SESSION['usuario'])) {
    echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
    ?>
    <a href="../Vista/logout.php">
     <img   src="../Vista/img/logout.png" class="image">
     <p class=" posicion"> Cerrar sesion</p></a>
<?php
  

    $controlador = new controladorUsuario();
    $usuarios = $controlador->listarUsuarios();

?>
    <!--Vista para mostrar el listad de usuarios y poder buscar, 
mostrar todos (refrescar) ,agregar, eliminar y editar usuarios-->
    <div class="bloque">
        <h2>Listado de usuarios</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorUsuario.php?accion=buscar"
                    clas="formulario">
                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="usuario">Usuario</option>
                        <option value="contrasena">Contraseña</option>
                        <option value="idempleado">Empleado</option>
                    </select>

                    <input type="text" name="valor" placeholder="Ingrese el valor a buscar" require>

                    <!--Botón para buscar-->
                    <button type="submit"> Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para mostrar todos los registros (refrescar)-->
                    <button type="submit"> Actualizar
                        <img src="../Vista/img/refrescar.png" alt="Refrescar" style="width: 30px; height: 30px;">
                    </button>

                    <!--Botón para registrar un nuevo usuario-->
                    <button type="button" onclick="window.location.href='../Vista/registroUsuario.php'">
                        <img src="../Vista/img/mas.png" alt="Agregar" style="width: 30px; height: 30px;">

                    </button>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Empleado</th>
                        <th>Editar / Elimnar</th>
                    </tr>
                    <?php if (isset($resultados) && count($resultados) > 0): ?>
                        <?php foreach ($resultados as $usuario): ?>
                            <tr>
                                <td><?php echo $usuario['usuario']; ?></td>
                                <td><?php echo $usuario['contrasena']; ?></td>
                                <td><?php echo $usuario['empleado'];  ?></td>
                                <td>
                                    <a href="../Controlador/controladorUsuario.php?accion=actualizar&id=<?php echo htmlspecialchars($usuario['idusuarios'], ENT_QUOTES, 'UTF-8'); ?>"> <img src="../Vista/img/modificar.png" width="30px" height="30px"></a>
                                    <a href="../Controlador/controladorUsuario.php?accion=eliminar&id=<?php echo $usuario['idusuarios']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?');"><img src="../Vista/img/eliminar.png" width="30px" height="30px"></a>
                                </td>
                            </tr>
                        <?php endforeach ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">No se encontraron usuarios.</td>
                        </tr>
                    <?php endif ?>
                </table>

                <!--Botón para regresar al menu del administrador-->
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