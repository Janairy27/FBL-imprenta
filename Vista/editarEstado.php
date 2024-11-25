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


    // Captura el ID pasado por la URL
    $id = $_GET['id'] ?? null;

    // Inicializa la variable $estados y verifica si se ha proporcionado un ID
    $estados = null;
    if ($id) {
        $query = "SELECT * FROM estado WHERE idestado= ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $estados = $result->fetch_assoc();

        if (!$estados) {
            echo "<p>Error: No se encontró el estado.</p>";
            exit;
        }
    } else {
        echo "<p>Error: ID no proporcionado.</p>";
        exit;
    }
    ?>
    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <strong>Error:</strong> <?php echo htmlspecialchars($_GET['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Aceptar</button>
        </div>
    <?php endif; ?>
    <!--Vista con el formulario para editar estado-->
    <div>
        <div class="bloque">
            <form method="POST" name="frmestado" id="frmestado" action="../Controlador/controladorEstado.php?accion=actualizar"
                onsubmit="return validarestado();" class="formulario">
                <h2>Registro de estados</h2>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($estados['idestado']); ?>">

                <label>Estado del pedido</label>
                <input type="text" name="estado" id="estado" placeholder="Estado del pedido" value="<?php echo htmlspecialchars($estados['estado']); ?>">

                <!--Botón para guardar cambios-->
                <button type="submit">Guardar cambios
                    <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
                </button>

                <!--Botón para cancelar y regrear a listado de empleado-->
                <button type="button" onclick="window.location.href='../Vista/Estado.php';">
                    <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
                    Cancelar</button>
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