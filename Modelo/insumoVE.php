
<?php
    /**Se realiza el llamado a nuestra conexión de la BD */
    require_once 'conector/scriptdb.php';

    /**Crear clase de usuario, en donde se encontrarán todos sus procesos
     * y funcionalidades de la gestion
     */
    class InsumoVE{
        private $conn;

        /**para establecer la conexión a la bd */
        public function __construct(){
            global $conn;
            $this->conn = $conn; 
        }

        public function obtenerInsumos(){
            $query = "select * from insumos;";
            $resultado = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
        }

        /**función para agregar nuevos usuarios */
        public function agregarInsumo($nomInsumo,$fechacompra,$fechauso, $cantidad,$rendimiento,
        $precio,$disponibilidad, $idubicacion, $idcolor, $idtransparencia,$idacabado,$idpresentacion,
        $idtipomedida,$idmedida,$idgrosor,$idmaterial,$idproveedor,$idmarca,$idsubmaterial){
            $query = "insert into insumos (nomInsumo, fechacompra, fechauso,
            cantidad,rendimiento,precio,disponibilidad, idubicacion, idcolor, idtransparencia,idacabado,idpresentacion,
        idtipomedida,idmedida,idgrosor,idmaterial,idproveedor,idmarca,idsubmaterial) values ('$nomInsumo','$fechacompra',
        '$fechauso', '$cantidad','$rendimiento','$precio','$disponibilidad', $idubicacion, $idcolor, $idtransparencia,$idacabado,$idpresentacion,
        $idtipomedida,$idmedida,$idgrosor,$idmaterial,$idproveedor,$idmarca,$idsubmaterial);";
            return mysqli_query($this->conn, $query);
        }

        /**Funcion para buscar usuarios dependiendo el criterio del usuario */
       public function buscarInsumoPorCriterio($busqueda, $valor){
            $valor = mysqli_real_escape_string($this->conn, $valor);
            if($busqueda == 'idubicacion'){
                $query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
                insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad 
                CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS ubicacion,
                color.nomColor AS color,transparencia.nomTransparencia AS transparencia,
                insumos.idacabado, acabado.nomAcabado AS acabado, presentacion.nomPresentacion AS presentacion, 
                CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS tipomedida, 
                CONCAT(medida.largo, 'x', medida.ancho) AS medida,
                concat(grosor.nomGrosor,' ',grosor.unidadMedida) AS grosor, material.nomMaterial AS material,
                proveedor.NomProveedor AS proveedor,
                marca.nomMarca AS marca, submaterial.nomSubmaterial AS submaterial
                FROM insumos
                INNER JOIN color ON color.idcolor = insumos.idcolor
                INNER JOIN transparencia ON transparencia.idtransparencia = insumos.idtransparencia
                INNER JOIN acabado ON acabado.idacabado = insumos.idacabado
                INNER JOIN presentacion ON presentacion.idpresentacion = insumos.idpresentacion
                INNER JOIN tipomedida ON tipomedida.idtipomedida = insumos.idtipomedida
                INNER JOIN medida ON medida.idmedida = insumos.idmedida
                INNER JOIN grosor ON grosor.idgrosor = insumos.idgrosor
                INNER JOIN material ON material.idmaterial = insumos.idmaterial
                INNER JOIN proveedor ON proveedor.idproveedor = insumos.idproveedor
                INNER JOIN marca ON marca.idmarca = insumos.idmarca
                INNER JOIN submaterial ON submaterial.idsubmaterial = insumos.idsubmaterial
                INNER JOIN ubicacion ON ubicacion.idubicacion = insumos.idubicacion
                WHERE 
                 CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ',
                  ubicacion.division3) LIKE '%$valor%';";
            } else  if($busqueda == 'idcolor'){
                $query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
                insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad, 
                CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS ubicacion,
                color.nomColor AS color,transparencia.nomTransparencia AS transparencia,
                acabado.nomAcabado AS acabado,presentacion.nomPresentacion AS presentacion, 
                CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS tipomedida, 
                 CONCAT(medida.largo, 'x', medida.ancho) AS medida,
                grosor.nomGrosor AS grosor,material.nomMaterial AS material, 
                proveedor.NomProveedor AS proveedor,
                marca.nomMarca AS marca, submaterial.nomSubmaterial AS submaterial
                FROM insumos
                INNER JOIN ubicacion ON ubicacion.idubicacion = insumos.idubicacion
                INNER JOIN transparencia ON transparencia.idtransparencia = insumos.idtransparencia
                INNER JOIN acabado ON acabado.idacabado = insumos.idacabado
                INNER JOIN presentacion ON presentacion.idpresentacion = insumos.idpresentacion
                INNER JOIN tipomedida ON tipomedida.idtipomedida = insumos.idtipomedida
                INNER JOIN medida ON medida.idmedida = insumos.idmedida
                INNER JOIN grosor ON grosor.idgrosor = insumos.idgrosor
                INNER JOIN material ON material.idmaterial = insumos.idmaterial
                INNER JOIN proveedor ON proveedor.idproveedor = insumos.idproveedor
                INNER JOIN marca ON marca.idmarca = insumos.idmarca
                INNER JOIN submaterial ON submaterial.idsubmaterial = insumos.idsubmaterial
                INNER JOIN color ON color.idcolor = insumos.idcolor
                WHERE color.nomColor LIKE '%$valor%';";
            } else  if($busqueda == 'idtransparencia'){

                $query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
                insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad,
                CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS ubicacion,
                color.nomColor AS color,  transparencia.nomTransparencia AS transparencia,
                acabado.nomAcabado AS acabado,presentacion.nomPresentacion AS presentacion, 
                CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS tipomedida, 
                 CONCAT(medida.largo, 'x', medida.ancho) AS medida, insumos.idgrosor, 
                grosor.nomGrosor AS grosor, material.nomMaterial AS material,
                proveedor.NomProveedor AS proveedor,
                 marca.nomMarca AS marca,  submaterial.nomSubmaterial AS submaterial
                FROM insumos
                INNER JOIN ubicacion ON ubicacion.idubicacion = insumos.idubicacion
                INNER JOIN color ON color.idcolor = insumos.idcolor
                INNER JOIN acabado ON acabado.idacabado = insumos.idacabado
                INNER JOIN presentacion ON presentacion.idpresentacion = insumos.idpresentacion
                INNER JOIN tipomedida ON tipomedida.idtipomedida = insumos.idtipomedida
                INNER JOIN medida ON medida.idmedida = insumos.idmedida
                INNER JOIN grosor ON grosor.idgrosor = insumos.idgrosor
                INNER JOIN material ON material.idmaterial = insumos.idmaterial
                INNER JOIN proveedor ON proveedor.idproveedor = insumos.idproveedor
                INNER JOIN marca ON marca.idmarca = insumos.idmarca
                INNER JOIN submaterial ON submaterial.idsubmaterial = insumos.idsubmaterial
                INNER JOIN transparencia ON transparencia.idtransparencia = insumos.idtransparencia
                WHERE transparencia.nomTransparencia LIKE '%$valor%';";

                
            } else if($busqueda == 'idacabado'){

                $query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
                insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad, 
                CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS ubicacion,
                 color.nomColor AS color,  transparencia.nomTransparencia AS transparencia,
               acabado.nomAcabado AS acabado, presentacion.nomPresentacion AS presentacion, 
                CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS tipomedida, 
                 CONCAT(medida.largo, 'x', medida.ancho) AS medida,
                grosor.nomGrosor AS grosor, material.nomMaterial AS material,
                proveedor.NomProveedor AS proveedor,
                 marca.nomMarca AS marca,   submaterial.nomSubmaterial AS submaterial
                FROM insumos
                INNER JOIN ubicacion ON ubicacion.idubicacion = insumos.idubicacion
                INNER JOIN color ON color.idcolor = insumos.idcolor
                INNER JOIN transparencia ON transparencia.idtransparencia = insumos.idtransparencia
                INNER JOIN presentacion ON presentacion.idpresentacion = insumos.idpresentacion
                INNER JOIN tipomedida ON tipomedida.idtipomedida = insumos.idtipomedida
                INNER JOIN medida ON medida.idmedida = insumos.idmedida
                INNER JOIN grosor ON grosor.idgrosor = insumos.idgrosor
                INNER JOIN material ON material.idmaterial = insumos.idmaterial
                INNER JOIN proveedor ON proveedor.idproveedor = insumos.idproveedor
                INNER JOIN marca ON marca.idmarca = insumos.idmarca
                INNER JOIN submaterial ON submaterial.idsubmaterial = insumos.idsubmaterial
                INNER JOIN acabado ON acabado.idacabado = insumos.idacabado
                WHERE acabado.nomAcabado LIKE '%$valor%';";
            }
            else if($busqueda == 'idpresentacion'){
                $query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
                insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad, 
                CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS ubicacion,
                color.nomColor AS color,  transparencia.nomTransparencia AS transparencia,
                acabado.nomAcabado AS acabado, insumos.idpresentacion, presentacion.nomPresentacion AS presentacion, 
                CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS tipomedida, 
                CONCAT(medida.largo, 'x', medida.ancho) AS medida,
                grosor.nomGrosor AS grosor,material.nomMaterial AS material, 
                proveedor.NomProveedor AS proveedor,
                marca.nomMarca AS marca,   submaterial.nomSubmaterial AS submaterial
                FROM insumos
                INNER JOIN ubicacion ON ubicacion.idubicacion = insumos.idubicacion
                INNER JOIN color ON color.idcolor = insumos.idcolor
                INNER JOIN transparencia ON transparencia.idtransparencia = insumos.idtransparencia
                 INNER JOIN acabado ON acabado.idacabado = insumos.idacabado
                INNER JOIN tipomedida ON tipomedida.idtipomedida = insumos.idtipomedida
                INNER JOIN medida ON medida.idmedida = insumos.idmedida
                INNER JOIN grosor ON grosor.idgrosor = insumos.idgrosor
                INNER JOIN material ON material.idmaterial = insumos.idmaterial
                INNER JOIN proveedor ON proveedor.idproveedor = insumos.idproveedor
                INNER JOIN marca ON marca.idmarca = insumos.idmarca
                INNER JOIN submaterial ON submaterial.idsubmaterial = insumos.idsubmaterial
                INNER JOIN presentacion ON presentacion.idpresentacion = insumos.idpresentacion
                WHERE presentacion.nomPresentacion LIKE '%$valor%';";
            }
            else if($busqueda == 'idtipomedida'){

                $query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
                insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad, 
                CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS ubicacion,
                color.nomColor AS color, transparencia.nomTransparencia AS transparencia,
                acabado.nomAcabado AS acabado, insumos.idpresentacion, presentacion.nomPresentacion AS presentacion, 
                CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS tipomedida, 
                 CONCAT(medida.largo, 'x', medida.ancho) AS medida,
                grosor.nomGrosor AS grosor, material.nomMaterial AS material, 
                proveedor.NomProveedor AS proveedor,
                marca.nomMarca AS marca,  submaterial.nomSubmaterial AS submaterial
                FROM insumos
                INNER JOIN ubicacion ON ubicacion.idubicacion = insumos.idubicacion
                INNER JOIN color ON color.idcolor = insumos.idcolor
                INNER JOIN transparencia ON transparencia.idtransparencia = insumos.idtransparencia
                 INNER JOIN acabado ON acabado.idacabado = insumos.idacabado
                INNER JOIN presentacion ON presentacion.idpresentacion = insumos.idpresentacion
                INNER JOIN medida ON medida.idmedida = insumos.idmedida
                INNER JOIN grosor ON grosor.idgrosor = insumos.idgrosor
                INNER JOIN material ON material.idmaterial = insumos.idmaterial
                INNER JOIN proveedor ON proveedor.idproveedor = insumos.idproveedor
                INNER JOIN marca ON marca.idmarca = insumos.idmarca
                INNER JOIN submaterial ON submaterial.idsubmaterial = insumos.idsubmaterial
                 INNER JOIN tipomedida ON tipomedida.idtipomedida = insumos.idtipomedida
                WHERE CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) LIKE '%$valor%';";
            }
            else if($busqueda == 'idmedida'){
                
                $query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
                insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad,
                CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS ubicacion,
                color.nomColor AS color,  transparencia.nomTransparencia AS transparencia,
                acabado.nomAcabado AS acabado, insumos.idpresentacion, presentacion.nomPresentacion AS presentacion, 
                CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS tipomedida, 
                CONCAT(medida.largo, 'x', medida.ancho) AS medida, 
                grosor.nomGrosor AS grosor, material.nomMaterial AS material, 
                proveedor.NomProveedor AS proveedor,
                marca.nomMarca AS marca,  submaterial.nomSubmaterial AS submaterial
                FROM insumos
                INNER JOIN ubicacion ON ubicacion.idubicacion = insumos.idubicacion
                INNER JOIN color ON color.idcolor = insumos.idcolor
                INNER JOIN transparencia ON transparencia.idtransparencia = insumos.idtransparencia
                 INNER JOIN acabado ON acabado.idacabado = insumos.idacabado
                INNER JOIN presentacion ON presentacion.idpresentacion = insumos.idpresentacion
                INNER JOIN tipomedida ON tipomedida.idtipomedida = insumos.idtipomedida
                INNER JOIN grosor ON grosor.idgrosor = insumos.idgrosor
                INNER JOIN material ON material.idmaterial = insumos.idmaterial
                INNER JOIN proveedor ON proveedor.idproveedor = insumos.idproveedor
                INNER JOIN marca ON marca.idmarca = insumos.idmarca
                INNER JOIN submaterial ON submaterial.idsubmaterial = insumos.idsubmaterial
                INNER JOIN medida ON medida.idmedida = insumos.idmedida
                WHERE CONCAT(medida.largo, ' ', medida.ancho) LIKE '%$valor%';";
            }
            else if($busqueda == 'idgrosor'){

                $query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
                insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad, 
                CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS ubicacion,
                 color.nomColor AS color, transparencia.nomTransparencia AS transparencia,
                 acabado.nomAcabado AS acabado,  presentacion.nomPresentacion AS presentacion, 
                 CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS tipomedida, 
                 CONCAT(medida.largo, ' x ', medida.ancho) AS medida, 
                CONCAT(grosor.cantGrosor,' ',grosor.unidadMedida ) AS grosor, material.nomMaterial AS material, 
                proveedor.NomProveedor AS proveedor,
                 marca.nomMarca AS marca, submaterial.nomSubmaterial AS submaterial
                FROM insumos
                INNER JOIN ubicacion ON ubicacion.idubicacion = insumos.idubicacion
                INNER JOIN color ON color.idcolor = insumos.idcolor
                INNER JOIN transparencia ON transparencia.idtransparencia = insumos.idtransparencia
                 INNER JOIN acabado ON acabado.idacabado = insumos.idacabado
                INNER JOIN presentacion ON presentacion.idpresentacion = insumos.idpresentacion
                INNER JOIN tipomedida ON tipomedida.idtipomedida = insumos.idtipomedida
                INNER JOIN medida ON medida.idmedida = insumos.idmedida
                INNER JOIN material ON material.idmaterial = insumos.idmaterial
                INNER JOIN proveedor ON proveedor.idproveedor = insumos.idproveedor
                INNER JOIN marca ON marca.idmarca = insumos.idmarca
                INNER JOIN submaterial ON submaterial.idsubmaterial = insumos.idsubmaterial
                INNER JOIN grosor ON grosor.idgrosor = insumos.idgrosor
                WHERE CONCAT(grosor.cantGrosor,' ',grosor.unidadMedida )  LIKE '%$valor%';";
            }
            else if($busqueda == 'idmaterial'){

                $query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
                insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad, 
                CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS ubicacion,
                color.nomColor AS color, transparencia.nomTransparencia AS transparencia,
                 acabado.nomAcabado AS acabado, presentacion.nomPresentacion AS presentacion, 
                 CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS tipomedida, 
                 CONCAT(medida.largo, 'x', medida.ancho) AS medida,
                grosor.nomGrosor AS grosor, material.nomMaterial AS material, 
                proveedor.NomProveedor AS proveedor,
                 marca.nomMarca AS marca,   submaterial.nomSubmaterial AS submaterial
                FROM insumos
                INNER JOIN ubicacion ON ubicacion.idubicacion = insumos.idubicacion
                INNER JOIN color ON color.idcolor = insumos.idcolor
                INNER JOIN transparencia ON transparencia.idtransparencia = insumos.idtransparencia
                 INNER JOIN acabado ON acabado.idacabado = insumos.idacabado
                INNER JOIN presentacion ON presentacion.idpresentacion = insumos.idpresentacion
                INNER JOIN tipomedida ON tipomedida.idtipomedida = insumos.idtipomedida
                INNER JOIN medida ON medida.idmedida = insumos.idmedida
                INNER JOIN grosor ON grosor.idgrosor = insumos.idgrosor
                INNER JOIN proveedor ON proveedor.idproveedor = insumos.idproveedor
                INNER JOIN marca ON marca.idmarca = insumos.idmarca
                INNER JOIN submaterial ON submaterial.idsubmaterial = insumos.idsubmaterial
                INNER JOIN material ON material.idmaterial = insumos.idmaterial
                WHERE material.nomMaterial LIKE '%$valor%';";
            }
            else if($busqueda == 'idproveedor'){

                $query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
                insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad,
                CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS ubicacion,
                color.nomColor AS color,  transparencia.nomTransparencia AS transparencia,
                acabado.nomAcabado AS acabado,  presentacion.nomPresentacion AS presentacion, 
                CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS tipomedida, 
               CONCAT(medida.largo, 'x', medida.ancho) AS medida, 
                grosor.nomGrosor AS grosor, material.nomMaterial AS material, 
                proveedor.NomProveedor AS proveedor,
                 marca.nomMarca AS marca,  submaterial.nomSubmaterial AS submaterial
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
                INNER JOIN proveedor ON proveedor.idproveedor = insumos.idproveedor
                WHERE proveedor.NomProveedor LIKE '%$valor%';";
            }
            else if($busqueda == 'idmarca'){


                $query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
                insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad,
                CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS ubicacion,
                , color.nomColor AS color,   transparencia.nomTransparencia AS transparencia,
                 acabado.nomAcabado AS acabado,  presentacion.nomPresentacion AS presentacion, 
                 CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS tipomedida, 
                 CONCAT(medida.largo, 'x', medida.ancho) AS medida, 
                grosor.nomGrosor AS grosor, material.nomMaterial AS material, 
                proveedor.NomProveedor AS proveedor,
                 marca.nomMarca AS marca, submaterial.nomSubmaterial AS submaterial
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
                INNER JOIN submaterial ON submaterial.idsubmaterial = insumos.idsubmaterial
                INNER JOIN marca ON marca.idmarca = insumos.idmarca
               
                WHERE marca.nomMarca LIKE '%$valor%';";
            }
            else if($busqueda == 'idsubmaterial'){


                $query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
                insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad, 
                CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS ubicacion,
                color.nomColor AS color,  transparencia.nomTransparencia AS transparencia,
                 acabado.nomAcabado AS acabado,  presentacion.nomPresentacion AS presentacion, 
                 CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS tipomedida, 
                 CONCAT(medida.largo, 'x', medida.ancho) AS medida, 
                grosor.nomGrosor AS grosor, material.nomMaterial AS material
                proveedor.NomProveedor AS proveedor,
                 marca.nomMarca AS marca,   submaterial.nomSubmaterial AS submaterial
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
                WHERE submaterial.nomSubmaterial LIKE '%$valor%';";
            }
            else{

                $query = "SELECT insumos.idinsumos, insumos.nomInsumo, insumos.fechacompra, insumos.fechauso,
                insumos.cantidad, insumos.rendimiento, insumos.precio, insumos.disponibilidad, 
                CONCAT(ubicacion.mueble, ' ', ubicacion.division1, ' ', ubicacion.division2, ' ', ubicacion.division3) AS ubicacion
                 , color.nomColor AS color, transparencia.nomTransparencia AS transparencia,
                acabado.nomAcabado AS acabado,  presentacion.nomPresentacion AS presentacion, 
                 CONCAT(tipomedida.nomTipomedida, ' ', tipomedida.unidad) AS tipomedida, 
                 CONCAT(medida.largo, 'x', medida.ancho) AS medida,  concat(
                grosor.cantGrosor, ' ', grosor.unidadMedida) AS grosor, material.nomMaterial AS material,
                proveedor.NomProveedor AS proveedor,
                 marca.nomMarca AS marca,  submaterial.nomSubmaterial AS submaterial
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
                WHERE $busqueda like '%$valor%';";
            }
            
            $resultado = mysqli_query($this->conn, $query);                   
            return mysqli_fetch_all($resultado, MYSQLI_ASSOC);

        }        
       
        
        /**función para actualizar un usuario */
        public function actualizarInsumo($id,$nomInsumo,$fechacompra,$fechauso, $cantidad,$rendimiento,
        $precio,$disponibilidad, $idubicacion, $idcolor, $idtransparencia,$idacabado,$idpresentacion,
        $idtipomedida,$idmedida,$idgrosor,$idmaterial,$idproveedor,$idmarca,$idsubmaterial){
            $id = intval($id);
            $nomInsumo = mysqli_real_escape_string($this->conn, $nomInsumo);
            $fechacompra= mysqli_real_escape_string($this->conn, $fechacompra);
            $fechauso= mysqli_real_escape_string($this->conn, $fechauso);
            $cantidad= intval($cantidad);
            $rendimiento= mysqli_real_escape_string($this->conn, $rendimiento);
            $precio= mysqli_real_escape_string($this->conn, $precio);
            $disponibilidad= mysqli_real_escape_string($this->conn, $disponibilidad);
            $idubicacion = intval($idubicacion);
            $idcolor = intval($idcolor);
            $idtransparencia = intval($idtransparencia);
            $idacabado = intval($idacabado);
            $idpresentacion = intval($idpresentacion);
            $idtipomedida= intval($idtipomedida);
            $idmedida = intval($idmedida);
            $idgrosor = intval($idgrosor);
            $idmaterial = intval($idmaterial);
            $idproveedor = intval($idproveedor);
            $idmarca = intval($idmarca);
            $idsubmaterial = intval($idsubmaterial); // Asegurarse de que sea un entero

            $query = "update insumos set nomInsumos = '$nomInsumo', fechacompra = '$fechacompra', 
            fechauso = '$fechauso', cantidad = '$cantidad', rendimiento = '$rendimiento', precio = '$precio',
            disponibilidad = '$disponibilidad', idubicacion = '$idubicacion', idcolor = '$idcolor',
            idtransparencia = '$idtransparencia', idacabado = '$idacabado', idpresentacion = '$idtipomedida',
            idmedida = '$idmedida', idgrosor = '$idgrosor', idmaterial = '$idmaterial',idproveedor = '$idproveedor',
            idsubmaterial = '$idsubmaterial'  where idinsumos = $id; ";
            return mysqli_query($this->conn, $query);   
        }

        public function eliminarInsumo($id){
            $query = "delete from insumos where idinsumos=$id;";
            return mysqli_query($this->conn, $query);
        }

        
        public function obtenerInsumoID(){
            $query = "select idinsumos, concat(nomInsumo, ' ', fechacompra, ' ' , disponibilidad) as insumos from insumos;";
            $exe = mysqli_query($this->conn, $query);
            return mysqli_fetch_all($exe, MYSQLI_ASSOC);
        }
            

        public function obtenerInsumosparaBajas() {
            $sql = "select idinsumos, concat(nomInsumo, ' ', fechacompra, ' ', disponibilidad) as insumos from insumos";
            $result = mysqli_query($this->conn, $sql);
            $empleados = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $empleados[] = $row;
            }
            return $empleados;
        }

        

    }


?>