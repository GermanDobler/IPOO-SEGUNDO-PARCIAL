<?php
/*
 
Adquirir un plan implica un contrato. Los contratos tienen la fecha de inicio, la fecha de vencimiento, el plan, un estado (al día, moroso, suspendido), un costo, si se renueva o no y una referencia al cliente que adquirió el contrato.

*/

// include 'Cliente.php';
// include 'Plan.php';

class Contrato
{

     //ATRIBUTOS
     private $fechaInicio;
     private $fechaVencimiento;
     private $viaWeb;
     private $objPlan;
     private $estado;  //al día, moroso, suspendido
     private $costo;
     private $seRennueva;
     private $objCliente;

     //CONSTRUCTOR
     public function __construct($fechaInicio, $fechaVencimiento, $viaWeb, $objPlan, $costo, $seRennueva, $objCliente)
     {
          $this->fechaInicio = $fechaInicio;
          $this->fechaVencimiento = $fechaVencimiento;
          $this->viaWeb = $viaWeb;
          $this->objPlan = $objPlan;
          $this->estado = 'AL DIA';
          $this->costo = $costo;
          $this->seRennueva = $seRennueva;
          $this->objCliente = $objCliente;
     }


     public function getFechaInicio()
     {
          return $this->fechaInicio;
     }

     public function setFechaInicio($fechaInicio)
     {
          $this->fechaInicio = $fechaInicio;
     }

     public function getFechaVencimiento()
     {
          return $this->fechaVencimiento;
     }

     public function setFechaVencimiento($fechaVencimiento)
     {
          $this->fechaVencimiento = $fechaVencimiento;
     }

     public function getWeb()
     {
          return $this->viaWeb;
     }

     public function setWeb($viaWeb)
     {
          $this->viaWeb = $viaWeb;
     }

     public function getObjPlan()
     {
          return $this->objPlan;
     }

     public function setObjPlan($objPlan)
     {
          $this->objPlan = $objPlan;
     }

     public function getEstado()
     {
          return $this->estado;
     }

     public function setEstado($estado)
     {
          $this->estado = $estado;
     }

     public function getCosto()
     {
          return $this->costo;
     }

     public function setCosto($costo)
     {
          $this->costo = $costo;
     }

     public function getSeRennueva()
     {
          return $this->seRennueva;
     }

     public function setSeRennueva($seRennueva)
     {
          $this->seRennueva = $seRennueva;
     }


     public function getObjCliente()
     {
          return $this->objCliente;
     }

     public function setObjCliente($objCliente)
     {
          $this->objCliente = $objCliente;
     }

     public function diasContratoVencido()
     {
          $fechaActual = new DateTime($this->getFechaInicio());
          $fechaVencimiento = new DateTime($this->getFechaVencimiento());
          $diferencia = $fechaActual->diff($fechaVencimiento);
          echo "Dias contrato vencido: " . $diferencia->days;
          return $diferencia->days;
     }

     public function calcularImporte()
     {
          $viaWeb = $this->getWeb();
          $return = null;
          if ($viaWeb) {
               $return = $this->getCosto() - ($this->getCosto() * 0.1); //10% de descuento
          } else {
               $return = $this->getCosto();
          }
          return $return;
     }


     function aplicarMulta()
     {
          if ($this->estado === "MOROSO") {
               $diasMora = $this->diasContratoVencido();
               $this->costo = (1 + (0.1 * $diasMora));
          }
     }

     public function actualizarEstadoContrato()
     {
          $diasContratoVencido = $this->diasContratoVencido();
          if ($diasContratoVencido >= 10) {
               $this->setEstado('SUSPENDIDO');
          } else if ($diasContratoVencido >= 1) {
               $this->setEstado('MOROSO');
          }
     }

     // public function renovarContrato()
     // {
     //      $estadoo = $this->getEstado();
     //      if ($estadoo == "MOROSO") {
     //           $this->aplicarMulta();
     //      }
     //      $this->fechaInicio = new DateTime();
     //      $this->fechaVencimiento = (clone $this->fechaInicio)->modify('+1 month');
     // }

     // public function pagar()
     // {
     //      if ($this->estado === "al día") {
     //           $this->renovarContrato();
     //           return $this->costo;
     //      } elseif ($this->estado === "moroso") {
     //           $this->aplicarMulta();
     //           $this->estado = "al día";
     //           $this->renovarContrato();
     //           return $this->costo;
     //      } elseif ($this->estado === "suspendido") {
     //           $this->aplicarMulta();
     //           return "No se puede renovar contrato suspendido";
     //      }
     // }




     public function __toString()
     {
          $cadena = "Fecha inicio: " . $this->getFechaInicio() . "\n";
          $cadena .= "Fecha Vencimiento: " . $this->getFechaVencimiento() . "\n";
          $cadena .= "Plan: " . $this->getObjPlan() . "\n";
          $cadena .= "Estado: " . $this->getEstado() . "\n";
          $cadena .= "Costo: " . $this->getCosto() . "\n";
          $cadena .= "Se renueva: " . $this->getSeRennueva() . "\n";
          $cadena .= "Cliente: " . $this->getObjCliente() . "\n";
          $cadena .= "Dias contrato vencido: " . $this->diasContratoVencido() . "\n";
          $cadena .= "Descuento del plan via web: " . $this->calcularImporte() . "\n";
          return $cadena;
     }
}
