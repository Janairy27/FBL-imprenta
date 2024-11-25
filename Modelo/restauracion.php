<?php

class Restauracion
{
    private $directorio;
    private $mensajes = [];

    public function __construct($respaldos = '../Modelo/Respaldos/')
    {
        $this->directorio = $respaldos;
    }

    public function obtenerRespaldos()
    {
        $archivos = glob($this->directorio . "*.sql");

        if (!$archivos) {
            $this->agregarMensaje("No se encontraron archivos de respaldo.");
            return [];
        }

        usort($archivos, function ($a, $b) {
            return filemtime($b) - filemtime($a);
        });

        return $archivos;
    }

    public function restaurarDB($archivoRespaldo)
    {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db = 'imprenta';

        if (!file_exists($archivoRespaldo)) {
            $this->agregarMensaje("Error: El archivo de respaldo no existe.");
            return;
        }

        $os = PHP_OS;
        $ruta = '';

        if (stripos($os, 'WIN') === 0) {
            $ruta = '"C:\\Program Files\\MySQL\\MySQL Server 8.0\\bin\\mysql"';
        } elseif (stripos($os, 'Darwin') === 0) {
            $ruta = '/Applications/XAMPP/xamppfiles/bin/mysql';
        } elseif (stripos($os, 'Linux') === 0) {
            $ruta = '/usr/bin/mysql';
        } else {
            $this->agregarMensaje("Error: Sistema operativo no soportado.");
            return;
        }

        if (!file_exists($ruta)) {
            $this->agregarMensaje("Error: No se encuentra el archivo ejecutable de MySQL en la ruta especificada.");
            return;
        }

        $comando = sprintf(
            '%s --host=%s --user=%s --password=%s %s < %s',
            escapeshellcmd($ruta),
            escapeshellarg($host),
            escapeshellarg($user),
            escapeshellarg($pass),
            escapeshellarg($db),
            escapeshellarg($archivoRespaldo)
        );

        system($comando, $retorno);

        if ($retorno == 0) {
            $this->agregarMensaje("Restauración realizada con éxito.");
        } else {
            $this->agregarMensaje("Sucedió un error al hacer la restauración.");
        }
    }

    private function agregarMensaje($mensaje)
    {
        $this->mensajes[] = $mensaje;
    }

    public function obtenerMensajes()
    {
        return $this->mensajes;
    }
}


?>
