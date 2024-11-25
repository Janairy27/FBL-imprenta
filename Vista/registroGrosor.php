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
  

$proceso = isset($grosor);
?>
<body data-context="registroGrosor">
<!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->
<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
        <!-- Botón de cierre manual con evento para redirigir -->
        <button type="button" class="btn-close" id="closeButton" aria-label="Close">Aceptar</button>
    </div>
<?php endif; ?>

<!--Formulario de resgitro para grosor-->
<div class="bloque">
    <div class="row">
    <h2>Registro de grosor</h2>
        <form method="POST" name="frmgrosor" id="frmgrosor" action="../Controlador/controladorGrosor.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>" 
        class="formulario">
            
            <?php if($proceso):  ?>
                <input type="hidden" name="idgrosor" value="<?php echo $grosor['idgrosor']; ?>">
            <?php endif; ?>
             
                    <label class="">Grosor: </label>
                    <input type="text" name ="cantGrosor"  id="cantGrosor" placeholder="Cantidad de grosor" 
                    value="<?php echo $proceso ? $grosor['cantGrosor'] : ''; ?>" class="form-control"
                    onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">
                    <p class="alert alert-warning"  id="can" name="can" style="display: none;">
                        No dejes el campo vacio !!!
                    </p>        
                    
                    <label class="">Unidad de medida: </label>
                    <input type="text" name ="unidadMedida"  id="unidadMedida" placeholder="Unidad de Medida" 
                    value="<?php echo $proceso ? $grosor['unidadMedida'] : ''; ?>" class="form-control">    
                    <p class="alert alert-warning"  id="uniM" name="uniM" style="display: none;">
                        No dejes el campo vacio !!!
                    </p>   

                    <label class="">Flexibilidad </label>
                    <input type="text" name ="flexibilidad"  id="flexibilidad" placeholder="Flexibilidad del material" 
                    value="<?php echo $proceso ? $grosor['flexibilidad'] : ''; ?>" class="form-control">    
                    <p class="alert alert-warning"  id="flex" name="flex" style="display: none;">
                        No dejes el campo vacio !!!
                    </p> 
            
           <button type="submit" >Guardar
         <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
       </button> 
       <p class="alert alert-success" id="btne" name="btne" style="display: none;">Enviando datos</p>
       <script src="../Controlador/js/validaciones.js"></script>
        </form>
</div>
</div>
<div class="mt-3">
<!--Botón para cancelar y regresa al listado de grosor-->
 <button type="button" onclick="window.location.href='../Vista/buscarGrosor.php'">
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
}else{
  header("Location:login.php");
}
?>

