
<?php

require_once '../Modelo/insumo.php';

class controladorReporteFechaInsumo{
    private $insumo;

    public function __construct(){
        $this->insumo = new Insumo();
    }

    public function reporteFechaInsumo($busqueda,$valor1,$valor2){
        return $this->insumo->reporteFechaInsumo($busqueda,$valor1,$valor2);
    }


    public function procesarBusqueda(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $busqueda = $_POST['busqueda'];
            $valor1 = $_POST['valor1'];
            $valor2 = $_POST['valor2'];
            $resultados = $this->reporteFechaInsumo($busqueda, $valor1, $valor2);
            include '../Vista/reporteFecha.php';
        }
    }
}

    if(isset($_GET['accion'])){
        $controlador = new controladorReporteFechaInsumo();

        switch($_GET['accion']){
            case 'buscar':
                $controlador->procesarBusqueda();
                break;            
            default:
                header("Location: ../Vista/reporteFecha.php");
                break;
        }

}
  



?>