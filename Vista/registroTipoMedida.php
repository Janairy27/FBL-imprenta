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

    $proceso = isset($tipomedida);
    ?>

    <body data-context="registroTipoMedida">
        <!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
                <!-- Botón de cierre manual con evento para redirigir -->
                <button type="button" class="btn-close" id="closeButton" aria-label="Close">Aceptar</button>
            </div>
        <?php endif; ?>

        <!-- Formulario de registro para tipo de medida -->


        <div class="bloque">
            <h2>Registro de Tipo de medida</h2>
            <form method="POST" name="frmTmedida" id="frmTmedida" action="../Controlador/controladorTipoMedida.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>" class="formulario">

                <?php if ($proceso):  ?>
                    <input type="hidden" name="idtipomedida" value="<?php echo $tipomedida['idtipomedida']; ?>">
                <?php endif; ?>

                <label>Tipo de medida: </label>
                <input type="text" name="nombreT" id="nombreT" placeholder="Nombre del tipo de medida" value="<?php echo $proceso ? $tipomedida['nomTipomedida'] : ''; ?>">
                <p class="alert alert-danger" id="nomT" name="nomT" style="display: none;">
                    Ingresa un nombre válido !!!
                </p>
                <label>Unidad: </label>
                <input type="text" name="unidad" id="unidad" placeholder="unidad" value="<?php echo $proceso ? $tipomedida['unidad'] : ''; ?>">
                <p class="alert alert-danger" id="uni" name="uni" style="display: none;">
                    ¡Ingresa un nombre de mueble válido !
                </p>
                <button type="submit"> Guardar
                    <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
                </button>
                <p class="alert alert-success" id="btne" name="btne" style="display: none;">Enviando datos</p>
                <script src="../Controlador/js/validaciones.js"></script>
            </form>
        </div>
        <div class="mt-3">
            <!--Botón para cancelar y regresa al listado de tipomedida-->
            <button type="button" onclick="window.location.href='../Vista/buscarTipoMedida.php'">
                Cancelar
                <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
            </button>

            <!--Botón para regresar al regstro de insumo-->
            <button type="button" onclick="window.location.href='../Vista/registroInsumo.php'">
                Regresar registro insumo
                <img src="../Vista/img/regresar.png" alt="Regresar" style="width: 30px; height: 30px;">
            </button>
        </div>
    </body>
<?php
} else {
    header("Location:login.php");
}
?>