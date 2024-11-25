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
  

    $proceso = isset($proveedor);
?>
<body data-context="registroProveedor">
<!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->
<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
        <!-- Botón de cierre manual con evento para redirigir -->
        <button type="button" class="btn-close" id="closeButton" aria-label="Close">Aceptar</button>
    </div>
<?php endif; ?>

    <!-- Formulario para registrar un proveedor -->


    <div class="bloque">
        <h2>Registro de Proveedor</h2>
        <?php
        if (isset($_GET['error'])) {
            echo "<p style='color:red'>" . htmlspecialchars($_GET['error']) . "</p>";
        }
    
    ?>
        <form method="POST" name="frmproveedor" id="frmproveedor" action="../Controlador/controladorProveedor.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>" class="formulario">

            <?php if ($proceso):  ?>
                <input type="hidden" name="idproveedor" value="<?php echo $proveedor['idproveedor']; ?>">
            <?php endif; ?>

            <label>Proveedor: </label>
            <input type="text" name="Nomproveedor" id="Nomproveedor" placeholder="Nombre del proveedor" value="<?php echo $proceso ? $proveedor['Nomproveedor'] : ''; ?>">
            <p class="alert alert-danger" id="nomP" name="nomP" style="display: none;">
                Ingresa un nombre válido !!!
            </p>
            <label>Direccion: </label>
            <input type="text" name="direccion" id="direccion" placeholder="Direccion" value="<?php echo $proceso ? $proveedor['direccion'] : ''; ?>">
            <p class="alert alert-danger" id="dir" name="dir" style="display: none;">
                ¡Ingresa una direccion valida !
            </p>
            <label>Contacto: </label>
            <input type="text" name="contacto" id="contacto" placeholder="Nombre del contacto" value="<?php echo $proceso ? $proveedor['contacto'] : ''; ?>">
            <p class="alert alert-warning" id="dir" name="dir" style="display: none;">
                ¡No dejes el campo vacío ingresa el nombre del contacto !
            </p>
            <label>Telefono: </label>
            <input type="text" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $proceso ? $proveedor['telefono'] : ''; ?>"
                onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }" maxlength="10">
            <p class="alert alert-danger" id="tele" name="tele" style="display: none;">
                ¡Ingresa un un nuémero de telefono valido !
            </p>

            <label>Correo: </label>
            <input type="text" name="correo" id="correo" placeholder="Correo " value="<?php echo $proceso ? $proveedor['correo'] : ''; ?>">
            <p class="alert alert-danger" id="cor" name="cor" style="display: none;">
                ¡Ingresa un correo válido !
            </p>

            <label>Número de cliente: </label>
            <input type="text" name="numCliente" id="numCliente" placeholder="Número de cliente " value="<?php echo $proceso ? $proveedor['NoCliente'] : ''; ?>"
            onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">
            <p class="alert alert-warning" id="tele" name="tele" style="display: none;">
                ¡No dejes el campo vacío !
            </p>
            <!--Botón para guardar-->
            <button type="submit"> Guardar
                <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
            </button>
            <p class="alert alert-success" id="btne" name="btne" style="display: none;">Enviando datos</p>
            <script src="../Controlador/js/validaciones.js"></script>
        </form>
    </div>

    <div class="mt-3">
     <!--Botón para cancelar y regresa al listado de Proveedor-->
    <button type="button" onclick="window.location.href='../Vista/buscarProveedor.php'">
        Cancelar
        <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
    </button>

    <!--Botón para regresar al regstro de insumo-->
    <button type="button" onclick="window.location.href='../Vista/registroInsumo.php'">
        Regresar registro insumo
        <img src="../Vista/img/regresar.png" alt="Regresar" style="width: 30px; height: 30px;">
    </button>
    </div>
</body>
<?php
} else {
    header("Location:login.php");
}
?>