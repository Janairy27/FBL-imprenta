<?php

require_once '../Modelo/insumo.php';

class controladorReporteInsumo{
    private $insumo;

    public function __construct(){
        $this->insumo = new Insumo();
    }

    public function reporteInsumo($busqueda, $valor1){
        return $this->insumo->reporteInsumo($busqueda, $valor1);
    }

    public function procesarBusqueda(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $busqueda = $_POST['busqueda'];
            $valor1 = $_POST['valor1'];
            $resultados = $this->reporteInsumo($busqueda, $valor1);
            include '../Vista/reporteIns.php';
        }
    }
}

    if(isset($_GET['accion'])){
        $controlador = new controladorReporteInsumo();

        switch($_GET['accion']){
            case 'buscar':
                $controlador->procesarBusqueda();
                break;            
            default:
                header("Location: ../Vista/reporteIns.php");
                break;
        }
    }



?>