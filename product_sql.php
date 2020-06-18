<?php
/*
CREATE TABLE `herramientas` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL COLLATE 'latin1_swedish_ci',
	`cantidad` INT(11) NULL DEFAULT NULL,
	`idcategoria` INT(11) UNSIGNED NULL DEFAULT NULL,
	`date` DATE NULL DEFAULT NULL,
	`idubicacion1` INT(11) UNSIGNED NULL DEFAULT NULL,
	`idubicacion2` INT(11) UNSIGNED NULL DEFAULT '0',
	`idubicacion3` INT(11) UNSIGNED NULL DEFAULT '0',
	PRIMARY KEY (`id`) USING BTREE
)
*/
  require_once('includes/load.php');
/* -------------------------------------------------------------------------------------------------------------------------------------*/
/* LISTAR HERRAMIENTAS X PAÑOL
/* -------------------------------------------------------------------------------------------------------------------------------------*/
function filter_product () {

	global $db;
  $sql  =" SELECT p.id, p.name, p.cantidad, p.date, p.idcategoria, p.idubicacion1, p.idubicacion2, p.idubicacion3, " ;
  $sql  .=" c1.name AS categoria, c2.name as ubicacion_1, c3.name as ubicacion_2, c4.name as ubicacion_3" ; 
  $sql  .=" FROM herramientas p";
  $sql  .=" LEFT JOIN categorias c1 ON c1.id = p.idcategoria";
  $sql  .=" LEFT JOIN categorias c2 ON c2.id = p.idubicacion1";
  $sql  .=" LEFT JOIN categorias c3 ON c3.id = p.idubicacion2";
	$sql  .=" LEFT JOIN categorias c4 ON c4.id = p.idubicacion3";
  $sql  .=" ORDER BY p.id ASC";
  return find_by_sql($sql);

}


/*--------------------------------------------------------------*/
/* ACTUALIZAR
/*--------------------------------------------------------------*/
function product_actualizar($idherramienta, $herramienta, $cantidad, $categoria, $fecha, $ubicacion1, $ubicacion2, $ubicacion3){

  global $db;
  
  if( $idherramienta == "0"){
      $query = "INSERT INTO herramientas (";
      $query .= " name, cantidad, idcategoria, date, idubicacion1, idubicacion2, idubicacion3 ";
      $query .= ") VALUES (";
      $query .= " '{$herramienta}', '{$cantidad}', '{$categoria}', '{$fecha}', ";
      $query .= "'{$ubicacion1}', '{$ubicacion2}', '{$ubicacion3}'";
      $query .= ")";
  } else {
    $query  = "UPDATE herramientas SET ";
    $query .= "name ='{$herramienta}' , ";
    $query .= "cantidad ='{$cantidad}' , ";
    $query .= "idcategoria ='{$categoria}' , ";
    $query .= "idubicacion1 ='{$ubicacion1}' , ";
    $query .= "idubicacion2 ='{$ubicacion2}' , ";
    $query .= "idubicacion3 ='{$ubicacion3}' ";
    $query .= "WHERE id ='{$db->escape($idherramienta)}'";
  }    
   return( $db->query( $query ) );
}

?>
