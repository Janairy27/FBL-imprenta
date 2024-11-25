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



    $proceso = isset($producto);
    ?>

    <!-- Formulario de registro de producto final -->

    <div class="bloque">
        <h2>Registro de productos finales</h2>
        <form method="POST" name="frmprod" id="frmprod" action="../Controlador/controladorProdFinal.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>"
            onsubmit=" return validarprodFinal();" class="formulario">

            <?php if ($proceso):  ?>
                <input type="hidden" name="id" value="<?php echo $producto['idproductoFinal']; ?>">
            <?php endif; ?>

            <label>Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre del producto" value="<?php echo $proceso ? $producto['nombre'] : ''; ?>">
            <p class="alert alert-danger" id="prod" name="prod" style="display: none;">
                Favor de ingresar un producto válido
            </p>

            <label>Precio</label>
            <input type="text" name="precio" id="precio" placeholder="Precio" value="<?php echo $proceso ? $producto['precio'] : ''; ?>"
                onkeypress="
        // Permitir teclas numéricas (0-9) y un solo punto decimal
        var key = event.key;
        if ((key >= '0' && key <= '9') || key === '.' || event.keyCode === 8) {
            return true; // Permitir números y el punto
        } else {
            event.preventDefault(); // Bloquear otras teclas
        }
    ">
            <p class="alert alert-danger" id="prec" name="prec" style="display: none;">
                Favor de ingresar un precio válido
            </p>

            <button type="submit">
                Guardar
                <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
            </button>
            <p class="alert alert-success" id="btne" name="btne" style="display: none;">Enviando datos</p>
            <script src="../Controlador/js/validaciones.js"></script>
        </form>

        <!--Botón para cancelar y regresa al listado de producto final-->
        <button type="button" onclick="window.location.href='../Vista/ProdFinal.php'">
            cancelar
            <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
        </button>


    </div>
<?php
} else {
    header("Location:login.php");
}
?>