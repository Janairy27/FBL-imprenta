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
  

$proceso = isset($medida);
?>
<body data-context="registroMedida">
<!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->
<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
        <!-- Botón de cierre manual con evento para redirigir -->
        <button type="button" class="btn-close" id="closeButton" aria-label="Close">Aceptar</button>
    </div>
<?php endif; ?>

<!-- Formulario de registro para medida -->

 
<div class="bloque">
    <h2>Registro de medida</h2>
        <form method="POST" name="frmMedida" id="frmMedida" action="../Controlador/controladorMedida.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>" class="formulario">
            
            <?php if($proceso):  ?>
                <input type="hidden" name="idmedida" value="<?php echo $medida['idmedida']; ?>">
            <?php endif; ?>
             
                    <label>Largo  </label>
                    <input type="text" name ="largo" id="largo" placeholder="Largo" value="<?php echo $proceso ? $medida['largo'] : ''; ?>"
                    onkeypress="
        // Permitir teclas numéricas (0-9) y un solo punto decimal
        var key = event.key;
        if ((key >= '0' && key <= '9') || key === '.' || event.keyCode === 8) {
            return true; // Permitir números y el punto
        } else {
            event.preventDefault(); // Bloquear otras teclas
        }
    ">   
                    <p class="alert alert-danger" id="lar" name="lar" style="display: none;">
                        Ingresa una medida para largo válido !!!
                    </p>
                    <label>Ancho:  </label>
                    <input type="text" name="ancho" id="ancho" placeholder="Ancho" value="<?php echo $proceso ? $medida['ancho'] : ''; ?>"
                    onkeypress="
        // Permitir teclas numéricas (0-9) y un solo punto decimal
        var key = event.key;
        if ((key >= '0' && key <= '9') || key === '.' || event.keyCode === 8) {
            return true; // Permitir números y el punto
        } else {
            event.preventDefault(); // Bloquear otras teclas
        }
    ">
                    <p class="alert alert-danger" id="an" name="an" style="display: none;">
                        ¡Ingresa un nombre de mueble válido !
                    </p>
           <button type="submit"> Guardar
         <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
 </button> 
       <p class="alert alert-success" id="btne" name="btne" style="display: none;">Enviando datos</p>
          <script src="../Controlador/js/validaciones.js"></script>
        </form>
</div>

<div class="mt-3">
 <!--Botón para cancelar y regresa al listado de estado-->
 <button type="button" onclick="window.location.href='../Vista/buscarMedida.php'">
        Cancelar
        <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
    </button>

    <!--Botón para regresar al registro de insumo-->
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