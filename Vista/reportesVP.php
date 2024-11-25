<?php include 'includes/header.php';


session_start();
$user = $_SESSION['usuario'];
if (isset($_SESSION['usuario'])) {
    echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
    ?>
    <a href="../Vista/logout.php">
     <img   src="../Vista/img/logout.png" class="image">
     <p class=" posicion"> Cerrar sesion</p></a>
<?php
  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
</head>
<body>
    <h1>Reportes de la base de datos</h1>
        <button type="submit" name="reporteprov"
        onclick="window.location.href='../Vista/reporteFecha.php'">Realizar Reporte Proveedor</button>

    <button type="submit" name="reporteemple"
    onclick="window.location.href='../Vista/Reportes.php'">Realizar Reporte Empleado</button>
    <button type="submit" name="reportebaja"
    onclick="window.location.href='../Vista/reporteBa.php'">Realizar Reporte Baja</button>

    <button type="submit" name="reporteinsumo"
    onclick="window.location.href='../Vista/reporteIns.php'">Realizar Reporte Insumo</button>

    <button type="submit" name="reportepedido"
    onclick="window.location.href='../Vista/reportePedido.php'">Realizar Reporte Pedido</button>


    <?php if (isset($mensaje)) { ?>
        <p><?= htmlspecialchars($mensaje) ?></p>
    <?php } ?>

    <button type="button"  onclick="window.location.href='../Vista/administrador.php'" >Regresar
            <img src="../Vista/img/regresar.png" alt="Regresar" style="width: 30px; height: 30px;" >

        </button>
</body>
</html>
<?php
} else {
    header("Location:login.php");
}
?>