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
if ( $opcion = 1 )
{
	echo json_encode(HerramientasListar(), JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
} else {
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
}
