<?php
$con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
$query2 = ("SELECT COALESCE(SUM(movimiento::jsonb::int),0) FROM datos_pluviometro WHERE datos_pluviometro.fecha>= NOW() - '1 day'::INTERVAL;");
$Pluviometro = pg_query($con,$query2);
$fila2= pg_fetch_row($Pluviometro);
$str=' mm ';
echo($fila2[0])*0.30303.$str;
pg_close($con);
?>
