<?php
require_once('prestamo_modelo.php');

$idpedido = (isset($_POST["idpedido"])) ? $_POST["idpedido"] : '0';
PrestamoDel( $idpedido);
$json['msj'] = 'Prestamo Borrado';
$json['success'] = True;				
echo json_encode($json);
?>