<?php
// 1 LISTADO
// 2 REGISTRO
// 3 AGREGAR
// 4 BORRAR
// 5 ACTUALIZAR


require_once('categoria_modelo.php');

$opcion = (isset($_POST["opcion"])) ? $_POST["opcion"] : '0';
$user_id = (isset($_POST["user_id"])) ? $_POST["user_id"] : '0';
$idpagina = $_SESSION['categoria'] ;
$name = (isset($_POST["name"])) ? $_POST["name"] : '';

$output = array();
$json['msj'] = 'Error';
$json['success'] = false;
switch ($opcion) {
	case 1:
		$all_registros = CategoriaListar( $_SESSION["categoria"] );;
		foreach ($all_registros as $registro)
		{
			echo '<tr>';
			echo '<td class="text-left">'.$registro['id'].'</td>';
			echo '<td class="text-left">'.$registro['name'].'</td>';
			echo '<td class="text-center">';
			echo '<div class="btn-group">';
			echo '<button type="button" name="update" id="'.(int)$registro['id'].'" class="btn btn-info btn-sm update" title="Editar">E</button>';
			echo '</div>';
			echo '<div class="btn-group">';
			echo '<button type="button" name="delete" id="'.(int)$registro['id'].'" class="btn btn-danger btn-sm delete" title="Borrar">B</button>';
			echo '</div>';
			echo '</td>';
			echo '</tr>';
		}
		break ;	
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
		$result =CategoriaAdd( $idpagina, $name );
		break;
    case 4:
		$result =CategoriaDel( $user_id );
		break;
    case 5:
		$result =CategoriaEdit( $user_id, $name );
		break;		
}

?>