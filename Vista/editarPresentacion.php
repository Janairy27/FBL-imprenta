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

// Inicializa la variable $presentaciones y verifica si se ha proporcionado un ID
$presentaciones = null;
$query = "SELECT * FROM presentacion WHERE idpresentacion = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $presentaciones = $result->fetch_assoc();

    if (!$presentaciones) {
        echo "<p>Error: No se encontró la presentacion.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p>Error en la preparación de la consulta.</p>";
    exit;
}
?>

<!-- Formulario de actualización de presentación -->
<div class="bloque">
    <form method="POST" name="frmPresen" id="frmPresen" action="../Controlador/controladorPresentacion.php?accion=actualizar"
        class="formulario">
        <h2>Actualización de presentación</h2>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($presentaciones['idpresentacion']); ?>">
        <article>
            <div>
                <label>Presentación en la que viene el insumo: </label>
                <input type="text" name="nombre" id="nombre" placeholder="nomPresentacion" value="<?php echo htmlspecialchars($presentaciones['nomPresentacion']); ?>">
            </div>
        </article>

        <!--Botón para guardar cambios-->
        <button type="submit"> Guardar cambios
            <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
        </button>

        <!--Botón para cancelar y regresar al listado de presentacion-->
        <button type="button" onclick="window.location.href='../Vista/buscarPresentacion.php';">
            Cancelar
            <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
        </button>
    </form>

</div>

<script src="js/validaciones.php"></script>
<?php
} else {
    header("Location:login.php");
}
?>