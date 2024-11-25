<?php
include 'includes/header.php';
include '../Controlador/controladorUsuario.php';



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

    $proceso = isset($usuario);
    $controlador = new controladorUsuario();
    $empleados = $controlador->obtenerListaEmpleados();

    ?>

    <body data-context="registroUsuario">
        <!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
                <!-- Botón de cierre manual con evento para redirigir -->
                <button type="button" class="btn-close" id="closeButton" aria-label="Close">Aceptar</button>
            </div>
        <?php endif; ?>

        <!-- Formulario de registro de usuario-->

        <div class="bloque">
            <h2>Registro de usuarios</h2>
            <form method="POST" name="frmusuario" id="frmusuario" action="../Controlador/controladorUsuario.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>"
                onsubmit="return validarusuario();" class="formulario">

                <?php if ($proceso):  ?>
                    <input type="hidden" name="id" value="<?php echo $usuario['idusuarios']; ?>">
                <?php endif; ?>

                <label>Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $proceso ? $usuario['usuario'] : ''; ?>">
                <p class="alert alert-danger" id="us" name="us" style="display: none;">
                    Favor de llenar el campo
                </p>

                <label>Contraseña</label>
                <input type="text" name="contrasena" id="contrasena" placeholder="Contraseña" value="<?php echo $proceso ? $usuario['contrasena'] : ''; ?>">
                <p class="alert alert-danger" id="cont" name="cont" style="display: none;">
                    Favor de llenar el campo
                </p>

                <label>Empleado al que corresponderá el inicio de sesión</label>
                <select name="idempleado" id="idempleado">
                    <option value="">Seleccionar:</option>
                    <?php foreach ($empleados as $empleado): ?>
                        <option value="<?php echo $empleado['idempleado']; ?>">
                            <?php echo $empleado['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <button type="submit">
                    Guardar
                    <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;"></button>
                <p class="alert alert-success" id="btn" name="btn" style="display: none;">
                    Procesando datos
                </p>
                <script src="../Controlador/js/validaciones.js"></script>
            </form>
            <!--Botón para cancelar y regresa al listado de usuarios-->
            <button type="button" onclick="window.location.href='../Vista/Usuario.php'">
                Cancelar
                <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
            </button>
        </div>

    </body>
<?php
} else {
    header("Location:login.php");
}
?>