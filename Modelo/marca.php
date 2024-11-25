<?php

/**Se realiza el llamado a nuestra conexión de la BD */
require_once 'conector/scriptdb.php';

/**Crear clase de empleado, en donde se encontrarán todos sus procesos
 * y funcionalidades de la gestion
 */
class Marca
{
    private $conn;

    /**para establecer la conexión a la bd */
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    /**función para obtener todos los marca*/
    public function obtenerMarcas()
    {
        $query = "select * from marca";
        $resultado = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    /**función para agregar nuevos marca */
    public function agregaMarca($nombre, $descripcion)
    {
        $query = "insert into marca (nomMarca, descripcion) values ('$nombre','$descripcion');";
        return mysqli_query($this->conn, $query);
    }

    /**Funcion para buscar marca dependiendo el criterio del usuario */
    public function buscarMarcaPorCriterio($busqueda, $valor)
    {
        /**Arreglo que contiene las posibles opciones de busqueda */
        $busquedaPermitida = ['nomMarca', 'descripcion'];
        if (!in_array($busqueda, $busquedaPermitida)) {
            return $this->obtenerMarcas();
            /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
        }

        $valor = mysqli_real_escape_string($this->conn, $valor);
        $query = "select * from marca where $busqueda like '%$valor%';";
        $execute = mysqli_query($this->conn, $query);

        return mysqli_fetch_all($execute, MYSQLI_ASSOC);
    }

    /**función para actualizar un marca*/
    public function actualizarMarca($id, $nombre, $descripcion)
    {
        $query = "update marca set nomMarca= '$nombre', descripcion = '$descripcion'
            where idmarca = $id; ";
        return mysqli_query($this->conn, $query);
    }

    public function eliminarMarca($id)
    {
        $query = "delete from marca where idmarca=$id;";
        return mysqli_query($this->conn, $query);
    }
    public function obtenerMarcaID()
    {
        $query = "select idmarca, nomMarca as marca from marca;";
        $exe = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($exe, MYSQLI_ASSOC);
    }

    public function obtenerMarca($marca)
    {
        $sql = "select nomMarca from marca where nomMarca in('$marca'); ";
        $exec = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($exec);
    }
    public function obtenerMarcaparaInsumos()
    {
        $sql = "select idmarca, nomMarca as marca from marca";
        $result = mysqli_query($this->conn, $sql);
        $marcas = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $marcas[] = $row;
        }
        return $marcas;
    }
}
