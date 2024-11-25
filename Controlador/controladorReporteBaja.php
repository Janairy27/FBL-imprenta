<?php

require_once '../Modelo/baja.php';

class controladorReporteBaja
{
    private $baja;

    public function __construct()
    {
        $this->baja = new Baja();
    }

    public function reporteBajaFecha($busqueda, $valor1, $valor2)
    {
        return $this->baja->reporteBajaFecha($busqueda, $valor1, $valor2);
    }

    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor1 = $_POST['valor1'];
            $valor2 = $_POST['valor2'];
            $resultados = $this->reporteBajaFecha($busqueda, $valor1, $valor2);
            include '../Vista/reporteBa.php';
        }
    }
}

if (isset($_GET['accion'])) {
    $controlador = new controladorReporteBaja();

    switch ($_GET['accion']) {
        case 'buscar':
            $controlador->procesarBusqueda();
            break;
        default:
            header("Location: ../Vista/reporteBa.php");
            break;
    }
}
