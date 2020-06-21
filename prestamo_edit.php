<?php
require_once('prestamo_modelo.php');

$opcion = (isset($_POST["opcion"])) ? $_POST["opcion"] : '0';

switch ($opcion)
{
	case 1:
		$idherramienta = (isset($_POST["idherramienta"])) ? $_POST["idherramienta"] : '0';
		$prestadas  = (isset($_POST["prestadas"])) ? $_POST["prestadas"] : '0';
		Prestamo_Add( $idherramienta, $prestadas );
		$json['msj'] = 'Herramienta Agregada';
		$json['success'] = True;
		echo json_encode($json);
		break;
	case 2:
		$idProfesor = (isset($_POST["idprofesor"])) ? $_POST["idprofesor"] : '0';
		Prestamo_Grabar( $idProfesor );    
		$json['msj'] = 'Prestamo Agregado';
		$json['success'] = True;		
		echo json_encode($json);
		break;
	case 3:
		$id = (isset($_POST["id"])) ? $_POST["id"] : '0';
		Prestamo_Del( $id );
		$json['msj'] = 'Herramienta Borrada';
		$json['success'] = True;				
		echo json_encode($json);
		break;
	case 4:		
		$idpedido = (isset($_POST["idpedido"])) ? $_POST["idpedido"] : '0';
		$output = array();
		$result = PrestamoProfesor( $idpedido ) ;
		foreach($result as $row)
		{
			$output["idprofesor"] = $row["idprofesor"];
		}
		echo json_encode($output);
		break ;
		
}
?>