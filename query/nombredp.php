<?php
$con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
$query3 = ("SELECT nombre FROM micro WHERE id = 600");
$NombreDisp = pg_query($con,$query3);
$fila3= pg_fetch_row($NombreDisp);
echo($fila3[0]);
pg_close($con);
?>
