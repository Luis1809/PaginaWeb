<?php
if(isset($_POST['data'])){
  $disp=$_POST['data'];
  include("graficolluvia.php");
  $query5 = ("SELECT tipo FROM alerta where id=(SELECT MAX(ID) from alerta where micro=$disp) AND (SELECT (fecha|| ' ' ||hora)::timestamp from alerta where id = (SELECT Max(ID) from alerta where micro=$disp))>= NOW() - '1 hour'::INTERVAL;");
  $alertat = pg_query($con,$query5);
  $alerta= pg_fetch_all($alertat);
  if ($alerta == false) echo "[]";
  else echo json_encode($alerta);
  pg_close($con);
}
?>
