<?php

/**Se realiza el llamado a nuestra conexión de la BD */
require_once 'conector/scriptdb.php';

/**Crear clase de empleado, en donde se encontrarán todos sus procesos
 * y funcionalidades de la gestion
 */
class Material
{
    private $conn;

    /**para establecer la conexión a la bd */
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    /**función para obtener todos los material */
    public function obtenerMateriales()
    {
        $query = "select * from material";
        $resultado = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    /**función para agregar nuevos material */
    public function agregaMaterial($nombre)
    {
        $query = "insert into material (nomMaterial) values ('$nombre');";
        return mysqli_query($this->conn, $query);
    }

    /**Funcion para buscar material dependiendo el criterio del usuario */
    public function buscarMaterialPorCriterio($busqueda, $valor)
    {
        /**Arreglo que contiene las posibles opciones de busqueda */
        $busquedaPermitida = ['nomMaterial'];
        if (!in_array($busqueda, $busquedaPermitida)) {
            return $this->obtenerMateriales();
            /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
        }

        $valor = mysqli_real_escape_string($this->conn, $valor);
        $query = "select * from material where $busqueda like '%$valor%';";
        $execute = mysqli_query($this->conn, $query);

        return mysqli_fetch_all($execute, MYSQLI_ASSOC);
    }

    /**función para actualizar un material */
    public function actualizarMaterial($id, $nombre)
    {
        $query = "update material set nomMaterial= '$nombre'
            where idmaterial = $id; ";
        return mysqli_query($this->conn, $query);
    }

    public function eliminarMaterial($id)
    {
        $query = "delete from material where idmaterial=$id;";
        return mysqli_query($this->conn, $query);
    }
    public function obtenerMaterialID()
    {
        $query = "select idmaterial, nomMaterial as material from material;";
        $exe = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($exe, MYSQLI_ASSOC);
    }


    public function obtenerMaterial($material)
    {
        $sql = "select nomMaterial from material where nomMaterial in('$material'); ";
        $exec = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($exec);
    }
    public function obtenerMaterialparaInsumos()
    {
        $sql = "select idmaterial, nomMaterial as material from material";
        $result = mysqli_query($this->conn, $sql);
        $materiales = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $materiales[] = $row;
        }
        return $materiales;
    }
}
