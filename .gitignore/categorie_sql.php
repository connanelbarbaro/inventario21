<?php
  require_once('includes/load.php');
/* -------------------------------------------------------------------------------------------------------------------------------------*/
/* LISTAR CATEGORIAS */
/* -------------------------------------------------------------------------------------------------------------------------------------*/
function filter_categories ( $page) {
  global $db;
  return find_by_sql("SELECT * FROM categorias where idpagina =".$db->escape($page)." ORDER BY name");
  
}

/*--------------------------------------------------------------*/
/* AGREGAR CATEGORIA
/*--------------------------------------------------------------*/
function categoria_agregar($descripcion, $pagina) {

  global $db;
  $sql  = "INSERT INTO categorias (name, idpagina)";
  $sql .= " VALUES ('{$descripcion}', {$pagina})";
  return ($db->query( $sql ) ) ? true : false;
 }

/*--------------------------------------------------------------*/
/* ACTUALIZAR CATEGORIA
/*--------------------------------------------------------------*/
function categoria_actualizar($id, $descripcion ) {
  global $db;

  $sql = "UPDATE categorias SET name='{$descripcion}'";
  $sql .= " WHERE id='{$id}'";
  return ($db->query( $sql ) ) ? true : false;
}

?>
