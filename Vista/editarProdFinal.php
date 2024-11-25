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
  

    // Captura el ID pasado por la URL
    $id = $_GET['id'] ?? null;

    // Inicializa la variable $productos y verifica si se ha proporcionado un ID
    $productos = null;
    if ($id) {
        $query = "SELECT * FROM productofinal WHERE idproductofinal= ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $productos = $result->fetch_assoc();

        if (!$productos) {
            echo "<p>Error: No se encontró el producto final.</p>";
            exit;
        }
    } else {
        echo "<p>Error: ID no proporcionado.</p>";
        exit;
    }
?>

    <!--Formulario para actualizacion de productos finales-->
    <div>
        <div class="bloque">
            <form method="POST" name="frmprod" id="frmprod" action="../Controlador/controladorProdFinal.php?accion=actualizar"
                onsubmit="return validarprodFinal();" class="formulario">
                <h2>Actualización de productos finales</h2>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($productos['idproductoFinal']); ?>">

                <label>Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo htmlspecialchars($productos['nombre']); ?>">

                <label>Precio</label>
                <input type="text" name="precio" id="precio" placeholder="Precio" value="<?php echo htmlspecialchars($productos['precio']); ?>">

                <!--Botón para guardar cambios--->
                <button type="submit">Guardar cambios
                    <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
                </button>


                <!--Botón para cancelar y regresar al listado de producto final-->
                <button type="button" onclick="window.location.href='../Vista/ProdFinal.php';">Cancelar
                    <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
                </button>
                <script src="../Controlador/js/validaciones.php"></script>
            </form>
        </div>
    </div>
<?php
} else {
    header("Location:login.php");
}
?>