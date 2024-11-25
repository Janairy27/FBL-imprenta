<?php

include_once '../Modelo/restauracion.php';

class controladorRestauracion
{
    private $restauracion;

    public function __construct()
    {
        $this->restauracion = new Restauracion();
    }

    public function obtenerRespaldos()
    {
        return $this->restauracion->obtenerRespaldos();
    }

    public function obtenerMensajes()
    {
        return $this->restauracion->obtenerMensajes();
    }

    public function procesarRestauracion($archivoRespaldo)
    {
        // Llamar al método de restauración y capturar los mensajes
        $this->restauracion->restaurarDB($archivoRespaldo);
        return $this->restauracion->obtenerMensajes();
    }
}

// Procesar la solicitud POST de la vista
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['archivoRespaldo'])) {
    $restauracion = new controladorRestauracion();

    // Procesar la restauración y obtener los mensajes
    $mensajes = $restauracion->procesarRestauracion($_POST['archivoRespaldo']);

    // Preparar el mensaje para la vista
    $message = implode('<br>', $mensajes);  // Unir todos los mensajes
    $type = (strpos($message, 'Error') === false) ? 'success' : 'danger';

    // Redirigir a la vista con el mensaje
    header('Location: ../Vista/respaldo&restauracion.php?message=' . urlencode($message) . '&type=' . $type);
    exit;
}
?>

