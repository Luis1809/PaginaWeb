<?php
if(isset($_POST['data'])){
  $disp=$_POST['data'];
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query12 = ("SELECT rango_i FROM micro WHERE id = $disp;");
  $hora = pg_query($con,$query12);
  $fila12= pg_fetch_row($hora);
  $str= '&nbsp;';
  $str2= "-";
  echo$fila12[0].$str.$str2.$str;
  pg_close($con);
}
?>
