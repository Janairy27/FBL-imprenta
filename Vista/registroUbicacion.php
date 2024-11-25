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




    $proceso = isset($ubicacion);
    ?>

    <body data-context="registroUbicacion">
        <!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
                <!-- Botón de cierre manual con evento para redirigir -->
                <button type="button" class="btn-close" id="closeButton" aria-label="Close">Aceptar</button>
            </div>
        <?php endif; ?>



        <!-- Formulario de registro para ubicacion -->
        <div class="bloque">
            <h2>Registro de ubicación</h2>

            <div class="contenedor-formulario">
                <form method="POST" name="frmubicacion" id="frmubicacion" action="../Controlador/controladorUbicacion.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>" class="formulario">

                    <?php if ($proceso):  ?>
                        <input type="hidden" name="idubicacion" value="<?php echo $ubicacion['idubicacion']; ?>">
                    <?php endif; ?>

                    <label>Mueble: </label>
                    <input type="text" name="mueble" id="mueble" placeholder="Estante / Mesa" value="<?php echo $proceso ? $ubicacion['mueble'] : ''; ?>" required>
                    <p class="alert alert-danger" id="nom" name="nom" style="display: none;">
                        ¡Ingresa un nombre de mueble válido!
                    </p>

                    <label>División 1: </label>
                    <input type="text" name="division1" id="division1" placeholder="Entrapaño / Cajón" value="<?php echo $proceso ? $ubicacion['division1'] : ''; ?>" required>
                    <p class="alert alert-danger" id="div" name="div" style="display: none;">
                        ¡Ingresa un entrepaño válido!
                    </p>

                    <label>División 2: </label>
                    <input type="text" name="division2" id="division2" placeholder="Bote / Caja" value="<?php echo $proceso ? $ubicacion['division2'] : ''; ?>">
                    <p class="alert alert-warning" id="div2" name="div2" style="display: none;">
                        ¡No dejes el campo vacío, si no hay coloca Bote 0 o Caja 0!
                    </p>

                    <label>División 3: </label>
                    <input type="text" name="division3" id="division3" placeholder="Bolsa" value="<?php echo $proceso ? $ubicacion['division3'] : ''; ?>">
                    <p class="alert alert-warning" id="div3" name="div3" style="display: none;">
                        ¡No dejes el campo vacío, si no hay coloca Bolsa 0!
                    </p>
                    <br>
                    <button type="submit"> Guardar
                        <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
                    </button>
                    <p class="alert alert-success" id="btne" name="btne" style="display: none;">Enviando datos</p>
                </form>
                <script src="../Controlador/js/validaciones.js"></script>

            </div>



            <div class="mt-3">
                <!--Botón para cancelar y regresa al listado de ubicacion-->
                <button type="button" onclick="window.location.href='../Vista/buscarUbicacion.php'">
                    Cancelar
                    <img src="../Vista/img/cancelar.png" alt="Agregar" style="width: 30px; height: 30px;">
                </button>

                <button type="button" onclick="window.location.href='../Vista/registroInsumo.php'">
                    Regresar registro insumo
                    <img src="../Vista/img/regresar.png" alt="Agregar" style="width: 30px; height: 30px;">
                </button>
            </div>
        </div>
    </body>

<?php
} else {
    header("Location:login.php");
}
?>