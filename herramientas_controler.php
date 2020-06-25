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

$output = array();
$json = array();
$json['msj'] = 'Error';
$json['success'] = false;
echo $opcion ;
switch ($opcion) {
	case 1:	
		global $connection ;
		$query  = "SELECT h.id, h.name, h.cantidad, h.idcategoria, h.date, h.idubicacion1, h.idubicacion2, h.idubicacion3, " ;
		$query .= "c1.name as ubicacion_1, c2.name as ubicacion_2, c3.name as ubicacion_3, c4.name as categoria ";
		$query .= "FROM herramientas h " ;
		$query .= "LEFT JOIN categorias c1 ON c1.id = h.idubicacion1 ";
		$query .= "LEFT JOIN categorias c2 ON c2.id = h.idubicacion2 ";	
		$query .= "LEFT JOIN categorias c3 ON c3.id = h.idubicacion3 ";
		$query .= "LEFT JOIN categorias c4 ON c4.id = h.idcategoria ";	

		$resultado = $connection->prepare($query);
		$resultado->execute();        
		$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
		break ;
		
	case 2:
		$json['msj'] = '';
		$json['success'] = True;
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
		HerramientasAdd( $name, $idcategoria, $idubicacion1, $idubicacion2, $idubicacion3, $cantidad );
ECHO "ANDO" ;
		break ;		
    case 4:
		HerramientasDel( $id );
		break ;		
    case 5:		
		HerramientasEdit( $id, $name, $idcategoria, $idubicacion1, $idubicacion2, $idubicacion3, $cantidad );
		break ;		
    case 6:		
		ReparacionAdd( $id, $problema, $cantidad  );
		break ;		
}

?>