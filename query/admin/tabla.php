<?php

   if(isset($_POST['rango']) && isset($_POST['data'])){
   $rango =$_POST['rango'];
   $disp=$_POST['data'];
   if($rango==1)
   {
     $query5 = ("SELECT nombre,tipo,fecha,hora,promultra,sumpluvi FROM alerta JOIN micro ON micro = micro.id WHERE alerta.fecha>= NOW() - '1 day'::INTERVAL ORDER BY hora ASC;");
     $alertat = pg_query($con,$query5);
     $alerta= pg_fetch_all($alertat);
     if ($alerta == false) echo "[]";
     else echo json_encode($alerta);
     pg_close($con);
  }
  if($rango==2)
  {
    $query5 = ("SELECT nombre,tipo,fecha,hora,promultra,sumpluvi FROM alerta JOIN micro ON micro = micro.id WHERE alerta.fecha>= NOW() - '7 day'::INTERVAL ORDER BY hora ASC;");
    $alertat = pg_query($con,$query5);
    $alerta= pg_fetch_all($alertat);
    if ($alerta == false) echo "[]";
    else echo json_encode($alerta);
    pg_close($con)
 }
 if($rango==3)
 {
   $query5 = ("SELECT nombre,tipo,fecha,hora,promultra,sumpluvi FROM alerta JOIN micro ON micro = micro.id WHERE alerta.fecha>= NOW() - '12 month'::INTERVAL ORDER BY hora ASC;");
   $alertat = pg_query($con,$query5);
   $alerta= pg_fetch_all($alertat);
   if ($alerta == false) echo "[]";
   else echo json_encode($alerta);

   pg_close($con);
}
if($rango==4)
{
  $query5 = ("SELECT nombre,tipo,fecha,hora,promultra,sumpluvi FROM alerta JOIN micro ON micro = micro.id WHERE alerta.fecha>= NOW() - '10 year'::INTERVAL ORDER BY hora ASC;");
  $alertat = pg_query($con,$query5);
  $alerta= pg_fetch_all($alertat);
  if ($alerta == false) echo "[]";
  else echo json_encode($alerta);
  pg_close($con);
}
}
 ?>
