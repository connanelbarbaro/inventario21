
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title> Error </title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
	    <link rel="stylesheet" href="libs/css/main.css" />
	</head>
	<body>
		<h1><font color="#6C3600">Ocurrieron los siguientes errores</font></h1>
		<font color="#6C3600"><b>MySql error</b> </font> </label><?php echo $error['mysql']?><br /><br />
		<font color="#6C3600"><b>SqlQuery</b> </font> </label><?php echo $error['consulta']?><br /><br />
		<font color="#6C3600"><b>Traza</b> </font></label><br />
		<?php 
		$c = 0 ;
		$trace = $e->getTraceAsString() ;
		$pos = strpos ( $trace , "#" , 1 ) ;
		while ($pos > 1 ){
			ECHO substr ( $trace , 0 , $pos ) ;
			echo "<br>";
			$trace = substr ( $trace , $pos , strlen( $trace ) -$pos );
			$pos = strpos ( $trace , "#" , 1 ) ;
		}
		echo $pos ;
		?>	
	</body>
</html>


