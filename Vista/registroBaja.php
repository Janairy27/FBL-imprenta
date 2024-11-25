<?php
include 'includes/header.php';
include '../Controlador/controladorBaja.php';

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



    // Obtener el usuario de la sesión
    $user = $_SESSION['usuario'];

    // Instanciar el controlador de bajas
    $controlador = new controladorBaja();

    // Obtener listas de insumos y empleados
    $insumos = $controlador->obtenerListaInsumos();
    $empleados = $controlador->obtenerListaEmpleados();

    // Manejar errores en la URL
    $error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
    $proceso = isset($baja);
    ?>

    <body data-context="registroBaja">
        <!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
                <!-- Botón de cierre manual con evento para redirigir -->
                <button type="button" class="btn-close" id="closeButton" aria-label="Close">Aceptar</button>
            </div>
        <?php endif; ?>


        <!-- Formulario para registrar bajas-->

        <div class="bloque">
            <h2>Registro de baja</h2>
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" name="frmbaja" id="frmbaja" action="../Controlador/controladorBaja.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>"
                class="formulario">

                <?php if ($proceso):  ?>
                    <input type="hidden" name="id" value="<?php echo $baja['idbaja']; ?>">
                <?php endif; ?>

                <label>Cantidad: </label>
                <input type="text" name="cantBaja" id="cantBaja" placeholder="Cantidad de insumos" value="<?php echo $proceso ? $baja['cantBaja'] : ''; ?>"
                    onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">
                <p class="alert alert-danger" id="cant" name="cant" style="display: none;">
                    Favor de llenar el campo
                </p>

                <label>Fecha de baja: </label>
                <input type="date" name="fechabaja" id="fechabaja" placeholder="YYYY-MM-DD" value="<?php echo $proceso ? $baja['fechabaja'] : ''; ?>">
                <p class="alert alert-danger" id="fecha" name="fecha" style="display: none;">
                    Favor de llenar el campo
                </p>


                <label>Motivo de la baja: </label>
                <input type="text" name="motivo" id="motivo" placeholder="Motivo de la baja" value="<?php echo $proceso ? $baja['motivo'] : ''; ?>">
                <p class="alert alert-danger" id="mot" name="mot" style="display: none;">
                    Favor de llenar el campo
                </p>

                <label>Insumo al que se hara la baja</label>
                <select name="idinsumos" id="idinsumos">
                    <option value="">Seleccionar:</option>
                    <?php foreach ($insumos as $insumo): ?>
                        <option value="<?php echo $insumo['idinsumos']; ?>">
                            <?php echo $insumo['insumos']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="alert alert-danger" id="insu" name="insu" style="display: none;">
                    Favor de seleccionar un insumo
                </p>

                <label>Empleado el que hara la baja</label>
                <select name="idempleado" id="idempleado">
                    <option value="">Seleccionar:</option>
                    <?php foreach ($empleados as $empleado): ?>
                        <option value="<?php echo $empleado['idempleado']; ?>">
                            <?php echo $empleado['nombre']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="alert alert-danger" id="emp" name="emp" style="display: none;">
                    Favor de seleccionar un empleado
                </p>

                <button type="submit">Guardar
                    <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
                </button>
                <p class="alert alert-success" id="btne" name="btne" style="display: none;">
                    Procesando datos
                </p>
                <script src="../Controlador/js/validaciones.js"></script>
            </form>
            <div class="mt-3">
                <!--Botón para cancelar y regresa al listado de baja-->
                <button type="button" onclick="window.location.href='../Vista/buscarBaja.php'">
                    Cancelar
                    <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
                </button>
            </div>
        </div>
    </body>
<?php
} else {
    header("Location:login.php");
}
?>