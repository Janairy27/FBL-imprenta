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
  

// Captura el ID pasado por la URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "<p>Error: ID no proporcionado.</p>";
    exit;
}



$query = "SELECT usuarios.idusuarios, usuarios.usuario, usuarios.contrasena, usuarios.idempleado, 
          CONCAT(empleado.nomb, ' ', empleado.apaterno) AS empleado
          FROM usuarios 
          INNER JOIN empleado ON usuarios.idempleado = empleado.idempleado 
          WHERE usuarios.idusuarios = ?";
$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuarios = $result->fetch_assoc();

if (!$usuarios) {
    echo "<p>Error: No se encontró el usuario.</p>";
    exit;
}

// Obtener la lista de empleados
require_once '../Controlador/controladorUsuario.php';
$controlador = new controladorUsuario();
$empleados = $controlador->obtenerEmpleados();

?>
<!--Formulario para la actualizacion de usuario-->
<div class="bloque">
    <form method="POST" name="frmusuario" id="frmusuario"
        action="../Controlador/controladorUsuario.php?accion=actualizar"
        onsubmit="return validarusuario();" class="formulario">
        <h2>Actualización de usuarios</h2>

        <!-- Campo oculto con el ID del usuario -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuarios['idusuarios']); ?>">

        <label>Usuario</label>
        <input type="text" name="usuario" id="usuario" placeholder="Usuario"
            value="<?php echo htmlspecialchars($usuarios['usuario']); ?>">

        <label>Contraseña</label>
        <input type="text" name="contrasena" id="contrasena" placeholder="Contraseña"
            value="<?php echo htmlspecialchars($usuarios['contrasena']); ?>">

        <label>Empleado al que corresponderá el inicio de sesión</label>
        <select name="idempleado" id="idempleado">
            <?php foreach ($empleados as $empleado): ?>
                <option value="<?php echo htmlspecialchars($empleado['idempleado']); ?>"
                    <?php echo ($empleado['idempleado'] == $usuarios['idempleado']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($empleado['nombre']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!--Botón para guardar cambios-->
        <button type="submit"> Guardar cambios
            <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
        </button>

        <!--Botón para cancelar y regresar al listado de usuario-->
        <button type="button" onclick="window.location.href='../Vista/Usuario.php';">
            Cancelar
            <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
        </button>
    </form>
</div>

<script src="../Controlador/js/validaciones.php"></script>

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