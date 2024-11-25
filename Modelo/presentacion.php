<?php

/**Se realiza el llamado a nuestra conexión de la BD */
require_once 'conector/scriptdb.php';

/**Crear clase de empleado, en donde se encontrarán todos sus procesos
 * y funcionalidades de la gestion
 */
class Presentacion
{
    private $conn;

    /**para establecer la conexión a la bd */
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    /**función para obtener todos los presentacion */
    public function obtenerPresentaciones()
    {
        $query = "select * from presentacion";
        $resultado = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    /**función para agregar nuevos presentacion */
    public function agregaPresentacion($nombre)
    {
        $query = "insert into presentacion (nomPresentacion) values ('$nombre');";
        return mysqli_query($this->conn, $query);
    }

    /**Funcion para buscar presentacion dependiendo el criterio del usuario */
    public function buscarPresentacionPorCriterio($busqueda, $valor)
    {
        /**Arreglo que contiene las posibles opciones de busqueda */
        $busquedaPermitida = ['nomPresentacion'];
        if (!in_array($busqueda, $busquedaPermitida)) {
            return $this->obtenerPresentaciones();
            /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
        }

        $valor = mysqli_real_escape_string($this->conn, $valor);
        $query = "select * from presentacion where $busqueda like '%$valor%';";
        $execute = mysqli_query($this->conn, $query);

        return mysqli_fetch_all($execute, MYSQLI_ASSOC);
    }

    /**función para actualizar un presentacion */
    public function actualizarPresentacion($id, $nombre)
    {
        $query = "update presentacion set nomPresentacion = '$nombre'  
            where idpresentacion = $id; ";
        return mysqli_query($this->conn, $query);
    }

    public function eliminarPresentacion($id)
    {
        $query = "delete from presentacion where idpresentacion =$id;";
        return mysqli_query($this->conn, $query);
    }
    public function obtenerPresentacionID()
    {
        $query = "select idpresentacion, nomPresentacion as presentacion from presentacion;";
        $exe = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($exe, MYSQLI_ASSOC);
    }



    public function obtenerPresentacion($presentacion)
    {
        $sql = "select nomPresentacion from presentacion where nomPresentacion in('$presentacion'); ";
        $exec = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($exec);
    }
    public function obtenerPresentacionparaInsumos()
    {
        $sql = "select idpresentacion, nomPresentacion as presentacion from presentacion";
        $result = mysqli_query($this->conn, $sql);
        $presentaciones = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $presentaciones[] = $row;
        }
        return $presentaciones;
    }
}
