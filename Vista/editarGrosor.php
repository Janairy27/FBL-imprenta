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

    // Inicializa la variable $grosores y verifica si se ha proporcionado un ID
    $grosores = null;
    $query = "SELECT * FROM grosor WHERE idgrosor = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $grosores = $result->fetch_assoc();

        if (!$grosores) {
            echo "<p>Error: No se encontró el grosor.</p>";
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

    <!-- Formulario de actualización de grsor-->
    <div class="bloque">
        <form method="POST" name="frmgrosor" id="frmgrosor" action="../Controlador/controladorGrosor.php?accion=actualizar"
            class="formulario">
            <h2>Actualización de grosor</h2>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($grosores['idgrosor']); ?>">
            <article>
                <div>
                    <label>Grosor: </label>
                    <input type="text" name="cantGrosor" id="cantGrosor" placeholder="cantGrosor" value="<?php echo htmlspecialchars($grosores['cantGrosor']); ?>">
                    <label>Unidad de Medida </label>
                    <input type="text" name="unidadMedida" id="unidadMedida" placeholder="unidadMedida" value="<?php echo htmlspecialchars($grosores['unidadMedida']); ?>">
                    <label>Flexibilidad </label>
                    <input type="text" name="flexibilidad" id="flexibilidad" placeholder="flexibilidad" value="<?php echo htmlspecialchars($grosores['flexibilidad']); ?>">
                </div>
            </article>

            <!--Botón para guardar cambios-->
            <button type="submit"> Guardar cambios
                <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
            </button>

            <!--Botón para cancelar y regresar al listado de grosor-->
            <button type="button" onclick="window.location.href='../Vista/buscarGrosor.php';">
                <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
                Cancelar</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<?php
} else {
    header("Location:login.php");
}
?>