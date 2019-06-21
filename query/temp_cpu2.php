<?php
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query4 = ("SELECT cpu_temp FROM datos_micro WHERE id = (SELECT MAX(id) FROM datos_micro WHERE id_micro=$disp);");
  $CPU_temp = pg_query($con,$query4);
  $fila4= pg_fetch_row($CPU_temp);
  $str= ' °C ';
  echo$fila4[0].$str;
  pg_close($con);
?>
