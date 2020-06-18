<?php
/* LISTAR PEDIDOS */
function LISTAR_PEDIDOS() {

	global $db;
    $sql  ="SELECT d.idpedido, d.id, d.idprofesor, c1.name as profesor, d.fecha, d.idherramienta, p1.name as herramienta, d.idestado, d.prestadas, d.pendientes";
   	$sql  .=", ifnull(SUM( d.pendientes),0) as totalpendientes, ifnull(SUM( d.prestadas),0) as totalprestadas " ;
    $sql  .=" FROM detalle d";
    $sql  .=" LEFT JOIN categorias c1 ON c1.id = d.idprofesor";
    $sql  .=" LEFT JOIN herramientas p1 ON p1.id = d.idherramienta";
   	$sql  .=" WHERE d.idestado = 'P'" ;
   	$sql  .=" GROUP BY d.idpedido " ;
    $sql  .=" ORDER BY d.id ASC";
    return find_by_sql($sql);

}
/* LISTAR DETALLE */
function LISTAR_DETALLE( $idpedido) {

	global $db;
  $sql  ="SELECT d.idpedido, d.id, d.idprofesor, c1.name as profesor, d.fecha, d.idherramienta, p1.name as herramienta, d.idestado, d.prestadas, d.pendientes";
  $sql  .=" FROM detalle d";
  $sql  .=" LEFT JOIN categorias c1 ON c1.id = d.idprofesor";
	$sql  .=" LEFT JOIN herramientas p1 ON p1.id = d.idherramienta";
	$sql  .=" WHERE d.idpedido = '".$idpedido."'" ;
	$sql  .=" ORDER BY d.id ASC";
    	return find_by_sql($sql);

}

/*--------------------------------------------------------------*/
 /* Function for Find productos en reparacion
 /*--------------------------------------------------------------*/
function find_profesor_detalle( $idpedido )
{
  $resultado = filter_detalle_estado("P", $idpedido);
  foreach ($resultado as $cat) {
    $idprofesor = $cat['idprofesor'] ;
    $profesor = $cat['profesor'];
    $fecha = $cat['fecha'];
  }
  return array( $idprofesor, $profesor, $fecha );
  }

/*--------------------------------------------------------------*/
/* Function Filtra Herramientas x Pa�ol
/*--------------------------------------------------------------*/
function filter_detalle_estado($estado, $idpedido) {

	global $db;
    $sql  ="SELECT d.idpedido, d.id, d.idprofesor, c1.name as profesor, d.fecha, d.idherramienta, p1.name as herramienta, d.idestado, d.prestadas, d.pendientes";
    if( $estado == "P" and $idpedido == ""  )
    	$sql  .=", sum( d.pendientes ) as totalpendientes " ;

    $sql  .=" FROM detalle d";
    $sql  .=" LEFT JOIN categorias c1 ON c1.id = d.idprofesor";
    $sql  .=" LEFT JOIN herramientas p1 ON p1.id = d.idherramienta";
   	$sql  .=" WHERE d.idestado = '".$estado."'" ;
	if( $idpedido != "" )
   		$sql  .=" and d.idpedido= '".$idpedido."'" ;

	if( $estado == "P" and $idpedido == ""  )
    	$sql  .=" GROUP BY d.idpedido" ;

    $sql  .=" ORDER BY d.id ASC";
    return find_by_sql($sql);

}



?>
