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


    // Captura y valida el ID pasado por la URL
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $error = $_GET['error'] ?? null;
    if (!$id) {
        echo "<p>Error: ID no proporcionado o inválido.</p>";
        exit;
    }

    // Inicializa la variable $ubicaciones y verifica si se ha proporcionado un ID
    $ubicaciones = null;
    $query = "SELECT * FROM ubicacion WHERE idubicacion = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $ubicaciones = $result->fetch_assoc();

        if (!$ubicaciones) {
            echo "<p>Error: No se encontró la ubicación.</p>";
            exit;
        }
        $stmt->close();
    } else {
        echo "<p>Error en la preparación de la consulta.</p>";
        exit;
    }
    ?>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <strong>Error:</strong> <?php echo htmlspecialchars($_GET['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Aceptar</button>
        </div>
    <?php endif; ?>
    <!-- Formulario de actualización de ubicación -->
    <div>
        <div class="bloque">
            <form method="POST" name="frmubicacion" id="frmubicacion" action="../Controlador/controladorUbicacion.php?accion=actualizar" class="formulario">
                <h2>Actualización de ubicación</h2>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($ubicaciones['idubicacion']); ?>">
                <article>
                    <div>
                        <label>Mueble: </label>
                        <input type="text" name="mueble" id="mueble" placeholder="mueble" value="<?php echo htmlspecialchars($ubicaciones['mueble']); ?>">
                    </div>
                    <div>
                        <label>División 1: </label>
                        <input type="text" name="division1" id="division1" placeholder="division1" value="<?php echo htmlspecialchars($ubicaciones['division1']); ?>">
                    </div>
                    <div>
                        <label>División 2:</label>
                        <input type="text" name="division2" id="division2" placeholder="division2" value="<?php echo htmlspecialchars($ubicaciones['division2']); ?>">
                    </div>
                </article>
                <article>
                    <div>
                        <label>División 3: </label>
                        <input type="text" name="division3" id="division3" placeholder="division3" value="<?php echo htmlspecialchars($ubicaciones['division3']); ?>">
                    </div>
                </article>

                <!--Botón para guardar cambios-->
                <button type="submit"> Guardar cambios
                    <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
                </button>


                <!--Botón para cancelar y regresar al listado de ubicacion-->
                <button type="button" onclick="window.location.href='../Vista/buscarUbicacion.php';">
                    Cancelar
                    <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
                </button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<?php
} else {
    header("Location:login.php");
}
?>