<?php
require_once('prestamo_modelo.php');
require_once('categoria_modelo.php');
require_once('herramientas_modelo.php');

$opcion = 0 ;

$opcion = (isset($_GET["opcion"])) ? $_GET["opcion"] : '0';
$idpedido = (isset($_GET["idpedido"])) ? $_GET["idpedido"] : '0';
$operation = (isset($_POST["operation"])) ? $_POST["operation"] : '0';
$user_id = (isset($_POST["user_id"])) ? $_POST["user_id"] : '0';
$idherramienta = (isset($_POST["idherramienta"])) ? $_POST["idherramienta"] : '0';
$prestadas  = (isset($_POST["prestadas"])) ? $_POST["prestadas"] : '0';


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
		PrestamoAdd( $idherramienta, $prestadas );
		$json['msj'] = 'Ok';
		$json['success'] = true;		
		echo json_encode($json);		
		break;
    case 4:
// LISTAR PROFESORES
		$idpagina = '4' ;
		$all_profesores = CategoriaListar( $idpagina );
		echo '<option value="0">Seleccionar</option>';
		foreach ($all_profesores as $profesor)
		{
			echo '<option value="'.$profesor["id"].'">'.$profesor["name"].'</option>';
		}
		break ;
    case 5:
// LISTAR HERRAMIENTAS
		$all_herramientas = HerramientasListar();
		echo '<option value="0">Seleccionar</option>';
		foreach ($all_herramientas as $herramienta)
		{
			echo '<option value="'.$herramienta["id"].'">'.$herramienta["name"].'</option>';
		}
		break ;
    case 6:
// DETALLE
		$all_detalle = PrestamoDetalle( $idpedido );
		foreach ($all_detalle as $detalle )
		{
			echo '<tr>' ;
			echo '<td class="text-left">'.$detalle['herramienta']. '</td>';
			echo '<td class="text-left">'.$detalle['prestadas']. '</td>';
			echo '<td class="text-left"></td>';			
			echo '<td class="text-center">';
			echo '<div class="btn-group">';
			echo '<button type="button" name="delete" id="'.$detalle['id'].'" class="btn btn-danger btn-sm delete" title="Borrar">B</button>';
			echo '</div>';
			echo '</td>';
			echo '</tr>';
		}
		break ;

}

?>