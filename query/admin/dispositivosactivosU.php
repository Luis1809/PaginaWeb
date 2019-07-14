<?php
  $local = $_POST['data'];
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query1 = ("select count(*) from datos_micro where
(fecha|| ' ' ||hora)::timestamp>= NOW() - '5 minute'::INTERVAL and id_micro=$local;");
  $view = pg_query($con,$query1);
  $fila= pg_fetch_row($view);
  echo$fila[0];
?>
