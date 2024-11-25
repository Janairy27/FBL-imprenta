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
  

$user = $_SESSION['usuario'];

// Captura el ID pasado por la URL
$id = $_GET['id'] ?? null;
$error = $_GET['error'] ?? null;

if (!$id) {
    echo "<p>Error: ID no proporcionado.</p>";
    exit;
}



$query = "SELECT baja.idbaja, baja.cantBaja, baja.fechaBaja, baja.motivo, baja.idinsumos, baja.idempleado, 
          concat(insumos.nomInsumo, ' ', insumos.fechacompra) as insumo,
          CONCAT(empleado.nomb, ' ', empleado.apaterno) AS empleado
          FROM baja
          INNER JOIN insumos ON baja.idinsumos = insumos.idinsumos
          INNER JOIN empleado ON baja.idempleado = empleado.idempleado 
          WHERE baja.idbaja = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$bajas = $result->fetch_assoc();

if (!$bajas) {
    echo "<p>Error: No se encontró la baja.</p>";
    exit;
}

// Obtener la lista de insumos y empleaods 
require_once '../Controlador/controladorBajaVE.php';
$controlador = new controladorBajaVE();
$insumos = $controlador->obtenerInsumos();
$empleados = $controlador->obtenerEmpleados();

?>
<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Error:</strong> <?php echo htmlspecialchars($_GET['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">Aceptar</button>
    </div>
<?php endif; ?>

<div class="bloque">
    <form method="POST" name="frmbaja" id="frmbaja"
        action="../Controlador/controladorBajaVE.php?accion=actualizar"
        onsubmit="return validarusuario();" class="formulario">
        <h2>Edición de bajas</h2>

        <!-- Campo oculto con el ID del usuario -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($bajas['idbaja']); ?>">

        <label>Cantidad: </label>
        <input type="text" name="cantBaja" id="cantBaja" placeholder="Cantidad"
            value="<?php echo htmlspecialchars($bajas['cantBaja']); ?>"
            onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">  

        <label>Fecha de baja: </label>
        <input type="date" name="fechabaja" id="fechabaja" placeholder="Fecha baja"
            value="<?php echo htmlspecialchars($bajas['fechaBaja']); ?>">

        <label>Motivo: </label>
        <input type="text" name="motivo" id="motivo" placeholder="Motivo"
            value="<?php echo htmlspecialchars($bajas['motivo']); ?>">

        <label>Insumo al que se hara la baja</label>
        <select name="idinsumos" id="idinsumos">
            <?php foreach ($insumos as $insumo): ?>
                <option value="<?php echo htmlspecialchars($insumo['idinsumos']); ?>"
                    <?php echo ($insumo['idinsumos'] == $bajas['idinsumos']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($insumo['insumos']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Empleado el que hara la baja</label>
        <select name="idempleado" id="idempleado">
            <?php foreach ($empleados as $empleado): ?>
                <option value="<?php echo htmlspecialchars($empleado['idempleado']); ?>"
                    <?php echo ($empleado['idempleado'] == $bajas['idempleado']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($empleado['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Botón para guardar cmbios del formulario -->
        <button type="submit"> Guardar cambios
            <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
        </button>

        <!-- Botón para cancelar y regresar al listado de bajas-->
        <button type="button" onclick="window.location.href='../Vista/buscarBajaVE.php';"> Cancelar
            <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
        </button>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>


<?php
// Cerrar conexión y liberar recursos
$stmt->close();
$conn->close();
?>
<?php
} else {
    header("Location:login.php");
}
?>