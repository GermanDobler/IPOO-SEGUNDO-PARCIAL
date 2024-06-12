<?php

class EmpresaCable extends Contrato
{
    private $planes = [];
    private $contratos = [];

    public function __construct($fechaInicio, $fechaVencimiento, $viaWeb, $objPlan, $costo, $seRennueva, $objCliente, $planes, $contratos)
    {
        parent::__construct($fechaInicio, $fechaVencimiento, $viaWeb, $objPlan, $costo, $seRennueva, $objCliente);
        $this->planes = $planes;
        $this->contratos = $contratos;
    }   
    
    // Método para incorporar un plan a la empresa
    public function incorporaPlan($plan)
    {
        // print_r($plan);
        $this->planes[$plan->getCodigo()] = $plan;
    }

    // Método para incorporar un contrato a la empresa
    public function incorporarContrato($plan, $cliente, $fechaInicio, $fechaVencimiento, $viaWeb)
    {
        $contrato = new Contrato($fechaInicio, $fechaVencimiento, $viaWeb, $plan, $plan->getImporte(), true, $cliente);
        $this->contratos[] = $contrato;
    }

    // Método para pagar un contrato
    public function pagarContrato($contrato)
    {
        $contrato->setEstado("AL DIA");
    }

    // Método para retornar el importe total de los contratos con un código específico
    public function retornarImporteContratos($codigo)
    {
        $importeTotal = 0;
        foreach ($this->contratos as $contrato) {
            echo $contrato;
            if ($contrato->getObjPlan()->getCodigo() == $codigo) {
                $importeTotal += $contrato->getCosto();
            }
        }
        return $importeTotal;
    }
}
