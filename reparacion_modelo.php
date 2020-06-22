<?php
require_once('includes/load.php');

Function ReparacionListar()
{
	global $connection ;
	$query  = "SELECT r.id, r.idherramienta, r.idestado, r.problema, r.solucion, h.name as herramienta,  c.name as ubicacion " ;
	$query .= "from reparacion r " ;
	$query .= "LEFT JOIN herramientas h ON h.id = r.idherramienta ";	
	$query .= "LEFT JOIN categorias c ON c.id = h.idubicacion1 ";	
	return Errorsql( $query );

}

Function ReparacionID ( $id )
{
	global $connection ;
	$query  = "SELECT h.id, h.name, h.cantidad, h.idcategoria, h.date, h.idubicacion1, h.idubicacion2, h.idubicacion3, " ;
	$query .= "c1.name as ubicacion_1, c2.name as ubicacion_2, c3.name as ubicacion_3, c4.name as categoria ";
	$query .= "FROM herramientas h " ;
	$query .= "LEFT JOIN categorias c1 ON c1.id = h.idubicacion1 ";
	$query .= "LEFT JOIN categorias c2 ON c2.id = h.idubicacion2 ";	
	$query .= "LEFT JOIN categorias c3 ON c3.id = h.idubicacion3 ";
	$query .= "LEFT JOIN categorias c4 ON c4.id = h.idcategoria ";	
	$query .= "WHERE h.id = :id LIMIT 1";
	$adatos = array( ':id' => $id ) ;
	return Errorsql( $query, $adatos );}

Function Reparacion1Add ( $name, $idcategoria, $idubicacion1, $idubicacion2, $idubicacion3, $cantidad )
{
	global $connection ;
	$query  = "INSERT INTO herramientas ( name, idcategoria, idubicacion1, idubicacion2, idubicacion3, cantidad )";
	$query .= " VALUES ( :name, :idcategoria, :idubicacion1, :idubicacion2, :idubicacion3, :cantidad )";
	$adatos = array( ':name' => $name, ':idcategoria' => $idcategoria, ':idubicacion1' => $idubicacion1, ':idubicacion2' => $idubicacion2, ':idubicacion3' => $idubicacion3, ':cantidad' => $cantidad );
	return Errorsql( $query, $adatos );
}

Function ReparacionEdit( $id, $name, $idcategoria, $idubicacion1, $idubicacion2, $idubicacion3, $cantidad )
{
	global $connection ;
	$query = "UPDATE herramientas SET name = :name , idcategoria = :idcategoria , ";
	$query .= "idubicacion1 = :idubicacion1 , idubicacion2 = :idubicacion2 , idubicacion3 = :idubicacion3 ,";
	$query .= " cantidad = :cantidad WHERE id = :id ";
	$adatos = array( ':id' => $id , ':name' => $name, ':idcategoria' => $idcategoria, ':idubicacion1' => $idubicacion1, ':idubicacion2' => $idubicacion2, ':idubicacion3' => $idubicacion3, ':cantidad' => $cantidad );
	return Errorsql( $query, $adatos );
}

Function ReparacionDel ( $id )
{
	global $connection ;
	$query = "DELETE FROM herramientas WHERE id= :id ";
	$adatos = array( ':id' => $id );
	return Errorsql( $query, $adatos );
}

function ReparacionAdd( $id, $problema, $cantidad )
{
	global $connection ;
	$idestado ="R";
	$query  = "INSERT INTO reparacion ( idherramienta, idestado, problema )";
	$query .= " VALUES ( :idherramienta, :idestado, :problema )";
	$adatos = array( ':idherramienta' => $id, ':idestado' => $idestado, ':problema' => $problema );
	return Errorsql( $query, $adatos );
}
