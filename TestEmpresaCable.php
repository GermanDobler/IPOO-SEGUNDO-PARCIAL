<?php

require_once('EmpresaCable.php');
require_once('Canal.php');
require_once('Plan.php');
require_once('Cliente.php');
require_once('Contrato.php');

$empresaCable = new EmpresaCable();

// Crear 3 instancias de la clase Canal
$canal1 = new Canal("Noticias", 10, false, true);
$canal2 = new Canal("Deportivo", 15, true, true);
$canal3 = new Canal("Películas", 20, true, true);

// Crear 2 instancias de la clase Planes
$plan1 = new Plan(111, [$canal1, $canal2], 50);
$plan2 = new Plan(222, [$canal2, $canal3], 70);

// Crear una instancia de la clase Cliente
$cliente = new Cliente("numero", "12345678", "Calle Falsa 123");

// Crear 3 instancias de Contratos
$contrato1 = new Contrato("2024-06-12", "2024-06-24", false, $plan1, 100, false, $cliente);
$contrato2 = new Contrato("2024-06-12", "2024-06-24", true, $plan1, 100, false, $cliente);
$contrato3 = new Contrato("2024-06-12", "2024-06-24", true, $plan2, 150, true, $cliente);

// Invocar al método calcularImporte y visualizar el resultado
echo "Importe del contrato 1: " . $contrato1->calcularImporte() . "\n";
echo "Importe del contrato 2: " . $contrato2->calcularImporte() . "\n";
echo "Importe del contrato 3: " . $contrato3->calcularImporte() . "\n";

$empresaCable->incorporaPlan($plan1);

$empresaCable->incorporaPlan($plan1);

$empresaCable->incorporarContrato($plan1, $cliente, "2024-06-12", "2024-06-24", false);

$empresaCable->incorporarContrato($plan1, $cliente, "2024-06-12", "2024-06-24", true);

$empresaCable->pagarContrato($contrato1);

$empresaCable->pagarContrato($contrato2);

// Invocar al método retornarImporteContratos con el código 111
echo "Importe total de los contratos con código 111: " . $empresaCable->retornarImporteContratos(111) . "\n";
