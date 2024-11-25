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



    $proceso = isset($presentacion);
    ?>

    <body data-context="registroPresentacion">
        <!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
                <!-- Botón de cierre manual con evento para redirigir -->
                <button type="button" class="btn-close" id="closeButton" aria-label="Close">Aceptar</button>
            </div>
        <?php endif; ?>

        <!--Formulario de reistro para presentacion-->
        <div class="bloque">
            <div class="row">
                <h2>Registro de presentación</h2>
                <form method="POST" name="frmPrese" id="frmPrese" action="../Controlador/controladorPresentacion.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>"
                    class="formulario">

                    <?php if ($proceso):  ?>
                        <input type="hidden" name="idpresentacion" value="<?php echo $presentacion['idpresentacion']; ?>">
                    <?php endif; ?>

                    <label class="">Presentación: </label>
                    <input type="text" name="nombre" id="nombre" placeholder="Descripcion de la presentacion"
                        value="<?php echo $proceso ? $presentacion['nomPresentacion'] : ''; ?>" class="form-control">
                    <p class="alert alert-danger" id="nom" name="nom" style="display: none;">
                        Ingresa un nombre válido !!!
                    </p>
                    <button type="submit" onclick="validacionPresentacion()">Guardar
                        <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
                        <!--Enviar Datos-->
                    </button>
                    <p class="alert alert-success" id="btne" name="btne" style="display: none;">Enviando datos</p>
                    <script src="../Controlador/js/validaciones.js"></script>
                </form>
            </div>
            <div class="mt-3">
                <!--Botón para cancelar y regresa al listado de presentacion-->
                <button type="button" onclick="window.location.href='../Vista/buscarPresentacion.php'">
                    Cancelar
                    <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
                </button>

                <!--Botón para regresar al regstro de insumo-->
                <button type="button" onclick="window.location.href='../Vista/registroInsumo.php'">
                    Regresar registro insumo
                    <img src="../Vista/img/regresar.png" alt="Regresar" style="width: 30px; height: 30px;">
                </button>
            </div>
            </di>
    </body>
<?php
} else {
    header("Location:login.php");
}
?>