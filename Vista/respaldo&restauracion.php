<?php include 'includes/header.php';
include '../Controlador/controladorRestauracion.php';

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

    $restauracion = new controladorRestauracion();
    $respaldos = $restauracion->obtenerRespaldos();
    $mensajes = $restauracion->obtenerMensajes();

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Respaldo y restauración</title>
        <script>
            // Validaciones JavaScript
            function validarFormulario() {
                var respaldoSelect = document.getElementById("archivoRespaldo");
                if (respaldoSelect.value == "") {
                    alert("Por favor, seleccione un archivo de respaldo.");
                    return false;
                }
                return true;
            }
        </script>
    </head>

    <body>
        <div class="contenedor-formulario">
            <h1>Respaldo y restauración de Base de Datos</h1>


            <?php if (isset($_GET['message']) && isset($_GET['type'])): ?>
                <div class="alert alert-<?= htmlspecialchars($_GET['type']) ?>" role="alert">
                    <?= htmlspecialchars($_GET['message']) ?>
                </div>
            <?php endif; ?>

            <!-- Formulario para realizar respaldo -->
            <form action="../Modelo/respaldo.php" method="POST">
                <button type="submit" name="btne">Realizar Respaldo</button>
            </form>

            <!-- Formulario para restauración -->
            <form action="../Controlador/controladorRestauracion.php" method="POST" onsubmit="return validarFormulario()">
                <div class="mb-3">
                    <label for="archivoRespaldo" class="form-label">Seleccionar un respaldo para restaurar</label>
                    <select class="form-select" name="archivoRespaldo" id="archivoRespaldo">
                        <option value="">Seleccione un archivo</option>
                        <?php foreach ($respaldos as $archivo): ?>
                            <option value="<?= htmlspecialchars($archivo) ?>"><?= htmlspecialchars(basename($archivo)) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" name="btn">Restaurar</button>
                </div>

            </form>
        </div>
        </div>
        </div>





        <!-- Botón para regresar -->
        <button type="button" onclick="window.location.href='../Vista/administrador.php'">
            <img src="../Vista/img/regresar.png" alt="Regresar" style="width: 30px; height: 30px;">
            Regresar
        </button>
        </div>
    </body>

    </html>

<?php
} else {
    header("Location:login.php");
}
?>