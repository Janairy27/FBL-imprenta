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


    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reportes</title>
    </head>

    <div class="bloque">
        <h2>Listado de bajas que se han realizado a lo largo de las fechas</h1>

            <div class="contenedor-formulario">
                <form method='POST' action="../Controlador/controladorReporteBaja.php?accion=buscar"
                    clas="formulario">

                    <label for="busqueda">Buscar por:</label>
                    <select name="busqueda" id="busqueda" class="opciones">
                        <option value="fechaBaja">Fecha</option>
                    </select>

                    <input type="text" name="valor1" placeholder="Ingrese la fecha inicial" require>
                    <input type="text" name="valor2" placeholder="Ingrese la fecha límite" require>
                    <button type="submit">Buscar
                        <img src="../Vista/img/buscar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>
                    <button type="submit" formaction="../Controlador/controladorReporteBaja.php?accion=actualizar">Actualizar
                        <img src="../Vista/img/refrescar.png" alt="Buscar" style="width: 30px; height: 30px;">
                    </button>
                    <!-- Pasar criterios de búsqueda al reporte para generarlo -->
                    <button type="button">
                        <a href="../Vista/reporteBaja.php?busqueda=<?php echo isset($_POST['busqueda']) ? htmlspecialchars($_POST['busqueda']) : ''; ?>&valor1=<?php echo isset($_POST['valor1']) ? htmlspecialchars($_POST['valor1']) : ''; ?>&valor2=<?php echo isset($_POST['valor2']) ? htmlspecialchars($_POST['valor2']) : ''; ?>">
                            Generar reporte </a>
                    </button>

                </form>
            </div>

            <div class="table-responsive">
                <table class="table tabla">
                    <tr class="table-light">
                        <th>Motivo</th>
                        <th>Fecha Baja</th>
                        <th>Nombre insumo</th>
                        <th>Fecha compra</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo electronico</th>

                    </tr>
                    <?php if (isset($resultados)):  ?>
                        <?php foreach ($resultados as $baja): ?>
                            <tr>
                                <td><?php echo $baja['motivo']; ?></td>
                                <td><?php echo $baja['fechaBaja']; ?></td>
                                <td><?php echo $baja['insumo']; ?></td>
                                <td><?php echo $baja['fecha']; ?></td>
                                <td><?php echo $baja['nombre']; ?></td>
                                <td><?php echo $baja['apaterno']; ?></td>
                                <td><?php echo $baja['correo']; ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </table>
                <button type="button" onclick="window.location.href='../Vista/reportesVP.php'">
                    Regresar
                    <img src="../Vista/img/regresar.png" alt="Regresar" style="width: 30px; height: 30px;">
                </button>
            </div>
    </div>

    </html>

<?php
} else {
    header("Location:login.php");
}
?>