<?php
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query1 = ("select COUNT(*) FROM micro;");
  $view = pg_query($con,$query1);
  $fila= pg_fetch_row($view);
  echo$fila[0];
?>
