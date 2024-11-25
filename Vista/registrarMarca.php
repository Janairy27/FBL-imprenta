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
  


  $proceso = isset($marca);
?>
<body data-context="registroMarca">
<!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->
<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
        <!-- Botón de cierre manual con evento para redirigir -->
        <button type="button" class="btn-close" id="closeButton" aria-label="Close">Aceptar</button>
    </div>
<?php endif; ?>

  <!--Formulario para el registro de maraca -->


  <div class="bloque">
    <h2>Registro de marca</h2>
    <form method="POST" name="frmmarca" id="frmmarca" action="../Controlador/controladorMarca.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>" class="formulario">

      <?php if ($proceso):  ?>
        <input type="hidden" name="idmarca" value="<?php echo $marca['idmarca']; ?>">
      <?php endif; ?>

      <label>Marca: </label>
      <input type="text" name="nombre" id="nombre" placeholder="Nombre de la marca" value="<?php echo $proceso ? $marca['nomMarca'] : ''; ?>">
      <p class="alert alert-danger" id="nom" name="nom" style="display: none;">
        Ingresa un nombre válido !!!
      </p>

      <label>Descripción: </label>
      <input type="text" name="descripcion" id="descripcion" placeholder="Descripción de lo que hace la marca"
        value="<?php echo $proceso ? $marca['descripcion'] : ''; ?>">
      <p class="alert alert-danger" id="nom" name="nom" style="display: none;">
        Ingresa un nombre válido !!!
      </p>

      <!--Botón para guardar-->
      <button type="submit"> Guardar

        <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
      </button>
      <p class="alert alert-success" id="btne" name="btne" style="display: none;">Enviando datos</p>
      <script src="../Controlador/js/validaciones.js"></script>
    </form>

    <div class="mt-3">
     <!--Botón para cancelar y regresa al listado de marca-->
    <button type="button" onclick="window.location.href='../Vista/buscarMarca.php'">
      Cancelar
      <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
    </button>

    <!--Botón para regresar al regstro de insumo-->
    <button type="button" onclick="window.location.href='../Vista/registroInsumo.php'">
      Regresar
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