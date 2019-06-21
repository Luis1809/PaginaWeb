<?php
if(isset($_POST['data'])){
  $disp=$_POST['data'];
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query7 = ("SELECT latitud FROM datos_gps WHERE datos_g_id = (SELECT MAX(datos_g_id) FROM datos_gps WHERE micro=$disp);");
  $latitud = pg_query($con,$query7);
  $fila7= pg_fetch_row($latitud);
  echo(substr($fila7[0], 0, 7))-0.0002;
  pg_close($con);
}
?>
