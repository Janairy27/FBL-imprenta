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

    // Inicializa la variable $transparencias y verifica si se ha proporcionado un ID
    $transparencias = null;
    $query = "SELECT * FROM transparencia WHERE idtransparencia = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $transparencias = $result->fetch_assoc();

        if (!$transparencias) {
            echo "<p>Error: No se encontró la transparencias.</p>";
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
    <!-- Formulario de a

<!-- Formulario de actualización de transparencia -->
    <div class="bloque">
        <div class="row">
            <form method="POST" name="frmTrasnparencias" id="frmTransparencias" action="../Controlador/controladorTransparencia.php?accion=actualizar"
                class="formulario ">
                <h2>Actualización de transparencia</h2>
                <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($transparencias['idtransparencia']); ?>">
                <article>
                    <div>
                        <label>Transparencia: </label>
                        <input type="text" name="nombreT" id="nombreT" placeholder="nombret" value="<?php echo htmlspecialchars($transparencias['nomTransparencia']); ?>">
                    </div>
                </article>
                <!--Botón para guardar camabios-->
                <button type="submit"> Guardar camabios
                    <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
                </button>

                <!--Botón para cancelar y regresar al listado de transparencia--->
                <button type="button" onclick="window.location.href='../Vista/buscarTransparencia.php';">
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