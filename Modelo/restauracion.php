<?php

class Restauracion
{
    private $directorio;
    private $mensajes = [];

    /**
     * Configuración de la dirección donde se estarán encontrando los respaldos.
     * 
     * @param string $respaldos Ruta del directorio de respaldos.
     */
    public function __construct($respaldos = '../Modelo/Respaldos/')
    {
        $this->directorio = rtrim($respaldos, '/') . '/';
    }

    /**
     * Obtiene los archivos de respaldo ordenados por fecha de modificación.
     * 
     * @return array Lista de rutas de los archivos de respaldo ordenados.
     */
    public function obtenerRespaldos()
    {
        $archivos = glob($this->directorio . "*.sql");

        if ($archivos === false) {
            $this->agregarMensaje("No se pudo acceder al directorio de respaldos.");
            return [];
        }

        usort($archivos, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });

        return $archivos;
    }

    /**
     * Realiza la restauración de la base de datos usando el archivo seleccionado.
     * 
     * @param string $archivoRespaldo Ruta completa del archivo de respaldo.
     */
    public function restaurarDB($archivoRespaldo)
    {
        if (!file_exists($archivoRespaldo)) {
            $this->agregarMensaje("El archivo de respaldo no existe: $archivoRespaldo");
            return;
        }
        /**
         * Traer los datos para la conexion a la base de datos
         */
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'imprenta';

        // Ruta predeterminada para MySQL en Windows (ajustar si es necesario)
        $ruta = '"C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysql"';

        // Comando para ejecutar la restauración
        $comando = "{$ruta} --host={$host} --user={$user} --password={$pass} {$db} < \"{$archivoRespaldo}\"";

        // Ejecutar el comando del sistema
        $retorno = null;
        system($comando, $retorno);

        // Validar el resultado de la restauración
        if ($retorno === 0) {
            $this->agregarMensaje("Restauración realizada con éxito.");
        } else {
            $this->agregarMensaje("Error:Ocurrió un error al realizar la restauración. Código de retorno: $retorno");
        }
    }

    /**
     * Agrega un mensaje al historial interno de mensajes.
     * 
     * @param string $mensaje Mensaje a agregar.
     */
    private function agregarMensaje($mensaje)
    {
        $this->mensajes[] = $mensaje;
    }

    /**
     * Obtiene todos los mensajes registrados.
     * 
     * @return array Lista de mensajes.
     */
    public function obtenerMensajes()
    {
        return $this->mensajes;
    }
}


?>