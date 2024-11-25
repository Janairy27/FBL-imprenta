<?php
include 'includes/header.php';
//include '../Controlador/controladorUbicacion.php'; // Incluye la conexión a la base de datos
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

    // Inicializa la variable $materiales y verifica si se ha proporcionado un ID
    $materiales = null;
    $query = "SELECT * FROM material WHERE idmaterial = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $materiales = $result->fetch_assoc();

        if (!$materiales) {
            echo "<p>Error: No se encontró la marca.</p>";
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

    <!-- Formulario de actualización de material -->
    <div class="bloque">
        <form method="POST" name="frmMate" id="frmMate" action="../Controlador/controladorMaterial.php?accion=actualizar"
            class="formulario">
            <h2>Actualización de Material</h2>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($materiales['idmaterial']); ?>">
            <article>
                <div>
                    <label>Nombre del material: </label>
                    <input type="text" name="nombre" id="nombre" placeholder="nomMaterial" value="<?php echo htmlspecialchars($materiales['nomMaterial']); ?>">
                </div>
            </article>

            <!--Botón para guardar cambios-->
            <button type="submit"> Guardar cambios
                <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
            </button>

            <!--Botón para cancelar y regresar al listado de material-->
            <button type="button" onclick="window.location.href='../Vista/buscarMaterial.php';">
                Cancelar
                <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;"></button>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script src="js/validaciones.php"></script>
<?php
} else {
    header("Location:login.php");
}
?>