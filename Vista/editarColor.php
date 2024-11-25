<?php
include 'includes/header.php';
session_start();
$user = $_SESSION['usuario'];
if (isset($_SESSION['usuario'])) {
    echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
    ?>
    <a href="../Vista/logout.php">
     <img   src="../Vista/img/logout.png" class="image">
     <p class=" posicion"> Cerrar sesion</p></a>
<?php
  

// Captura y valida el ID pasado por la URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo "<p>Error: ID no proporcionado o inválido.</p>";
    exit;
}

// Inicializa la variable $colores y verifica si se ha proporcionado un ID
$colores = null;
$query = "SELECT * FROM color WHERE idcolor = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $colores = $result->fetch_assoc();

    if (!$colores) {
        echo "<p>Error: No se encontró el color.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p>Error en la preparación de la consulta.</p>";
    exit;
}
?>

<!-- Formulario de actualización de color -->
<div class="bloque">
    <div class="row">
        <form method="POST" name="frmcolor" id="frmcolor" action="../Controlador/controladorColor.php?accion=actualizar"
            class="formulario col-lg-12 d-flex justify-content-center">
            <h2 class="col-sm-4 col-form-label">Actualización de color</h2>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($colores['idcolor']); ?>">
            <article>
                <div>
                    <label>Color: </label>
                    <input type="text" name="nombre" id="nombre" placeholder="nomColor" value="<?php echo htmlspecialchars($colores['nomColor']); ?>">
                </div>
            </article>

            <!-- Botón para guardar cambios del formulario -->
            <button type="submit">Guardar cambios
                <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
            </button>

            <!-- Botón para cancelar y regresar al listado de color-->
            <button type="button" onclick="window.location.href='../Vista/buscarColor.php';">
                <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
                Cancelar</button>
        </form>
        </form>
    </div>
</div>

<script src="js/validaciones.php"></script>
<?php
} else {
    header("Location:login.php");
}
?>