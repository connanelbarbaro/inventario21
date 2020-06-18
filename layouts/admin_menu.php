
<ul>

  <li>
    <a href="admin.php">
      <i class="glyphicon glyphicon-home"></i>
      <span>Panel de control</span>
    </a>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-user"></i>
      <span>Accesos</span>
    </a>
    <ul class="nav submenu">
      <li><a href="group.php">Administrar grupos</a> </li>
      <li><a href="users.php">Administrar usuarios</a> </li>
   </ul>
  </li>
  <li>
    <a href="#" class="submenu-toggle">
      <i class="glyphicon glyphicon-th-large"></i>
      <span>Categorias</span>
    </a>
    <ul class="nav submenu">
      <li><a href="categoria.php?p=4">Profesores</a> </li>
      <li><a href="categoria.php?p=1">Categorias</a> </li>
      <li><a href="categoria.php?p=2">Medida</a> </li>
      <li><a href="categoria.php?p=3">Estado</a> </li>
      <li><a href="categoria.php?p=5">Ubicacion 1</a> </li>
      <li><a href="categoria.php?p=6">Ubicacion 2</a> </li>
      <li><a href="categoria.php?p=7">Ubicacion 3</a> </li>
   </ul>

  </li>
  <li>
    <a href="herramientas.php" >
      <i class="glyphicon glyphicon-indent-left"></i>
      <span>Herramientas</span>
    </a>
  </li>
  <li>
    <a href="prestamo.php" >
      <i class="glyphicon glyphicon-indent-left"></i>
      <span>Prestamo</span>
    </a>
  </li>
  <li>
    <a href="devolucion.php" >
      <i class="glyphicon glyphicon-indent-left"></i>
      <span>Devolucion</span>
    </a>
  </li>
  <li>
    <a href="reparacion.php" >
      <i class="glyphicon glyphicon-indent-left"></i>
      <span>Reparacion</span>
      <?php
        $reparacion = $db->fetch_assoc( $db->query( "SELECT count(id) AS total FROM reparacion where idestado ='R' " ) ); 
        echo '<span class="badge">'.$reparacion['total'].'</span>';
      ?>
    </a>
  </li>
</ul>
