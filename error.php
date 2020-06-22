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
<font color="#6C3600"><b>Archivo</b> </font></label> E:\xampp2\htdocs\inventariov21\includes\functions.php <br /><br />
<font color="#6C3600"><b>L&iacute;nea</b> </font></label> 227 <br /><br />
<font color="#6C3600"><b>SqlQuery</b> </font> </label> SELECT d.id, d.idpedido1, d.idprofesor, c1.name as profesor, d.fecha, SUM( d.prestadas)-SUM( d.devueltas) as totalpendientes, ifnull(SUM( d.prestadas),0) as totalprestadas  FROM detalle d LEFT JOIN categorias c1 ON c1.id = d.idprofesor WHERE d.idestado = 'P'  GROUP BY d.idpedido  ORDER BY d.id ASC <br /><br />
<font color="#6C3600"><b>MySql error</b> </font> </label> SQLSTATE[42S22]: Column not found: 1054 Unknown column 'd.idpedido1' in 'field list' <br /><br />
<font color="#6C3600"><b>Traza</b> </font></label><br />
