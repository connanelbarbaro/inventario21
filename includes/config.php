<?php
/*
|--------------------------------------------------------------------------
| OWSA-INV V2
|--------------------------------------------------------------------------
| Author: Siamon Hasan
| Project Name: OSWA-INV
| Version: v2
| Offcial page: http://oswapp.com/
| facebook Page: https://www.facebook.com/oswapp
|
|
|
*/

define( 'DB_HOST', 'localhost' );          // Set database host
  define( 'DB_USER', 'root' );             // Set database user
  define( 'DB_PASS', '1' );             // Set database password
  define( 'DB_NAME', 'oswa_inv' );        // Set database name

  /* TABLA */
define( '_CATEGORIA', 1 );
define( '_MEDIDA', 2 );
define( '_ESTADO', 3 );
define( '_PROFESOR', 4 );
define( '_UBICACION1', 5 );
define( '_UBICACION2', 6 );
define( '_UBICACION3', 7 );


/* ESTADO INTERNOS */
define( '_ESTADOB', "B" );	// BORRADOR
define( '_ESTADOP', "P" );	// PRESTAMO
define( '_ESTADOD', "D" );	// DEVOLUCION
define( '_ESTADOR', "R" );	// REPARACION
define( '_ESTADOX', "X" );	// DESCARTE

/* ESTADOS DE EDICION */
define( '_NEW', "N" );	// NUEVO
define( '_EDIT', "E" );	// EDITAR
define( '_DEL', "D" );	// BORRAR

?>

