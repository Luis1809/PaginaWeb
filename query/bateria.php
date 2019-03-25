<?php
$con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
$query11 = ("SELECT porcentaje FROM datos_bateria WHERE id = (SELECT MAX(id) FROM datos_bateria);");
$Porc_bateria = pg_query($con,$query11);
$fila11= pg_fetch_row($Porc_bateria);

$str= " %";
echo$fila11[0].htmlspecialchars($str);
pg_close($con);
?>
