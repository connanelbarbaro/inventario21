<?php
require_once('herramientas_modelo.php');

$opcion = 0 ;

$opcion = (isset($_GET["opcion"])) ? $_GET["opcion"] : '0';
$operation = (isset($_POST["operation"])) ? $_POST["operation"] : '0';
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
switch ($opcion) {
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
		$json['success'] = true;
		switch ($operation) {
			case "add":
				HerramientasAdd( $name, $idcategoria, $idubicacion1, $idubicacion2, $idubicacion3, $cantidad );
				$json['msj'] = 'Herramienta Agregada';				
			case "edit":
				HerramientasEdit( $id, $name, $idcategoria, $idubicacion1, $idubicacion2, $idubicacion3, $cantidad );
				$json['msj'] = 'Herramienta Actualizada';								
			case "del":
				HerramientasDel( $id );
				$json['msj'] = 'Herramienta Borrada';												
			case "rep":
				ReparacionAdd( $id, $problema, $cantidad  );
				$json['msj'] = 'Herramienta En reparacion';
		}
		echo $json ;
		break ;		
}

?>