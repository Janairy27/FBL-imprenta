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
  

  $proceso = isset($estado);
?>

  <!--Formulario de registro de estados-->

  <div class="bloque">
    <h2>Registro de estados</h2>
    <form method="POST" name="frmestado" id="frmestado" action="../Controlador/controladorEstado.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>"
    onsubmit="return validarestado();" class="formulario">

      <?php if ($proceso):  ?>
        <input type="hidden" name="id" value="<?php echo $estado['idestado']; ?>">
      <?php endif; ?>

      <label>Nombre</label>
      <input type="text" name="estado" id="estado" placeholder="Estado del pedido" value="<?php echo $proceso ? $estado['estado'] : ''; ?>">
      <p class="alert alert-danger" id="est" name="est" style="display: none;">
        Favor de ingresar un estado válido
      </p>

      <button type="submit" ><?php echo $proceso ? 'Actualizar' : 'Registrar'; ?>
      Guardar
                <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
    </button>
      <p class="alert alert-success" id="btne" name="btne" style="display: none;">Enviando datos</p>
      <script src="../Controlador/js/validaciones.js"></script>
    </form>

    <!--Botón para cancelar y regresa al listado de estado-->
    <button type="button" onclick="window.location.href='../Vista/Estado.php'">
     Cancelar
      <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
    </button>


  </div>
<?php
} else {
  header("Location:login.php");
}
?>