<?php
require_once('includes/load.php');

Function HerramientasListar()
{
	$query  = "SELECT h.id, h.name, h.cantidad, h.idcategoria, h.date, h.idubicacion1, h.idubicacion2, h.idubicacion3, " ;
	$query .= "c1.name as ubicacion_1, c2.name as ubicacion_2, c3.name as ubicacion_3, c4.name as categoria ";
	$query .= "FROM herramientas h " ;
	$query .= "LEFT JOIN categorias c1 ON c1.id = h.idubicacion1 ";
	$query .= "LEFT JOIN categorias c2 ON c2.id = h.idubicacion2 ";	
	$query .= "LEFT JOIN categorias c3 ON c3.id = h.idubicacion3 ";
	$query .= "LEFT JOIN categorias c4 ON c4.id = h.idcategoria ";	
	$query .= "ORDER BY h.name";
	return ErrorsqlPDO( $query );	
}

Function HerramientasID ( $id )
{
	$query  = "SELECT h.id, h.name, h.cantidad, h.idcategoria, h.date, h.idubicacion1, h.idubicacion2, h.idubicacion3, " ;
	$query .= " c1.name as ubicacion_1, c2.name as ubicacion_2, c3.name as ubicacion_3, c4.name as categoria ";
	$query .= " FROM herramientas h " ;
	$query .= " LEFT JOIN categorias c1 ON c1.id = h.idubicacion1 ";
	$query .= " LEFT JOIN categorias c2 ON c2.id = h.idubicacion2 ";	
	$query .= " LEFT JOIN categorias c3 ON c3.id = h.idubicacion3 ";
	$query .= " LEFT JOIN categorias c4 ON c4.id = h.idcategoria ";
	$query .= " WHERE h.id = :id " ;
	$query .= " LIMIT 1";	
	return Errorsql( $query, array( ':id' => $id ) );	
}

Function HerramientasAdd ( $name, $idcategoria, $idubicacion1, $idubicacion2, $idubicacion3, $cantidad )
{
	$query  = "INSERT INTO herramientas ( name, idcategoria, idubicacion1, idubicacion2, idubicacion3, cantidad )";
	$query .= " VALUES ( :name, :idcategoria, :idubicacion1, :idubicacion2, :idubicacion3, :cantidad )";
	$adatos = array( ':name' => $name, ':idcategoria' => $idcategoria, ':idubicacion1' => $idubicacion1, ':idubicacion2' => $idubicacion2, ':idubicacion3' => $idubicacion3, ':cantidad' => $cantidad );
	return Errorsql( $query, $adatos );
}

Function HerramientasEdit( $id, $name, $idcategoria, $idubicacion1, $idubicacion2, $idubicacion3, $cantidad )
{
	$query = "UPDATE herramientas SET name = :name , idcategoria = :idcategoria , ";
	$query .= "idubicacion1 = :idubicacion1 , idubicacion2 = :idubicacion2 , idubicacion3 = :idubicacion3 ,";
	$query .= " cantidad = :cantidad WHERE id = :id ";
	$adatos = array( ':id' => $id , ':name' => $name, ':idcategoria' => $idcategoria, ':idubicacion1' => $idubicacion1, ':idubicacion2' => $idubicacion2, ':idubicacion3' => $idubicacion3, ':cantidad' => $cantidad );
	return Errorsql( $query, $adatos );
}

Function HerramientasDel ( $id )
{
	$query = "DELETE FROM herramientas WHERE id= :id ";
	$adatos = array( ':id' => $id );
	return Errorsql( $query, $adatos );
}

Function ReparacionAdd( $id, $problema, $cantidad )
{
	$idestado ="R";
	$query  = "INSERT INTO reparacion ( idherramienta, idestado, problema )";
	$query .= " VALUES ( :idherramienta, :idestado, :problema )";
	$adatos = array( ':idherramienta' => $id, ':idestado' => $idestado, ':problema' => $problema );
	return Errorsql( $query, $adatos );
}
