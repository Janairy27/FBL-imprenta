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


$query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad, insumos.idubicacion,
CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS Nomubicacion
 , insumos.idcolor, color.nomColor AS nomcolor, insumos.idtransparencia, transparencia.nomTransparencia AS nomtransparencia,
insumos.idacabado,acabado.nomAcabado AS nomacabado, insumos.idpresentacion, presentacion.nomPresentacion AS nompresentacion, 
 insumos.idtipomedida,CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS Tipomedida, insumos.idmedida,
 CONCAT(medida.largo, 'x', medida.ancho) AS Tmedida, insumos.idgrosor,  concat(
grosor.cantGrosor, ' ', grosor.unidadMedida) AS Grosor,  insumos.idmaterial,material.nomMaterial AS nomaterial,
insumos.idproveedor,proveedor.NomProveedor AS nomproveedor,insumos.idmarca,
 marca.nomMarca AS marca,insumos.idsubmaterial,  submaterial.nomSubmaterial AS nomsubmaterial
FROM insumos
INNER JOIN ubicacion ON ubicacion.idubicacion = insumos.idubicacion
INNER JOIN color ON color.idcolor = insumos.idcolor
INNER JOIN transparencia ON transparencia.idtransparencia = insumos.idtransparencia
 INNER JOIN acabado ON acabado.idacabado = insumos.idacabado
INNER JOIN presentacion ON presentacion.idpresentacion = insumos.idpresentacion
INNER JOIN tipomedida ON tipomedida.idtipomedida = insumos.idtipomedida
INNER JOIN medida ON medida.idmedida = insumos.idmedida
INNER JOIN material ON material.idmaterial = insumos.idmaterial
INNER JOIN grosor ON grosor.idgrosor = insumos.idgrosor
INNER JOIN proveedor ON proveedor.idproveedor = insumos.idproveedor
INNER JOIN marca ON marca.idmarca = insumos.idmarca
INNER JOIN submaterial ON submaterial.idsubmaterial = insumos.idsubmaterial
WHERE insumos.idinsumos = ?";

$stmt = $conn->prepare($query);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$insumos = $result->fetch_assoc();

if (!$insumos) {
    echo "<p>Error: No se encontró el insumo.</p>";
    exit;
}

// Obtener la lista de acabados, colores, grosores
//marcas, materiales, medidaad, tipos de medida, etc.
require_once '../Controlador/controladorInsumo.php';
$controlador = new controladorInsumo();
$acabados = $controlador->obtenerAcabados();
$colores = $controlador->obtenerColores();
$grosores = $controlador->obtenerGrosores();
$marcas = $controlador->obtenerMarcas();
$materiales = $controlador->obtenerMateriales();
$medidas = $controlador->obtenerMedidas();
$presentaciones = $controlador->obtenerPresentaciones();
$proveedores = $controlador->obtenerProveedores();
$tiposmateriales = $controlador->obtenerSubMateriales();
$tiposmedidas = $controlador->obtenerTiposMedidas();
$transparencias = $controlador->obtenerTransparencias();
$ubicaciones = $controlador->obtenerUbicaciones();

?>

