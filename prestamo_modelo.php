<?php
require_once('includes/load.php');

Function PrestamoListar()
{
	global $connection ;
	$sql  ="SELECT d.id, d.idpedido, d.idprofesor, c1.name as profesor, d.fecha";
	$sql .=", SUM( d.prestadas)-SUM( d.devueltas) as totalpendientes, ifnull(SUM( d.prestadas),0) as totalprestadas " ;
	$sql .=" FROM detalle d";
	$sql .=" LEFT JOIN categorias c1 ON c1.id = d.idprofesor";
	$sql .=" WHERE d.idestado = 'P'" ;
	$sql .=" GROUP BY d.idpedido " ;
	$sql .=" ORDER BY d.id ASC";
	try {
	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$statement = $connection->prepare( $sql );
		$statement->execute();
		$result = $statement->fetchAll();
		return $result ;
	} catch (PDOException $e) {
		echo "<p>";
		echo "Error en esta consulta :";
		echo $sql;
		echo "</p>";
		echo "<p>";
		echo "Fallo la conexion: " . $e->getMessage() ;
		echo "</p>";
		die();
	}
}

Function PrestamoDetalle( $idpedido = "0" )
{
	global $connection ;
	$sql  ="SELECT d.id, d.idpedido, d.idprofesor, c1.name as profesor, d.fecha, d.idherramienta , h1.name as herramienta, ";
	$sql .=" d.prestadas FROM detalle d";
	$sql .=" LEFT JOIN categorias c1 ON c1.id = d.idprofesor";
	$sql .=" LEFT JOIN herramientas h1 ON h1.id = d.idherramienta";
	$sql .=" WHERE d.idpedido = :idpedido " ;
	$sql .=" ORDER BY d.id ASC";
	$adatos = array( ':idpedido' => $idpedido );
	try {
	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$statement = $connection->prepare( $sql );
		$statement->execute( $adatos );
		$result = $statement->fetchAll();
		return $result ;
	} catch (PDOException $e) {
		echo "<p>";
		echo "Error en esta consulta :";
		echo $sql;
		echo "</p>";
		echo "<p>";
		echo "Fallo la conexion: " . $e->getMessage() ;
		echo "</p>";
		die();
	}
}

Function PrestamoAdd ( $idherramienta, $prestadas )
{
	global $connection ;
	$query  = "INSERT INTO detalle ( idherramienta, prestadas )";
	$query .= " VALUES ( :idherramienta, :prestadas )";
	$adatos = array( ':idherramienta' => $idherramienta, ':prestadas' => $prestadas );
	$statement = $connection->prepare( $query );
	$statement->execute( $adatos );
	$result = $statement->fetchAll();	    
	return $result ;
/*
	try {
	    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$statement = $connection->prepare( $query );
		$statement->execute( $adatos );
		$result = $statement->fetchAll();	    
		return $result ;
	} catch (PDOException $e) {
		echo "<p>";
		echo "Error en esta consulta :";
		echo $query;
		echo "</p>";
		echo "<p>";
		echo "Fallo la conexion: " . $e->getMessage() ;
		echo "</p>";
		die();
	}	
*/	
}

Function PrestamoUltPedido ()
{
	global $connection ;
	$idpedido = 0 ;
	$query = "SELECT MAX(idpedido) AS ultimo FROM detalle" ;
	$statement = $connection->prepare( $query );
	$statement->execute();
	$all_result = $statement->fetchAll();
	foreach ($all_result as $result){
		$idpedido = (int)trim($result['ultimo']);	
	}
	$idpedido = $idpedido + 1 ;
	return $idpedido ;
}

Function PrestamoGrabar( $idprofesor )
{
	global $connection ;
	$query  = "UPDATE detalle SET idpedido = :idpedido , idprofesor = :idprofesor ";
	$query .= " WHERE idpedido = '0' ";
	$idpedido = PrestamoUltPedido() ;
	$adatos = array( ':idpedido' => $idpedido , ':idprofesor' => $idprofesor );
	$statement = $connection->prepare( $query );
	$statement->execute( $adatos );
	$result = $statement->fetchAll();	    
	return $result ;
}

