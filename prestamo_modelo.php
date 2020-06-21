<?php
require_once('includes/load.php');

Function PrestamoListar()
{
	global $connection ;
	$sql  ="SELECT d.id, d.idpedido, d.idprofesor, c1.name as profesor, d.fecha";
	$sql .=", SUM( d.prestadas)-SUM( d.devueltas) as totalpendientes, ifnull(SUM( d.prestadas),0) as totalprestadas " ;
	$sql .=" FROM detalle d";
	$sql .=" LEFT JOIN categorias c1 ON c1.id = d.idprofesor";
	$sql .=" WHERE d.idestado = 'P' " ;
	$sql .=" GROUP BY d.idpedido " ;
	$sql .=" ORDER BY d.id ASC";
	$result = errorsql( $sql );
	return $result ;
}

Function PrestamoDetalle( $idpedido = "0" )
{
	global $connection ;
	$sql  ="SELECT d.id, d.idpedido, d.idprofesor, c1.name as profesor, d.fecha, d.idherramienta , h1.name as herramienta, ";
	$sql .=" d.prestadas FROM detalle d";
	$sql .=" LEFT JOIN categorias c1 ON c1.id = d.idprofesor";
	$sql .=" LEFT JOIN herramientas h1 ON h1.id = d.idherramienta";
	$sql .=" WHERE d.idpedido = :idpedido " ;
	$sql .=" ORDER BY d.id ASC ";

	$adatos = array( ':idpedido' => $idpedido );
	$result = errorsql( $sql, $adatos );
	return $result ;	
}

Function Prestamo_Add ( $idpedido, $idherramienta, $prestadas )
{
	global $connection ;
	$sql  = "INSERT INTO detalle ( idpedido, idherramienta, prestadas ) ";
	$sql  .= " VALUES ( :idpedido, :idherramienta, :prestadas )";
	$adatos = array( ':idpedido' => $idpedido, ':idherramienta' => $idherramienta, ':prestadas' => $prestadas );
	$result = errorsql( $sql, $adatos );
	return $result ;
}

Function PrestamoUltPedido ()
{
	global $connection ;
	$idpedido = 0 ;
	$sql = "SELECT MAX(idpedido) AS ultimo FROM detalle" ;
	$all_result = errorsql( $sql );
	foreach ($all_result as $result){
		$idpedido = (int)trim($result['ultimo']);	
	}
	$idpedido = $idpedido + 1 ;
	return $idpedido ;
}

Function Prestamo_Grabar( $idprofesor )
{

	$sql  = "UPDATE detalle SET idpedido = :idpedido , idprofesor = :idprofesor ";
	$sql .= " WHERE idpedido = '0' ";
	$idpedido = PrestamoUltPedido() ;
	$adatos = array( ':idpedido' => $idpedido , ':idprofesor' => $idprofesor );
	return errorsql( $sql, $adatos );
}


Function PrestamoDel ( $idpedido )
{
	global $connection ;
	$sql = "DELETE FROM detalle WHERE idpedido = :idpedido ";
	$adatos = array( ':idpedido' => $idpedido );
	$result = errorsql( $sql, $adatos );
	return $result ;
}

Function Prestamo_Del ( $id )
{
	global $connection ;
	$sql = "DELETE FROM detalle WHERE id = :id ";
	$adatos = array( ':id' => $id );
	$result = errorsql( $sql, $adatos );
	return $result ;
	
}

Function PrestamoProfesor( $idpedido = "0" )
{
	global $connection ;
	$sql  ="SELECT d.idprofesor FROM detalle d WHERE d.idpedido = :idpedido LIMIT 1" ;
	$adatos = array( ':idpedido' => $idpedido );
	$result = errorsql( $sql, $adatos );
	return $result ;	
}

Function PrestamoPendientes()
{
	global $connection ;
	$sql  ="SELECT d.idherramienta , h1.name as herramienta, ";
	$sql .=" ifnull(SUM( d.prestadas),0) as totalprestadas , ifnull(SUM( d.prestadas)-SUM( d.devueltas),0) as totalpendientes";
	$sql .=" FROM detalle d";
	$sql .=" LEFT JOIN herramientas h1 ON h1.id = d.idherramienta";
	$sql .=" WHERE d.idestado = 'P' " ;
	$sql .=" GROUP BY d.idherramienta " ;
	$sql .=" ORDER BY herramienta ASC ";


	$result = errorsql( $sql, $adatos );
	return $result ;	
}
