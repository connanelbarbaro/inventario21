<?php
require_once('categoria_modelo.php');

$opcion = 0 ;

$opcion = (isset($_GET["opcion"])) ? $_GET["opcion"] : '0';
$operation = (isset($_POST["operation"])) ? $_POST["operation"] : '0';
$user_id = (isset($_POST["user_id"])) ? $_POST["user_id"] : '0';
$idpagina = $_SESSION['categoria'] ;
$name = (isset($_POST["name"])) ? $_POST["name"] : '';

$output = array();
$json['msj'] = 'Error';
$json['success'] = false;
switch ($opcion) {
	case 2:
		$result = CategoriaID ( $user_id );
		foreach($result as $row)
		{
			$output["id"] = $row["id"];
			$output["idpagina"] = $row["idpagina"];
			$output["name"] = $row["name"];
		}
		echo json_encode($output);
		break;
    case 3:

		if( $operation == "add")
		{
			$result =CategoriaAdd( $idpagina, $name );
	 	}
		if($operation == "edit")
		{
			$result =CategoriaEdit( $user_id, $name );
		}
		if($operation == "del")
		{
			$result =CategoriaDel( $user_id );
		}		
		break;
}

?>