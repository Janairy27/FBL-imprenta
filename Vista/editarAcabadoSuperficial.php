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
  
$user = $_SESSION['usuario'];

// Captura y valida el ID pasado por la URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo "<p>Error: ID no proporcionado o inválido.</p>";
    exit;
}

// Inicializa la variable $acabados y verifica si se ha proporcionado un ID
$acabados = null;
$query = "SELECT * FROM acabado WHERE idacabado = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $acabados = $result->fetch_assoc();

    if (!$acabados) {
        echo "<p>Error: No se encontró el acabado.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p>Error en la preparación de la consulta.</p>";
    exit;
}
?>

<!-- Formulario de actualización de acabado -->
<div>
    <div class="bloque">

        <form method="POST" name="frmacabado" id="frmacabado" action="../Controlador/controladorAcabadoSuperficial.php?accion=actualizar"
            class="formulario ">
            <h2>Actualización de acabado superficial</h2>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($acabados['idacabado']); ?>">
            <article>
                <div>
                    <label>Acabado: </label>
                    <input type="text" name="nombreA" id="nombreA" placeholder="nomAcabado" value="<?php echo htmlspecialchars($acabados['nomAcabado']); ?>">
                </div>
            </article>

            <!-- Botón para guardar la informacion del formulario -->
            <button type="submit"> Guardar cambios
                <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
            </button>

            <!-- Botón para cancelar y regresar al listado -->
            <button type="button" onclick="window.location.href='../Vista/buscarAcabadoSuperficial.php';">
                Cancelar
                <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
            </button>
        </form>
    </div>
</div>

<script src="js/validaciones.php"></script>
<?php
} else {
    header("Location:login.php");
}
?>