<?php
if(isset($_POST['data'])){
  $disp=$_POST['data'];
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query5 = ("SELECT hora FROM datos_micro WHERE id = (SELECT MAX(id) FROM datos_micro WHERE id_micro=$disp);");
  $hora = pg_query($con,$query5);
  $fila5= pg_fetch_row($hora);
  $str= '&nbsp;';
  echo$fila5[0].$str;
  pg_close($con);
}
?>
