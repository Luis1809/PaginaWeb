<?php
$con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
$query9 = ("SELECT longitud FROM datos_gps WHERE datos_g_id = (SELECT MAX(datos_g_id) FROM datos_gps);");
$longitud = pg_query($con,$query9);
$fila9= pg_fetch_row($longitud);
echo(substr($fila9[0], 0, 8));
pg_close($con);
?>
