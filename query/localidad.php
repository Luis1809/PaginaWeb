<?php
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query1 = ("select tt.micro, tt.latitud, tt.longitud from datos_gps tt inner join (select micro, max(datos_g_id) as max from datos_gps group by micro) groupedtt ON tt.micro= groupedtt.micro and tt.datos_g_id = max;");
  $sql = pg_query($con,$query1);
  if(pg_num_rows($sql)){
    $rs = pg_fetch_all($sql);
  }
  echo json_encode($rs);
  pg_close($con);
?>
