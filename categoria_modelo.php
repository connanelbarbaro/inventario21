<?php
require_once('includes/load.php');

function CategoriaListar( $idpagina )
{
	global $connection ;
	$query = "SELECT id, idpagina, name FROM categorias where idpagina = :idpagina ORDER BY name"  ;
	$statement = $connection->prepare( $query );
	$statement->execute( array( ':idpagina' => $idpagina ) );
	$result = $statement->fetchAll();	
	return $result ;
}

function CategoriaID ( $id )
{
	global $connection ;
	$query = "SELECT * FROM categorias WHERE id= :id LIMIT 1"  ;
	$statement = $connection->prepare( $query );
	$statement->execute( array( ':id' => $id ) );
	$result = $statement->fetchAll();	
	return $result ;
}

function CategoriaAdd ( $idpagina, $name )
{
	global $connection ;
	$query  = "INSERT INTO categorias (name, idpagina)";
	$query .= " VALUES ( :name, :idpagina )";
	$adatos = array( ':name' => $name, ':idpagina' => $idpagina  );
	$statement = $connection->prepare( $query );
	$statement->execute( $adatos );
	$result = $statement->fetchAll();	
	return $result ;
}

function CategoriaEdit ( $id, $name )
{
	global $connection ;
	$query = "UPDATE categorias SET name= :name WHERE id= :id ";
	$adatos = array( ':name' => $name , ':id' => $id );
	$statement = $connection->prepare( $query );
	$statement->execute( $adatos );
	$result = $statement->fetchAll();	
	return $result ;
}

function CategoriaDel ( $id )
{
	global $connection ;
	$query = "DELETE FROM categorias WHERE id= :id ";
	$adatos = array( ':id' => $id );
	$statement = $connection->prepare( $query );
	$statement->execute( $adatos );
	$result = $statement->fetchAll();	
	return $result ;
}







