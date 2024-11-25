<?php include '../Vista/includes/header.php';

session_start();

$user = $_SESSION['usuario'];

if (isset($_SESSION['usuario'])) {
  echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
?>
  <a href="../Vista/logout.php">
    <img src="../Vista/img/logout.png" class="image">
    <p class=" posicion"> Cerrar sesion</p>
  </a>

  <!--Enlaces para acceder a los listados de cada tabla de la Base de Datos -->
  <article class="entrada">
    <div class="texto3">

      <a href="../Vista/buscarUbicacion.php">
        <img src="../Vista/img/ubicacion.png" class="imageubi"> </a>
      <p class=" posicionUbi"> Ubicación</p>

      <a href="../Vista/buscarProveedor.php">
        <img src="../Vista/img/proveedor.png" class="imageProv"></a>
      <p class=" posicionProv"> Proveedor</p>


      <a href="../Vista/buscarColor.php">
        <img src="../Vista/img/palettepng.png" class="imageCol"></a>
      <p class=" posicionCol"> Color</p>

      <a href="../Vista/buscarMedida.php">
        <img src="../Vista/img/medida.png" class="imageMed"></a>
      <p class=" posicionMed"> Medida</p>

      <a href="../Vista/buscarMaterial.php">
        <img src="../Vista/img/material.png" class="imageMat"></a>
      <p class=" posicionMat"> Material</p>

      <a href="../Vista/buscarInsumo.php">
        <img src="../Vista/img/insumos.png" class="imageIns"></a>
      <p class=" posicionIns">Insumo</p>

      <a href="../Vista/Usuario.php">
        <img src="../Vista/img/usuario.png" class="imageUsu"></a>
      <p class=" posicionUsu"> Usuarios</p>

      <a href="../Vista/buscarBaja.php">
        <img src="../Vista/img/baja.png" class="imageBaja"></a>
      <p class=" posicionBaja"> Baja</p>


      <a href="../Vista/buscarEmpleado.php">
        <img src="../Vista/img/empleado.png" class="imageEmp"></a>
      <p class=" posicionEmp"> Empleado</p>


      <a href="../Vista/Pedido.php">
        <img src="../Vista/img/pedido.png" class="imagePed"></a>
      <p class=" posicionPed"> Pedido</p>

      <a href="../Vista/reportesVP.php">
        <img src="../Vista/img/reporte.png" class="imageRe"></a>
      <p class=" posicionRe"> Reporte</p>

      <a href="../Vista/respaldo&restauracion.php">
        <img src="../Vista/img/respaldo.png" class="imageRes"></a>
      <p class=" posicionRes"> Respaldo</p>


    </div>
  </article>
<?php
} else {
  header("Location: ../Vista/login.php");
}
?>