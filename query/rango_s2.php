<?php
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query13 = ("SELECT rango_s FROM micro WHERE id = $disp;");
  $fecha = pg_query($con,$query13);
  $fila13= pg_fetch_row($fecha);
  $str2= " cm ";
  echo $fila13[0].htmlspecialchars($str2);
  pg_close($con);
?>
