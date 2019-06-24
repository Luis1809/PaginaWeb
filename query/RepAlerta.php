<?php
  include("graficolluvia.php");
  $query5 = ("SELECT nombre,tipo,fecha,hora,promultra,sumpluvi FROM alerta JOIN micro ON micro = micro.id WHERE alerta.fecha>= NOW() - '1 day'::INTERVAL ORDER BY hora ASC;");
  $alertat = pg_query($con,$query5);
  $alerta= pg_fetch_all($alertat);
  if ($alerta == false) echo "[]";
  else echo json_encode($alerta);
  pg_close($con);
 ?>
