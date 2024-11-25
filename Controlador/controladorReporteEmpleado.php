<?php

require_once '../Modelo/modelopedido.php';

class controladorReporteEmpleado{
    private $pedido;

    public function __construct(){
        $this->pedido = new Pedido();
    }

    public function contabilizarPedidos($busqueda, $valor1, $valor2){
        return $this->pedido->contabilizarPedidosFecha($busqueda, $valor1, $valor2);
    }

    public function procesarBusqueda(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $busqueda = $_POST['busqueda'];
            $valor1 = $_POST['valor1'];
            $valor2 = $_POST['valor2'];
            $resultados = $this->contabilizarPedidos($busqueda, $valor1, $valor2);
            include '../Vista/Reportes.php';
        }
    }
}

    if(isset($_GET['accion'])){
        $controlador = new controladorReporteEmpleado();

        switch($_GET['accion']){
            case 'buscar':
                $controlador->procesarBusqueda();
                break;            
            default:
                header("Location: ../Vista/Reportes.php");
                break;
        }
    }



?>