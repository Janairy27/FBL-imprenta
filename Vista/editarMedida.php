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

// Inicializa la variable $medidas y verifica si se ha proporcionado un ID
$medidas = null;
$query = "SELECT * FROM medida WHERE idmedida = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $medidas = $result->fetch_assoc();

    if (!$medidas) {
        echo "<p>Error: No se encontró la meddia.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p>Error en la preparación de la consulta.</p>";
    exit;
}
?>

<!-- Formulario de actualización de medida -->
<div>
    <div class="bloque">
        <form method="POST" name="frmMedi" id="frmMedi" action="../Controlador/controladorMedida.php?accion=actualizar" class="formulario">
            <h2>Actualización de medida</h2>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($medidas['idmedida']); ?>">
            <div>
                <label>Largo: </label>
                <input type="text" name="largo" id="largo" placeholder="largo" value="<?php echo htmlspecialchars($medidas['largo']); ?>"
                onkeypress="
        // Permitir teclas numéricas (0-9) y un solo punto decimal
        var key = event.key;
        if ((key >= '0' && key <= '9') || key === '.' || event.keyCode === 8) {
            return true; // Permitir números y el punto
        } else {
            event.preventDefault(); // Bloquear otras teclas
        }
    ">
            </div>
            <div>
                <label>Ancho:</label>
                <input type="text" name="ancho" id="ancho" placeholder="ancho" value="<?php echo htmlspecialchars($medidas['ancho']); ?>"
                onkeypress="
        // Permitir teclas numéricas (0-9) y un solo punto decimal
        var key = event.key;
        if ((key >= '0' && key <= '9') || key === '.' || event.keyCode === 8) {
            return true; // Permitir números y el punto
        } else {
            event.preventDefault(); // Bloquear otras teclas
        }
    ">
            </div>

            </article>
            <!--Botónn para guardar cambios-->
            <button type="submit"> Guardar cambios
                <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
            </button>

            <!--Botón para cancelar y regresar al listado de medida-->

            <button type="button" onclick="window.location.href='../Vista/buscarMedida.php';">
                Cancelar
                <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;"></button>





        </form>
    </div>
</div>

<script src="js/validaciones.php"></script>
<?php
} else {
    header("Location:login.php");
}
?>