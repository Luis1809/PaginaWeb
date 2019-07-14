<?php
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query1 = ("select count(*) from datos_micro tt inner join
    (select id_micro, max(id) as max from datos_micro  where
    (fecha|| ' ' ||hora)::timestamp>= NOW() - '5 minute'::INTERVAL group by id_micro)
    groupedtt ON tt.id_micro= groupedtt.id_micro and tt.id = max;");
  $view = pg_query($con,$query1);
  $fila= pg_fetch_row($view);
  echo$fila[0];
?>
