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


    $user = $_SESSION['usuario'];

    // Captura y valida el ID pasado por la URL
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    $error = $_GET['error'] ?? null;

    if (!$id) {
        echo "<p>Error: ID no proporcionado o inválido.</p>";
        exit;
    }

    // Inicializa la variable $proveedores y verifica si se ha proporcionado un ID
    $proveedores = null;
    $query = "SELECT * FROM proveedor WHERE idproveedor = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $proveedores = $result->fetch_assoc();

        if (!$proveedores) {
            echo "<p>Error: No se encontró el proveedor.</p>";
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
    <!-- Formulario de actualización de proveedor -->
    <div>
        <div class="bloque">
            <form method="POST" name="frmproveedor" id="frmproveedor" action="../Controlador/controladorProveedor.php?accion=actualizar" class="formulario">
                <h2>Actualización de proveedores</h2>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($proveedores['idproveedor']); ?>">
                <article>
                    <div>
                        <label>Proveedor </label>
                        <input type="text" name="Nomproveedor" id="Nomproveedor" placeholder="Nomproveedor" value="<?php echo htmlspecialchars($proveedores['Nomproveedor']); ?>">
                    </div>
                    <div>
                        <label>Direccion: </label>
                        <input type="text" name="direccion" id="direccion" placeholder="direccion" value="<?php echo htmlspecialchars($proveedores['direccion']); ?>">
                    </div>
                    <div>
                        <label>Contacto: </label>
                        <input type="text" name="contacto" id="contacto" placeholder="contacto" value="<?php echo htmlspecialchars($proveedores['contacto']); ?>">
                    </div>
                    <div>
                        <label>Telefono:</label>
                        <input type="text" name="telefono" id="Telefono" placeholder="telefono" value="<?php echo htmlspecialchars($proveedores['telefono']); ?>">
                    </div>
                    <div>
                        <label>Correo: </label>
                        <input type="text" name="correo" id="correo" placeholder="correo" value="<?php echo htmlspecialchars($proveedores['correo']); ?>">
                    </div>
                    <div>
                        <label>Numero de Cliente: </label>
                        <input type="text" name="numCliente" id="numCliente" placeholder="numcliente" value="<?php echo htmlspecialchars($proveedores['NoCliente']); ?>">
                    </div>
                </article>

                <!--Botón para guardar cambios-->
                <button type="submit"> Guardar cambios
                    <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
                </button>

                <!--Botón para cancelar y regresar al listado de proveedor-->
                <button type="button" onclick="window.location.href='../Vista/buscarProveedor.php';">
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