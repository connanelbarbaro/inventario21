<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
$idpedido = (int)$_GET['idpedido'];
$sql = "DELETE FROM detalle WHERE idpedido=". $db->escape($idpedido);
$sql .= " LIMIT 1";
$db->query($sql);
if($db->affected_rows() === 1){
	$session->msg("s","Pedido Eliminado");
} else {
    $session->msg("d","Error, Fallo Eliminacion");
}
	redirect('prestamo.php');
?>
