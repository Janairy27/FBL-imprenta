<?php  include '../Vista/includes/header.php';


session_start();

$user = $_SESSION['usuario'];

if (isset($_SESSION['usuario'])) {
    echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
    ?>
    <a href="../Vista/logout.php">
     <img   src="../Vista/img/logout.png" class="image">
     <p class=" posicion"> Cerrar sesion</p></a>

<!--Vista para el menú o index para el usuario empleado-->
<article class="entrada">
<div class="texto3">

  <a href="../Vista/buscarInsumoVE.php">
  <img src="../Vista/img/insumos.png" class="imageInsumo">
  <p class="posicionInsumo">Insumo</p></a>

  <a href="../Vista/buscarBajaVE.php">
  <img src="../Vista/img/baja.png" class="imageBa">
  <p class=" posicionBa"> Baja</p></a>

  
  <a href="../Vista/PedidoVE.php">
  <img src="../Vista/img/pedido.png" class="imagePedi">
  <p class=" posicionPedi"> Pedido</p></a>


</div>
</article>
<?php
} else {
    header("Location:login.php");
}
?>