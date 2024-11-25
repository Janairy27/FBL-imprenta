<?php

/**Se realiza el llamado a nuestra conexión de la BD */
require_once 'conector/scriptdb.php';

/**Crear clase de empleado, en donde se encontrarán todos sus procesos
 * y funcionalidades de la gestion
 */
class Medida
{
    private $conn;

    /**para establecer la conexión a la bd */
    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    /**función para obtener todos los medida */
    public function obtenerMedidas()
    {
        $query = "select * from medida";
        $resultado = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }

    /**función para agregar nuevos medida  */
    public function agregaMedida($largo, $ancho)
    {
        $query = "insert into medida (largo, ancho) values ('$largo','$ancho');";
        return mysqli_query($this->conn, $query);
    }

    /**Funcion para buscar medida  dependiendo el criterio del usuario */
    public function buscarMedidaPorCriterio($busqueda, $valor)
    {
        /**Arreglo que contiene las posibles opciones de busqueda */
        $busquedaPermitida = ['largo', 'ancho'];
        if (!in_array($busqueda, $busquedaPermitida)) {
            return $this->obtenerMedidas();
            /**Si el critero no corresponde, cosa que no pasará, no debuelbe nada  */
        }

        $valor = mysqli_real_escape_string($this->conn, $valor);
        $query = "select * from medida where $busqueda like '%$valor%';";
        $execute = mysqli_query($this->conn, $query);

        return mysqli_fetch_all($execute, MYSQLI_ASSOC);
    }

    /**función para actualizar un medida  */
    public function actualizarMedida($id, $largo, $ancho)
    {
        $query = "update medida set largo= '$largo',ancho ='$ancho'
            where idmedida = $id; ";
        return mysqli_query($this->conn, $query);
    }

    public function eliminarMedida($id)
    {
        $query = "delete from medida where idmedida=$id;";
        return mysqli_query($this->conn, $query);
    }
    public function obtenerMedidaID()
    {
        $query = "select idmedida, concat(largo, ' x ', ancho) as medida from medida;";
        $exe = mysqli_query($this->conn, $query);
        return mysqli_fetch_all($exe, MYSQLI_ASSOC);
    }



    public function validarMedida($largo, $ancho)
    {
        // Escapar los valores para evitar inyección SQL
        $ancho = mysqli_real_escape_string($this->conn, $ancho);
        $largo = mysqli_real_escape_string($this->conn, $largo);

        // Consulta para verificar la existencia
        $query = "SELECT COUNT(*) as total 
                      FROM medida 
                      WHERE concat(largo, ' x ', ancho) = concat('$largo', ' x ', '$ancho')";

        $resultado = mysqli_query($this->conn, $query);

        // Verificar si existe al menos un registro con la misma combinación
        $fila = mysqli_fetch_assoc($resultado);
        return $fila['total'] > 0;
    }
    public function obtenerMedidaparaInsumos()
    {
        $sql = "select idmedida, concat(largo, ' x ', ancho) as medida from medida";
        $result = mysqli_query($this->conn, $sql);
        $medidas = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $medidas[] = $row;
        }
        return $medidas;
    }
}
