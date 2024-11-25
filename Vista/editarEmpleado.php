<?php
include 'includes/header.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $user = $_SESSION['usuario'];
    echo "<h1 class='logout'>Usuario:  " . htmlspecialchars($user) . "</h1>";
?>
    <a href="../Vista/logout.php">
        <img src="../Vista/img/logout.png" class="image">
        <p class="posicion">Cerrar sesión</p>
    </a>

    <?php
    // Captura el ID pasado por la URL
    $id = isset($_GET['id']) ? intval($_GET['id']) : null;
    $error = $_GET['error'] ?? null;


    // Inicializa la variable $empleados y verifica si se ha proporcionado un ID
    $empleados = null;
    if ($id) {
        $query = "SELECT * FROM empleado WHERE idempleado= ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $empleados = $result->fetch_assoc();

        if (!$empleados) {
            echo "<p>Error: No se encontró el empleado.</p>";
            exit;
        }
    } else {
        echo "<p>Error: ID no proporcionado.</p>";
        exit;
    }
    ?>


    <!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            <strong>Error:</strong> <?php echo htmlspecialchars($_GET['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Aceptar</button>
        </div>
    <?php endif; ?>



    <!--Vista con el formulario para editar empleado-->
    <div>
        <div class="bloque">
            <form method="POST" name="frmempleado" id="frmempleado" action="../Controlador/controladorEmpleado.php?accion=actualizar" class="formulario">
                <h2>Actualización de empleados</h2>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($empleados['idempleado']); ?>">

                <label>Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo htmlspecialchars($empleados['nomb']); ?>">

                <label>Apellido paterno</label>
                <input type="text" name="apaterno" id="apaterno" placeholder="Apellido paterno" value="<?php echo htmlspecialchars($empleados['apaterno']); ?>">

                <label>Apellido materno</label>
                <input type="text" name="amaterno" id="amaterno" placeholder="Apellido materno" value="<?php echo htmlspecialchars($empleados['amaterno']); ?>">

                <label>Fecha de nacimiento</label>
                <input type="text" name="nacimiento" id="nacimiento" placeholder="YYYY-MM-DD" value="<?php echo htmlspecialchars($empleados['fecnaci']); ?>">

                <label>Dirección</label>
                <input type="text" name="direccion" id="direccion" placeholder="Dirección" value="<?php echo htmlspecialchars($empleados['direccion']); ?>">

                <label>Numero telefónico</label>
                <input type="text" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo htmlspecialchars($empleados['telefono']); ?>">

                <label>Correo electrónico</label>
                <input type="text" name="correo" id="correo" placeholder="Correo" value="<?php echo htmlspecialchars($empleados['correo']); ?>">

                <label>Rol empresarial</label>
                <input type="text" name="rol" id="rol" placeholder="Rol empresarial" value="<?php echo htmlspecialchars($empleados['rol']); ?>">

                <button type="submit">Guardar cambios
                    <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
                </button>

                <button type="button" onclick="window.location.href='../Vista/buscarEmpleado.php';">
                    <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
                    Cancelar
                </button>

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<?php
} else {
    header("Location:login.php");
    exit;
}
?>