<!--Formulario para la actualizacion de insumos-->
<div class="bloque">
    <form method="POST" name="frmusuario" id="frmusuario"
        action="../Controlador/controladorInsumo.php?accion=actualizar"
        onsubmit="return validarusuario();" class="formulario">
        <h2>Actualización de insumos</h2>

        <!-- Campo oculto con el ID del usuario -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($insumos['idinsumos']); ?>">

        <label>Nombre del insumo: </label>
        <input type="text" name="nomInsumo" id="nomInsumo" placeholder="nomInsumo"
            value="<?php echo htmlspecialchars($insumos['nomInsumo']); ?>">

        <label>Fecha de compra: </label>
        <input type="date" name="fechacompra" id="fechacompra" placeholder="fechacompra"
            value="<?php echo htmlspecialchars($insumos['fechacompra']); ?>">

        <label>Fecha de uso: </label>
        <input type="date" name="fechauso" id="fechauso" placeholder="fechauso"
            value="<?php echo htmlspecialchars($insumos['fechauso']); ?>">

        <label>Cantidad: </label>
        <input type="text" name="cantidad" id="cantidad" placeholder="cantidad"
            value="<?php echo htmlspecialchars($insumos['cantidad']); ?>"
            onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">  

        <label>Rendimiento: </label>
        <input type="text" name="rendimiento" id="rendimiento" placeholder="rendimiento"
            value="<?php echo htmlspecialchars($insumos['rendimiento']); ?>">

        <label>Precio: </label>
        <input type="text" name="precio" id="precio" placeholder="precio"
            value="<?php echo htmlspecialchars($insumos['precio']); ?>"
            onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">  

        <label>Disponibilidad: </label>
        <input type="text" name="disponibilidad" id="disponibilidad" placeholder="disponibilidad"
            value="<?php echo htmlspecialchars($insumos['disponibilidad']); ?>">

        <label>Ubicación donde se ubicará el insumo: </label>
        <select name="idubicacion" id="idubicacion">
            <?php foreach ($ubicaciones as $ubicacion): ?>
                <option value="<?php echo htmlspecialchars($ubicacion['idubicacion']); ?>"
                    <?php echo ($ubicacion['idubicacion'] == $insumos['idubicacion']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($ubicacion['ubicacion']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Color que tiene el insumo: </label>
        <select name="idcolor" id="idcolor">
            <?php foreach ($colores as $color): ?>
                <option value="<?php echo htmlspecialchars($color['idcolor']); ?>"
                    <?php echo ($color['idcolor'] == $insumos['idcolor']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($color['color']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Transparencia del insumo (si es que tiene): </label>
        <select name="idtransparencia" id="idtransparencia">
            <?php foreach ($transparencias as $transparencia): ?>
                <option value="<?php echo htmlspecialchars($transparencia['idtransparencia']); ?>"
                    <?php echo ($transparencia['idtransparencia'] == $insumos['idtransparencia']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($transparencia['transparencia']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Acabado superficial que tiene el insumo: </label>
        <select name="idacabado" id="idacabado">
            <?php foreach ($acabados as $acabado): ?>
                <option value="<?php echo htmlspecialchars($acabado['idacabado']); ?>"
                    <?php echo ($acabado['idacabado'] == $insumos['idacabado']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($acabado['acabado']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Presentación en la que viene el insumo: </label>
        <select name="idpresentacion" id="idpresentacion">
            <?php foreach ($presentaciones as $presentacion): ?>
                <option value="<?php echo htmlspecialchars($presentacion['idpresentacion']); ?>"
                    <?php echo ($presentacion['idpresentacion'] == $insumos['idpresentacion']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($presentacion['presentacion']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Tipo de medida que tiene el insumo: </label>
        <select name="idtipomedida" id="idtipomedida">
            <?php foreach ($tiposmedidas as $tipomedida): ?>
                <option value="<?php echo htmlspecialchars($tipomedida['idtipomedida']); ?>"
                    <?php echo ($tipomedida['idtipomedida'] == $insumos['idtipomedida']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($tipomedida['tipomedida']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Medida del insumo: </label>
        <select name="idmedida" id="idmedida">
            <?php foreach ($medidas as $medida): ?>
                <option value="<?php echo htmlspecialchars($medida['idmedida']); ?>"
                    <?php echo ($medida['idmedida'] == $insumos['idmedida']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($medida['medida']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Grosor del insumo: </label>
        <select name="idgrosor" id="idgrosor">
            <?php foreach ($grosores as $grosor): ?>
                <option value="<?php echo htmlspecialchars($grosor['idgrosor']); ?>"
                    <?php echo ($grosor['idgrosor'] == $insumos['idgrosor']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($grosor['grosor']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Material del que esta compuesto el insumo: </label>
        <select name="idmaterial" id="idmaterial">
            <?php foreach ($materiales as $material): ?>
                <option value="<?php echo htmlspecialchars($material['idmaterial']); ?>"
                    <?php echo ($material['idmaterial'] == $insumos['idmaterial']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($material['material']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Proveedor: </label>
        <select name="idproveedor" id="idproveedor">
            <?php foreach ($proveedores as $proveedor): ?>
                <option value="<?php echo htmlspecialchars($proveedor['idproveedor']); ?>"
                    <?php echo ($proveedor['idproveedor'] == $insumos['idproveedor']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($proveedor['proveedor']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Marca del insumo: </label>
        <select name="idmarca" id="idmarca">
            <?php foreach ($marcas as $marca): ?>
                <option value="<?php echo htmlspecialchars($marca['idmarca']); ?>"
                    <?php echo ($marca['idmarca'] == $insumos['idmarca']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($marca['marca']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Submaterial del insumo: </label>
        <select name="idsubmaterial" id="idsubmaterial">
            <?php foreach ($tiposmateriales as $submaterial): ?>
                <option value="<?php echo htmlspecialchars($submaterial['idsubmaterial']); ?>"
                    <?php echo ($submaterial['idsubmaterial'] == $insumos['idsubmaterial']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($submaterial['submaterial']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!--Botón para guardar cambios-->
        <button type="submit"> Guardar cambios
            <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;">
        </button>

        <!--Botón para canacelar y regresar al lsiatdo de insumo-->
        <button type="button" onclick="window.location.href='../Vista/buscarInsumo.php';">
            <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
            Cancelar</button>

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