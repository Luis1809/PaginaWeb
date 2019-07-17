<?php
   $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
   if(isset($_POST['rango']) && isset($_POST['data'])){
   $rango = $_POST['rango'];
   $disp= $_POST['data'];
   if($rango==1)
   {
     $query5 = ("SELECT hora,fecha,temp,ultrasonico FROM syslog JOIN micro ON micro = micro.id WHERE syslog.fecha>= NOW() - '1 day'::INTERVAL AND micro = $disp ORDER BY (fecha|| ' ' ||hora)::timestamp ASC;");
     $alertat = pg_query($con,$query5);
     $alerta= pg_fetch_all($alertat);
     if ($alerta == false) echo "[]";
     else{
     $paginationHtml = '';
     while ($row = pg_fetch_assoc($alertat)) {
     	$paginationHtml.='<tr>';
      $paginationHtml.='<td class="text-sm-center">'.$row["hora"].'</td>';
     	$paginationHtml.='<td class="text-sm-center">'.$row["fecha"].'</td>';
      $paginationHtml.='<td class="text-sm-center">'.$row["temp"]. ' °C ' .'</td>';
      $paginationHtml.='<td class="text-sm-center">'.$row["ultrasonico"]. ' cm ' .'</td>';
     	$paginationHtml.='</tr>';
     }
     $jsonData = array(
     	"html"	=> $paginationHtml,
     );
     pg_close($con);
     echo json_encode($jsonData);
   }
  }

  if($rango==2)
  {
    $query5 = ("SELECT hora,fecha,temp,ultrasonico FROM syslog JOIN micro ON micro = micro.id WHERE syslog.fecha>= NOW() - '7 day'::INTERVAL AND micro = $disp ORDER BY (fecha|| ' ' ||hora)::timestamp ASC;");
    $alertat = pg_query($con,$query5);
    $alerta= pg_fetch_all($alertat);
    if ($alerta == false) echo "[]";
    else{
    $paginationHtml = '';
    while ($row = pg_fetch_assoc($alertat)) {
     $paginationHtml.='<tr>';
     $paginationHtml.='<td class="text-sm-center">'.$row["hora"].'</td>';
     $paginationHtml.='<td class="text-sm-center">'.$row["fecha"].'</td>';
     $paginationHtml.='<td class="text-sm-center">'.$row["temp"]. ' °C ' .'</td>';
     $paginationHtml.='<td class="text-sm-center">'.$row["ultrasonico"]. ' cm ' .'</td>';
     $paginationHtml.='</tr>';
    }
    $jsonData = array(
     "html"	=> $paginationHtml,
    );
    pg_close($con);
    echo json_encode($jsonData);
  }
 }
 if($rango==3)
 {
   $query5 = ("SELECT hora,fecha,temp,ultrasonico FROM syslog JOIN micro ON micro = micro.id WHERE syslog.fecha>= NOW() - '12 month'::INTERVAL AND micro = $disp ORDER BY (fecha|| ' ' ||hora)::timestamp ASC;");
   $alertat = pg_query($con,$query5);
   $alerta= pg_fetch_all($alertat);
   if ($alerta == false) echo "[]";
   else{
   $paginationHtml = '';
   while ($row = pg_fetch_assoc($alertat)) {
    $paginationHtml.='<tr>';
    $paginationHtml.='<td class="text-sm-center">'.$row["hora"].'</td>';
    $paginationHtml.='<td class="text-sm-center">'.$row["fecha"].'</td>';
    $paginationHtml.='<td class="text-sm-center">'.$row["temp"]. ' °C ' .'</td>';
    $paginationHtml.='<td class="text-sm-center">'.$row["ultrasonico"]. ' cm ' .'</td>';
    $paginationHtml.='</tr>';
   }
   $jsonData = array(
    "html"	=> $paginationHtml,
   );
   pg_close($con);
   echo json_encode($jsonData);
   }
  }
  if($rango==4)
  {
    $query5 = ("SELECT hora,fecha,temp,ultrasonico FROM syslog JOIN micro ON micro = micro.id WHERE syslog.fecha>= NOW() - '10 year'::INTERVAL AND micro = $disp ORDER BY (fecha|| ' ' ||hora)::timestamp ASC;");
    $alertat = pg_query($con,$query5);
    $alerta= pg_fetch_all($alertat);
    if ($alerta == false) echo "[]";
    else{
      $paginationHtml = '';
      while ($row = pg_fetch_assoc($alertat)) {
       $paginationHtml.='<tr>';
       $paginationHtml.='<td class="text-sm-center">'.$row["hora"].'</td>';
       $paginationHtml.='<td class="text-sm-center">'.$row["fecha"].'</td>';
       $paginationHtml.='<td class="text-sm-center">'.$row["temp"]. ' °C ' .'</td>';
       $paginationHtml.='<td class="text-sm-center">'.$row["ultrasonico"]. ' cm ' .'</td>';
       $paginationHtml.='</tr>';
      }
      $jsonData = array(
       "html"	=> $paginationHtml,
      );
      pg_close($con);
      echo json_encode($jsonData);
    }
  }
}
?>
