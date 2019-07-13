<?php
  include("graficolluvia.php");

$query1 = ("SELECT t1.micro as micro, t1.tipo as tipo, t2.latitud as latitud, t2.longitud as longitud FROM
    (SELECT tt.micro, tt.tipo from alerta tt inner join (select micro, max(id) as max from alerta where
(fecha|| ' ' ||hora)::timestamp>= NOW() - '1 hour'::INTERVAL group by micro) groupedtt ON
tt.micro= groupedtt.micro and tt.id = max) t1
LEFT JOIN
    (SELECT tt.latitud, tt.longitud, tt.micro from datos_gps tt inner join (select micro, max(datos_g_id) as max from datos_gps group by micro) groupedtt ON
tt.micro= groupedtt.micro and tt.datos_g_id = max) t2
ON (t1.micro = t2.micro);");
  $alertat = pg_query($con,$query1);
  $alerta= pg_fetch_all($alertat);
  if ($alerta == false) echo "[]";
  else echo json_encode($alerta);
  pg_close($con);

?>
