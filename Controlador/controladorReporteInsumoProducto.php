<?php

require_once '../Modelo/modelopedido.php';

class controladorReporteInsumoProducto
{
    private $inProd;

    public function __construct()
    {
        $this->inProd = new Pedido();
    }

    public function contabilizarInsumos($busqueda, $valor1, $valor2)
    {
        return $this->inProd->contabilizarInsumosFecha($busqueda, $valor1, $valor2);
    }

    public function procesarBusqueda()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $busqueda = $_POST['busqueda'];
            $valor1 = $_POST['valor1'];
            $valor2 = $_POST['valor2'];
            $resultados = $this->contabilizarInsumos($busqueda, $valor1, $valor2);
            include '../Vista/reportePedido.php';
        }
    }
}

if (isset($_GET['accion'])) {
    $controlador = new controladorReporteInsumoProducto();

    switch ($_GET['accion']) {
        case 'buscar':
            $controlador->procesarBusqueda();
            break;
        default:
            header("Location: ../Vista/reportePedido.php");
            break;
    }
}
