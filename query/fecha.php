<?php
if(isset($_POST['data'])){
  $disp=$_POST['data'];
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query6 = ("SELECT fecha FROM datos_micro WHERE id = (SELECT MAX(id) FROM datos_micro WHERE id_micro=$disp);");
  $fecha = pg_query($con,$query6);
  $fila6= pg_fetch_row($fecha);
  $str= "- ";
  echo htmlspecialchars($str).$fila6[0];
  pg_close($con);
}
?>
