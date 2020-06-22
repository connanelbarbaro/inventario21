<?php
require_once('includes/load.php');

Function PrestamoListar()
{
	global $connection ;
	$sql  ="SELECT d.idpedido, d.idprofesor, c1.name as profesor, d.fecha";
	$sql .=", SUM( d.prestadas)-SUM( d.devueltas) as totalpendientes, ifnull(SUM( d.prestadas),0) as totalprestadas " ;
	$sql .=" FROM detalle d";
	$sql .=" LEFT JOIN categorias c1 ON c1.id = d.idprofesor";
	$sql .=" WHERE d.idestado = 'P'" ;
	$sql .=" GROUP BY d.idpedido " ;
	$sql .=" ORDER BY d.id ASC";
	return Errorsql( $query );
}

