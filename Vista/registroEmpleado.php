<?php
include 'includes/header.php';


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



    $proceso = isset($empleado);
    ?>

    <body data-context="registroEmpleado">
        <!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
                <!-- Botón de cierre manual con evento para redirigir -->
                <button type="button" class="btn-close" id="closeButton" aria-label="Close">Aceptar</button>
            </div>
        <?php endif; ?>

        <!-- Formulario de registro de empleado -->

        <div class="bloque">
            <h2>Registro de empleados</h2>
            <form method="POST" name="frmempleado" id="frmempleado" action="../Controlador/controladorEmpleado.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>"
                class="formulario">

                <?php if ($proceso):  ?>
                    <input type="hidden" name="id" value="<?php echo $empleado['idempleado']; ?>">
                <?php endif; ?>

                <label>Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $proceso ? $empleado['nomb'] : ''; ?>">
                <p class="alert alert-danger" id="no" name="no" style="display: none;">
                    Favor de ingresar un Nombre válido
                </p>

                <label>Apellido paterno</label>
                <input type="text" name="apaterno" id="apaterno" placeholder="Apellido paterno" value="<?php echo $proceso ? $empleado['apaterno'] : ''; ?>">
                <p class="alert alert-danger" id="apat" name="apat" style="display: none;">
                    Favor de ingresar un Apellido paterno válido
                </p>

                <label>Apellido materno</label>
                <input type="text" name="amaterno" id="amaterno" placeholder="Apellido materno" value="<?php echo $proceso ? $empleado['amaterno'] : ''; ?>">
                <p class="alert alert-danger" id="amat" name="amat" style="display: none;">
                    Favor de ingresar un Apellido materno válido
                </p>

                <label>Fecha de nacimiento</label>
                <input type="date" name="nacimiento" id="nacimiento" placeholder="YYYY-MM-DD" value="<?php echo $proceso ? $empleado['fecnaci'] : ''; ?>">
                <p class="alert alert-danger" id="fec" name="fec" style="display: none;">
                    Favor de ingresar la fecha en el formato AAAA-MM-DD
                </p>

                <label>Dirección</label>
                <input type="text" name="direccion" id="direccion" placeholder="Dirección" value="<?php echo $proceso ? $empleado['direccion'] : ''; ?>">
                <p class="alert alert-danger" id="dir" name="dir" style="display: none;">
                    Favor de ingresar una dirección válida
                </p>

                <label>Numero telefonico</label>
                <input type="text" name="telefono" id="telefono" placeholder="Teléfono" value="<?php echo $proceso ? $empleado['telefono'] : ''; ?>"
                    onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }" maxlength="10">
                <p class="alert alert-danger" id="tel" name="tel" style="display: none;">
                    Favor de ingresar un número teléfonico valido
                </p>

                <label>Correo electronico</label>
                <input type="text" name="correo" id="correo" placeholder="Correo" value="<?php echo $proceso ? $empleado['correo'] : ''; ?>">
                <p class="alert alert-danger" id="cor" name="cor" style="display: none;">
                    Favor de ingresar una dirección de correo válida
                </p>

                <label>Rol empresarial</label>
                <input type="text" name="rol" id="rol" placeholder="Rol empresarial" value="<?php echo $proceso ? $empleado['rol'] : ''; ?>">
                <p class="alert alert-danger" id="empre" name="empre" style="display: none;">
                    Favor de ingresar un rol empresarial válido
                </p>

                <button type="submit">Guardar
                    <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">

                </button>
                <p class="alert alert-success" id="btne" name="btne" style="display: none;">Enviando datos</p>
                <script src="../Controlador/js/validaciones.js"></script>
            </form>
        </div>
        <!--Botón para cancelar y regresa al listado de empleado-->
        <button type="button" onclick="window.location.href='../Vista/buscarEmpleado.php'">
            Cancelar
            <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
        </button>
    </body>
<?php
} else {
    header("Location:login.php");
}
?>