<?php 
require_once('includes/load.php');
require_once('herramientas_modelo.php');

global $connection ;
	$query  = "SELECT h.id, h.name, h.cantidad, h.idcategoria, h.date, h.idubicacion1, h.idubicacion2, h.idubicacion3, " ;
	$query .= "c1.name as ubicacion_1, c2.name as ubicacion_2, c3.name as ubicacion_3, c4.name as categoria ";
	$query .= "FROM herramientas h " ;
	$query .= "LEFT JOIN categorias c1 ON c1.id = h.idubicacion1 ";
	$query .= "LEFT JOIN categorias c2 ON c2.id = h.idubicacion2 ";	
	$query .= "LEFT JOIN categorias c3 ON c3.id = h.idubicacion3 ";
	$query .= "LEFT JOIN categorias c4 ON c4.id = h.idcategoria ";	

$resultado = $connection->prepare($query);
$resultado->execute();        
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
