<?php
$con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
$query2 = ("SELECT movimiento FROM datos_pluviometro WHERE datos_p_id = (SELECT MAX(datos_p_id) FROM datos_pluviometro);");
$Pluviometro = pg_query($con,$query2);
$fila2= pg_fetch_row($Pluviometro);
$str=' ml ';
echo$fila2[0].$str;
pg_close($con);
?>
