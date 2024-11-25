<?php 
include 'includes/header.php';
include '../Controlador/controladorInsumoVE.php';

session_start();
$user = $_SESSION['usuario'];
if (isset($_SESSION['usuario'])) {
    echo "<h1 class='logout'>Usuario:  " . $user . "</h1>";
    ?>
    <a href="../Vista/logout.php">
     <img   src="../Vista/img/logout.png" class="image">
     <p class=" posicion"> Cerrar sesion</p></a>
<?php
  
  

/**Traer los listados de cada tabala que se requiera
 */
$proceso = isset($insumo);
$controlador = new controladorInsumoVE();
$acabados = $controlador->obtenerListaAcabados();
$colores = $controlador->obtenerListaColores();
$grosores = $controlador->obtenerListaGrosores();
$marcas = $controlador->obtenerListaMarcas();
$materiales = $controlador->obtenerListaMateriales();
$medidas = $controlador->obtenerListaMedidas();
$presentaciones = $controlador->obtenerListaPresentaciones();
$proveedores = $controlador->obtenerListaProveedores();
$tiposmateriales = $controlador->obtenerListaSubMateriales();
$tiposmedidas = $controlador->obtenerListaTiposMedidas();
$transparencias = $controlador->obtenerListaTransparencias();
$ubicaciones = $controlador->obtenerListaUbicaciones();
?>
<body data-context="registroInsumo">
<!-- Mostrar alerta de error (si existe el parámetro 'error' en la URL) -->
<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <strong>Error!</strong> <?php echo htmlspecialchars($_GET['error']); ?>
        <!-- Botón de cierre manual con evento para redirigir -->
        <button type="button" class="btn-close" id="closeButton" aria-label="Close">Aceptar</button>
    </div>
<?php endif; ?>

<!-- Formulario para registro de insumo -->

<div class="bloque">
    <h2>Registro de insumos</h2>
        <form method="POST" name="frminsumo" id="frminsumo" action="../Controlador/controladorInsumoVE.php?accion=<?php echo $proceso ? 'actualizar' : 'crear'; ?>" 
        onsubmit="return validarinsumo();" class="formulario">
            
            <?php if($proceso):  ?>
                <input type="hidden" name="id" value="<?php echo $insumo['idinsumos']; ?>">
            <?php endif; ?>
             
                    <label>Nombre del insumo:</label>
                    <input type="text" name ="nomInsumo" id="nomInsumo" placeholder="Insumo" value="<?php echo $proceso ? $insumo['nomInsumo'] : ''; ?>">    
                    <p class="alert alert-danger" id="ins" name="ins" style="display: none;">
                        Favor de llenar el campo
                    </p>

                    <label>Fecha de compra: </label>
                    <input type="date" name="fechacompra" id="fechacompra" placeholder="Fecha de compra" value="<?php echo $proceso ? $insumo['fechacompra'] : ''; ?>">
                    <p class="alert alert-danger" id="fec" name="fec" style="display: none;">
                        Favor de llenar el campo
                    </p>

                    <label>Fecha de uso: </label>
                    <input type="date" name="fechauso" id="fechauso" placeholder="Fecha de uso" value="<?php echo $proceso ? $insumo['fechauso'] : ''; ?>">
                    <p class="alert alert-danger" id="fecus" name="fecus" style="display: none;">
                        Favor de llenar el campo
                    </p>

                    <label>Cantidad: </label>
                    <input type="text" name="cantidad" id="cantidad" placeholder="Cantidad" value="<?php echo $proceso ? $insumo['cantidad'] : ''; ?>"
                    onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">
                    <p class="alert alert-danger" id="canti" name="canti" style="display: none;">
                        Favor de llenar el campo
                    </p>

                    <label>Rendimiento: </label>
                    <input type="text" name="rendimiento" id="rendimiento" placeholder="Rendimiento" value="<?php echo $proceso ? $insumo['rendimiento'] : ''; ?>">
                    <p class="alert alert-danger" id="rendi" name="rendi" style="display: none;">
                        Favor de llenar el campo
                    </p>

                    <label>Precio: </label>
                    <input type="text" name="precio" id="precio" placeholder="Precio" value="<?php echo $proceso ? $insumo['precio'] : ''; ?>"
                    onkeypress="
                        if(event.keyCode<48 || event.keyCode >57){
                            event.returnValue=false;
                        }">
                    <p class="alert alert-danger" id="prec" name="prec" style="display: none;">
                        Favor de llenar el campo
                    </p>
                    <label>Disponibilidad: </label>
                    <input type="text" name="disponibilidad" id="disponibilidad" placeholder="Disponibilidad" value="<?php echo $proceso ? $insumo['disponibilidad'] : ''; ?>">
                    <p class="alert alert-danger" id="dis" name="dis" style="display: none;">
                        Favor de llenar el campo
                    </p>


                    <label>Ubicación donde se ubicará el insumo: </label>
                    <select name="idubicacion" id="idubicacion">
                        <option value="">Seleccionar:</option>
                        <?php foreach($ubicaciones as $ubicacion): ?>
                            <option value="<?php echo $ubicacion['idubicacion']; ?>">
                                <?php echo $ubicacion['ubicacion']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <p class="alert alert-danger" id="ubi" name="ubi" style="display: none;">
                        Favor de seleccionar una ubicacion
                    </p>
                    <label>Color que tiene el insumo: </label>
                    <select name="idcolor" id="idcolor">
                        <option value="">Seleccionar:</option>
                        <?php foreach($colores as $color): ?>
                            <option value="<?php echo $color['idcolor']; ?>">
                                <?php echo $color['color']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="alert alert-danger" id="col" name="col" style="display: none;">
                        Favor de seleccionar un color
                    </p>
                          
                    
                    <label>Transparencia del insumo (si es que tiene): </label>
                    <select name="idtransparencia" id="idtransparencia">
                        <option value="">Seleccionar:</option>
                        <?php foreach($transparencias as $transparencia): ?>
                            <option value="<?php echo $transparencia['idtransparencia']; ?>">
                                <?php echo $transparencia['transparencia']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="alert alert-danger" id="trans" name="trans" style="display: none;">
                        Favor de seleccionar una transparencia
                    </p>
                          
                    
                    <label>Acabado superficial que tiene el insumo: </label>
                    <select name="idacabado" id="idacabado">
                        <option value="">Seleccionar:</option>
                        <?php foreach($acabados as $acabado): ?>
                            <option value="<?php echo $acabado['idacabado']; ?>">
                                <?php echo $acabado['acabado']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="alert alert-danger" id="aca" name="aca" style="display: none;">
                        Favor de seleccionar un acabado
                    </p>
                          
                    
                    <label>Presentación en la que viene el insumo: </label>
                    <select name="idpresentacion" id="idpresentacion">
                        <option value="">Seleccionar:</option>
                        <?php foreach($presentaciones as $presentacion): ?>
                            <option value="<?php echo $presentacion['idpresentacion']; ?>">
                                <?php echo $presentacion['presentacion']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="alert alert-danger" id="pres" name="pres" style="display: none;">
                        Favor de seleccionar una presentacion
                    </p>
                          
                    
                    <label>Tipo de medida que tiene el insumo: </label>
                    <select name="idtipomedida" id="idtipomedida">
                        <option value="">Seleccionar:</option>
                        <?php foreach($tiposmedidas as $tipomedida): ?>
                            <option value="<?php echo $tipomedida['idtipomedida']; ?>">
                                <?php echo $tipomedida['tipomedida']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="alert alert-danger" id="tmed" name="tmed" style="display: none;">
                        Favor de seleccionar un tipo de medida
                    </p>
                          
                    <label>Medida del insumo: </label>
                    <select name="idmedida" id="idmedida">
                        <option value="">Seleccionar:</option>
                        <?php foreach($medidas as $medida): ?>
                            <option value="<?php echo $medida['idmedida']; ?>">
                                <?php echo $medida['medida']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="alert alert-danger" id="med" name="med" style="display: none;">
                        Favor de seleccionar una medida
                    </p>
                          
                    
                    <label>Grosor del insumo: </label>
                    <select name="idgrosor" id="idgrosor">
                        <option value="">Seleccionar:</option>
                        <?php foreach($grosores as $grosor): ?>
                            <option value="<?php echo $grosor['idgrosor']; ?>">
                                <?php echo $grosor['grosor']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="alert alert-danger" id="gro" name="gro" style="display: none;">
                        Favor de seleccionar un grosor
                    </p>
                          
                    
                    <label>Material del que esta compuesto el insumo: </label>
                    <select name="idmaterial" id="idmaterial">
                        <option value="">Seleccionar:</option>
                        <?php foreach($materiales as $material): ?>
                            <option value="<?php echo $material['idmaterial']; ?>">
                                <?php echo $material['material']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="alert alert-danger" id="mat" name="mat" style="display: none;">
                        Favor de seleccionar un material
                    </p>
                          
                    
                    <label>Proveedor:  </label>
                    <select name="idproveedor" id="idproveedor">
                        <option value="">Seleccionar:</option>
                        <?php foreach($proveedores as $proveedor): ?>
                            <option value="<?php echo $proveedor['idproveedor']; ?>">
                                <?php echo $proveedor['proveedor']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="alert alert-danger" id="pro" name="pro" style="display: none;">
                        Favor de seleccionar un proveedor
                    </p>
                          
                    
                    <label>Marca del insumo: </label>
                    <select name="idmarca" id="idmarca">
                        <option value="">Seleccionar:</option>
                        <?php foreach($marcas as $marca): ?>
                            <option value="<?php echo $marca['idmarca']; ?>">
                                <?php echo $marca['marca']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="alert alert-danger" id="mar" name="mar" style="display: none;">
                        Favor de seleccionar una marca
                    </p>
                          
                    
                    <label>Submaterial del insumo: </label>
                    <select name="idsubmaterial" id="idsubmaterial">
                        <option value="">Seleccionar:</option>
                        <?php foreach($tiposmateriales as $submaterial): ?>
                            <option value="<?php echo $submaterial['idsubmaterial']; ?>">
                                <?php echo $submaterial['submaterial']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="alert alert-danger" id="sub" name="subma" style="display: none;">
                        Favor de seleccionar un submaterial
                    </p>
                          
                    
                    
            <button type="submit" >Guardar
            <img src="../Vista/img/guardar.png" alt="Guardar" style="width: 30px; height: 30px;"></button>
            <p class="alert alert-success" id="btne" name="btne" style="display: none;">
                Procesando datos
            </p> 
            <script src="../Controlador/js/validaciones.js"></script>
        </form>

        <!--Botón para cancelar y regresa al listado de insumo-->
 <button type="button" onclick="window.location.href='../Vista/buscarInsumoVE.php'">
        Cancelar
        <img src="../Vista/img/cancelar.png" alt="Cancelar" style="width: 30px; height: 30px;">
    </button>
</div>
</div>
<?php
}else{
  header("Location:login.php");
}
?>