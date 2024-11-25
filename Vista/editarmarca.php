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

// Inicializa la variable $marcas y verifica si se ha proporcionado un ID
$marcas = null;
$query = "SELECT * FROM marca WHERE idmarca = ?";
$stmt = $conn->prepare($query);
if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $marcas = $result->fetch_assoc();

    if (!$marcas) {
        echo "<p>Error: No se encontró la marca.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p>Error en la preparación de la consulta.</p>";
    exit;
}
?>

<!-- Formulario de actualización de marca -->
<div>
    <div class="bloque">
        <form method="POST" name="frmmarca" id="frmmarca" action="../Controlador/controladorMarca.php?accion=actualizar" class="formulario">
            <h2>Actualización de marca</h2>
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($marcas['idmarca']); ?>">
            <article>
                <div>
                    <label>Marca: </label>
                    <input type="text" name="nombre" id="nombre" placeholder="nomMarca" value="<?php echo htmlspecialchars($marcas['nomMarca']); ?>">

                    <label>Descripción: </label>
                    <input type="text" name="descripcion" id="descripcion" placeholder="descripcion" value="<?php echo htmlspecialchars($marcas['descripcion']); ?>">

                </div>
            </article>

            <!--Botón para guardar cambios -->
            <button type="submit">Guardar cambios
                <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
                <!--Guardar cambios-->
            </button>

            <!--Botón para cancelar y regresar al listado de marcas-->
            <button type="button" onclick="window.location.href='../Vista/buscarMarca.php';">
                <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
                Cancelar</button>

        </form>
    </div>
</div>

<script src="js/validaciones.php"></script>
<?php
} else {
    header("Location:login.php");
}
?>