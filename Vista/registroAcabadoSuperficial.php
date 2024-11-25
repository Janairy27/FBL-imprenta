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



  $proceso = isset($acabado);
  ?>

  <body data-context="registroAcabadoSuperficial">
    <!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->
    <?php if (isset($_GET['error'])): ?>
      <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
        <!-- Botón de cierre manual con evento para redirigir -->
        <button type="button" class="btn-close" id="closeButton" aria-label="Close">Aceptar</button>
      </div>
    <?php endif; ?>

    <!-- Formulario para agregar un acabado superficial  -->


    <div class="bloque">
      <h2>Registro de acabado superficial</h2>
      <form method="POST" name="frmacabado" id="frmacabado" action="../Controlador/controladorAcabadoSuperficial.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>" class="formulario">

        <?php if ($proceso):  ?>
          <input type="hidden" name="idacabado" value="<?php echo $acabado['idacabado']; ?>">
        <?php endif; ?>

        <label>Acabado superficial: </label>
        <input type="text" name="nombreA" id="nombreA" placeholder="Nombre del acabado superficial" value="<?php echo $proceso ? $acabado['nomAcabado'] : ''; ?>">
        <p class="alert alert-warning" id="nomA" name="nomA" style="display: none;">
          No dejes el campo vacio !!!
        </p>

        <!---Botón para guardar-->
        <button type="submit" onclick="validarAcabado()"> Guardar
          <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
        </button>
        <p class="alert alert-success" id="btne" name="btne" style="display: none;">Enviando datos</p>
        <script src="../Controlador/js/validaciones.js"></script>
      </form>

      <div class="mt-3">
        <!--Botón para cancelar y regresa al listado de ACABADO-->
        <button type="button" onclick="window.location.href='../Vista/buscarAcabadoSuperficial.php'">
          Cancelar
          <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
        </button>

        <!--Botón para regresar al regstro de insumo-->
        <button type="button" onclick="window.location.href='../Vista/registroInsumo.php'">
          Regresar registro insumo
          <img src="../Vista/img/regresar.png" alt="Regresar" style="width: 30px; height: 30px;">
        </button>
      </div>
    </div>
  </body>
<?php
} else {
  header("Location:login.php");
}
?>