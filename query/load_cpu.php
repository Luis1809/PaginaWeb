<?php
$con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
$query3 = ("SELECT cpu_usage FROM datos_micro WHERE id = (SELECT MAX(id) FROM datos_micro);");
$CPU_load = pg_query($con,$query3);
$fila3= pg_fetch_row($CPU_load);
$str= '/ &nbsp;';
$str2= '%';
$str3= '&nbsp;';
echo($str.$fila3[0].$str3.$str2);
pg_close($con);
?>
