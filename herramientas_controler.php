<?php
require_once('herramientas_modelo.php');
// OPCION
// 1 LISTAR
// 2 REGISTRO
// 3 AGREGAR
// 4 BORRAR
// 5 EDITAR
// 6 REPARACION

$opcion = (isset($_POST["opcion"])) ? $_POST["opcion"] : '0';
$id = (isset($_POST["id"])) ? $_POST["id"] : '0';
$name = (isset($_POST["name"])) ? $_POST["name"] : '';
$idcategoria = (isset($_POST["idcategoria"])) ? $_POST["idcategoria"] : '0';
$idubicacion1 = (isset($_POST["idubicacion1"])) ? $_POST["idubicacion1"] : '0';
$idubicacion2 = (isset($_POST["idubicacion2"])) ? $_POST["idubicacion2"] : '0';
$idubicacion3 = (isset($_POST["idubicacion3"])) ? $_POST["idubicacion3"] : '0';
$cantidad = (isset($_POST["cantidad"])) ? $_POST["cantidad"] : '0';
$problema = (isset($_POST["problema"])) ? $_POST["problema"] : '';

$json['msj'] = 'Error $opcion Sin Valor';
$json['success'] = false;
switch ($opcion) {
    case 1:	
		echo json_encode(HerramientasListar(), JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		break ;
    case 2:
		$output = array() ;
_debug( $id );
		$result = HerramientasID ( $id );
		foreach($result as $row)
		{
			$output["id"] = $row["id"];
			$output["name"] = $row["name"];
			$output["idcategoria"] = $row["idcategoria"];
			$output["idubicacion1"] = $row["idubicacion1"];
			$output["idubicacion2"] = $row["idubicacion2"];
			$output["idubicacion3"] = $row["idubicacion3"];
			$output["cantidad"] = $row["cantidad"];
		}
		echo json_encode($output);
		break ;
    case 3:
		$json['success'] = HerramientasAdd( $name, $idcategoria, $idubicacion1, $idubicacion2, $idubicacion3, $cantidad ) ;
		$json['msj'] = ( $json['success'] ) ? 'Herramienta, Agregada' : 'Herramientas, Error al Agregar';
		echo json_encode($json);
		break ;		
    case 4:
		$json['success'] = HerramientasDel( $id );
		$json['msj'] = ( $json['success'] ) ? 'Herramienta, Borrada' : 'Herramientas, Error al Borrar';
		echo json_encode($json);
		break ;		
    case 5:
		$json['success'] = HerramientasEdit( $id, $name, $idcategoria, $idubicacion1, $idubicacion2, $idubicacion3, $cantidad );
		$json['msj'] = ( $json['success'] ) ? 'Herramienta, Actualizada' : 'Herramientas, Error Actualizar';
		echo json_encode($json);
		break ;		    
    case 6:		
		$json['success'] = ReparacionAdd( $id, $problema, $cantidad  );
		$json['msj'] = ( $json['success'] ) ? 'Herramienta, Reparacion Agregada' : 'Herramientas, Error en reparacion';
		echo json_encode($json);
		break ;		    
	default:
		echo json_encode($json);	
		break ;		
}
?>

