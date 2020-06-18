<?php
  require_once('includes/load.php');

  // Checkin What level user has permission to view this page
   page_require_level(1);

Function Contar( $tabla )
{
	global $connection ;
	$query = "SELECT count( * ) as total FROM `$tabla`"  ;
	$statement = $connection->query( $query );
	$result = $statement->fetchColumn();
	return $result ;
}
	
Function TotalPendientes()
{	
	global $connection ;
	$query  ="SELECT ifnull(SUM( d.prestadas),0) as totalprestadas, SUM( d.prestadas)- SUM( d.devueltas) as totalpendientes from detalle d where ( d.idestado = 'P' or d.idestado = 'B' ) ";
	$statement = $connection->query( $query );
	$result = $statement->fetchColumn();
	return $result ;
}

Function TotalPrestadasMes()
{	
	global $connection ;
	$mes = date( "m" ) ;
	$query  ="SELECT ifnull(SUM( d.prestadas),0) as totalprestadas from detalle d where ( d.idestado = 'P' or d.idestado = 'B' ) and month(fecha ) = ".$mes;
	$statement = $connection->query( $query );
	$result = $statement->fetchColumn();
	return $result ;
}

Function TotalPrestadasHoy()
{	
	global $connection ;
	$fecha = FechaHoy() ;
	$query ="SELECT ifnull(SUM( d.prestadas),0) as totalprestadas from detalle d where ( d.idestado = 'P' or d.idestado = 'B' ) and fecha  = ".$fecha;
	$statement = $connection->query( $query );
	$result = $statement->fetchColumn();
	return $result ;
}

Function TotalReparacion()
{	
	global $connection ;
	$query  ="SELECT ifnull( count( r.id ),0 ) as totalreparacion from reparacion r where r.idestado = 'R' ";
	$statement = $connection->query( $query );
	$result = $statement->fetchColumn();
	return $result ;
}
Function ListaReparacion()
{	
	global $connection ;
	$query = " SELECT * FROM reparacion ";
	try {
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$statement = $connection->prepare( $query );
		$statement->execute();
		$result = $statement->fetchAll();	    
		return $result ;
	} catch (PDOException $e) {
		die("Error en esta consulta :<pre> " . $query ."</pre>". "Fallo la conexion: " . $e->getMessage());
	
	}	
}
