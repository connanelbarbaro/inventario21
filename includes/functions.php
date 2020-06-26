<?php
 $errors = array();
 require_once('includes/load.php');



 /*--------------------------------------------------------------*/
 /* Function for Remove escapes special
 /* characters in a string for use in an SQL statement
 /*--------------------------------------------------------------*/
function real_escape($str){
  global $con;
  $escape = mysqli_real_escape_string($con,$str);
  return $escape;
}
/*--------------------------------------------------------------*/
/* Function for Remove html characters
/*--------------------------------------------------------------*/
function remove_junk($str){
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  
  return $str;
}
/*--------------------------------------------------------------*/
/* Function for Uppercase first character
/*--------------------------------------------------------------*/
function first_character($str){
  $val = str_replace('-'," ",$str);
  $val = ucfirst($val);
  return $val;
}
/*--------------------------------------------------------------*/
/* Function for Checking input fields not empty
/*--------------------------------------------------------------*/
function validate_fields($var){
  global $errors;
  foreach ($var as $field) {
    $val = remove_junk($_POST[$field]);
    if(isset($val) && $val==''){
      $errors = $field ." No puede estar en blanco.";
      return $errors;
    }
  }
}
/*--------------------------------------------------------------*/
/* Function for Display Session Message
   Ex echo displayt_msg($message);
/*--------------------------------------------------------------*/
function display_msg($msg =''){
   $output = array();
   if(!empty($msg)) {
    foreach ($msg as $key => $value) {
      _notificacion($key, $value ) ;

      $output  = "<div class=\"alert alert-{$key}\">";
         $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
         $output .= remove_junk(first_character($value));
         $output .= "</div>";
      }
      return "";
   } else {
     return "" ;
   }
}
/*--------------------------------------------------------------*/
/* Function for redirect
/*--------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
      header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
/*--------------------------------------------------------------*/
/* Function for find out total saleing price, buying price and profit
/*--------------------------------------------------------------*/
function total_price($totals){
   $sum = 0;
   $sub = 0;
   foreach($totals as $total ){
     $sum += $total['total_saleing_price'];
     $sub += $total['total_buying_price'];
     $profit = $sum - $sub;
   }
   return array($sum,$profit);
}
/*--------------------------------------------------------------*/
/* Function for Readable date time
/*--------------------------------------------------------------*/
function read_date($str){
     if($str)
      return date('d/m/Y g:i:s a', strtotime($str));
     else
      return null;
  }
/*--------------------------------------------------------------*/
/* Function for  Readable Make date time
/*--------------------------------------------------------------*/
function make_date(){
  return strftime("%y-%m-%d %H:%M:%S", time());
}
function FechaHoy(){
  return strftime("%y-%m-%d", time());
}
function FechaHoraHoy(){
  return strftime("%y-%m-%d %H:%M:%S", time());
}


/*--------------------------------------------------------------*/
/* Function for  Readable date time
/*--------------------------------------------------------------*/
function count_id(){
  static $count = 1;
  return $count++;
}
/*--------------------------------------------------------------*/
/* Function for Creting random string
/*--------------------------------------------------------------*/
function randString($length = 5)
{
  $str='';
  $cha = "0123456789abcdefghijklmnopqrstuvwxyz";

  for($x=0; $x<$length; $x++)
   $str .= $cha[mt_rand(0,strlen($cha))];
  return $str;
}

Function _debug( $var ){
  echo '<script type="text/javascript"> console.log("'.$var.'"); </script>';
return "" ; 
}

Function _notificacion($tipo, $mensaje ){

  $js1 = '<script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ="   crossorigin="anonymous"></script>' ;
  $js2 = '<script type="text/javascript">';
  $js3 =  'alertify.set("notifier","position", "top-right");';
  $js4 =  '</script>';
 
  $alerta ="var notification = alertify.";
  switch ($tipo) {
     case "danger":
      $alerta .="error";
        break;
    case "success":
      $alerta .="success";
        break;
    case "warning":
      $alerta .="warning";
        break;
    default:
          $alerta .="notify";
          break;
  }
  $alerta .= "( '".$mensaje."' , 10 )";
  echo $js1 ;
  echo $js2 ;
  echo $js3 ;
  echo $alerta ;
  echo $js4 ;

  return "" ; 
}

function Boton_add( $id )
{
	$boton ='<button type="button" name="add" id="<?php echo (int)$id ;?>" class="btn btn-warning btn-xl add"> ';
	$boton .=	'<span class="glyphicon glyphicon-edit"></span> ';
	$boton .= '</button>';
	return $boton ;
}

function Boton_update( $id )
{
	$boton ='<button type="button" name="update" id="<?php echo (int)$id ;?>" class="btn btn-warning btn-sm update"> ';
	$boton .=	'<span class="glyphicon glyphicon-edit"></span> ';
	$boton .= '</button>';
	return $boton ;
}

function Boton_del( $id )
{
	$boton ='<button type="button" name="delete" id="<?php echo (int)$id ;?>" class="btn btn-danger btn-sm delete"> ';
	$boton .=	'<span class="glyphicon glyphicon-trash"></span> ';
	$boton .= '</button>';
	return $boton ;
}

function Boton_edicion( $id )
{
	$boton = "";
	$boton .='<div class="btn-group">';
	$boton .= Boton_update( $id ) ;
	$boton .= '</div>';	
	$boton .='<div class="btn-group">';	
	$boton .= Boton_del( $id ) ;
	$boton .= '</div>';
	return $boton ;
}

function errorsql( $sql ="", $datos ="" )
{
	global $connection ;
	$lSelect =stristr($sql, 'SELECT');
	$result = False ;

	if ( empty( $sql ) )
	{
		$error['consulta'] = "Consulta Vacia";
		$error['mysql'] = "";            			
		include_once ( "listarErrores.php");
		exit();
	}
	try {
//		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$statement = $connection->prepare( $sql );
		if ( is_array( $datos ) )
		{
			$result = $statement->execute( $datos );
		} else {
			$result = $statement->execute();			
		}
		echo "\n PDO::errorCode(): ", $result->errorCode();		
		IF( $lSelect )
		{
			$result = $statement->fetchAll();	 
		}
		RETURN $result->errorCode() ;
//		return $result ;

	} catch (PDOException $e) {
		$error['consulta'] = $sql;
		$error['mysql'] = $e->getMessage();
		include_once("listarerrores.php");
		exit();
	}	

}
function archivolog( $texto = "" ) {
	
	$archivo = fopen("log.txt","w+b");
	fwrite($archivo, $texto );
	fflush($archivo);
	fclose($archivo);
}	
?>


