<?php
$con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
$query1 = ("SELECT profundida_act FROM datos_ultrasonicos WHERE datos_u_id = (SELECT MAX(datos_u_id) FROM datos_ultrasonicos);");
$Ultrasonido = pg_query($con,$query1);
$fila1= pg_fetch_row($Ultrasonido);
$str=' cm ';
echo$fila1[0].$str;
pg_close($con);
?>
