<?php
   include("graficolluvia.php");
   if(isset($_POST["rango"]))
   $rango =$_POST["rango"];
   if($rango==1)
   {
     $query5 = ("SELECT extract(hour from hora) as HoraDia , COALESCE(SUM(movimiento::jsonb::int),0) as cantidad FROM datos_pluviometro WHERE datos_pluviometro.fecha>= NOW() - '1 day'::INTERVAL GROUP BY extract(hour from hora) ORDER BY HoraDia ASC;");
     $lluviamm = pg_query($con,$query5);
     $lluvia= pg_fetch_all($lluviamm);
     if ($lluvia == false) echo "[]";
     else {
        $a=array();
        foreach($lluvia as &$k){
            foreach ($k as $i => &$value){
              if ($k[$i] >= 12) {
                array_push($a,$k[$i]);
                if ($k[$i]==12) $k[$i] = ($k[$i]).':00 PM';
                else $k[$i] = ($k[$i]-12).':00 PM';
                $k["cantidad"] = $k["cantidad"]*0.30303;
                break;
              }
              else {
                array_push($a,$k[$i]);
                if ($k[$i]==0) $k[$i] = ($k[$i]+12).':00 AM';
                else $k[$i] = ($k[$i]).':00 AM';
                $k["cantidad"] = $k["cantidad"]*0.30303;
                break;
              }
            }
        }
        $i=0;
        while ($i<24){
          if (!in_array($i, $a) and $i<12){
            $array2 = array("horadia" => $i.":00 AM", "cantidad" => 0);
            $lluvia[] =  $array2;
          }
          if (!in_array($i, $a) and $i==12){
            $array3 = array("horadia" => ($i).":00 PM", "cantidad" => 0);
            $lluvia[] =  $array3;
          }
          if (!in_array($i, $a) and $i>12){
            $array3 = array("horadia" => ($i-12).":00 PM", "cantidad" => 0);
            $lluvia[] =  $array3;
          }
          $i++;
        }
        $x=12;
        $lluviaTemp = array();
        while ($x<13){
          foreach($lluvia as &$k){
            foreach ($k as $i => &$value){
              if ($k[$i] == $x.":00 AM") {
                $lluviaTemp[] = $k;
                break;
              }
              break;
            }
          }
            $x++;
        }
        $x=0;
        while ($x<12){
          foreach($lluvia as &$k){
            foreach ($k as $i => &$value){
              if ($k[$i] == $x.":00 AM") {
                $lluviaTemp[] = $k;
                break;
              }
              break;
            }
          }
            $x++;
        }
        $y=12;
        while ($y<13){
          foreach($lluvia as &$k){
            foreach ($k as $i => &$value){
              if ($k[$i] == $y.":00 PM") {
                $lluviaTemp[] = $k;
                break;
              }
              break;
            }
          }
            $y++;
        }
        $y=0;
        while ($y<12){
          foreach($lluvia as &$k){
            foreach ($k as $i => &$value){
              if ($k[$i] == $y.":00 PM") {
                $lluviaTemp[] = $k;
                break;
              }
              break;
            }
          }
            $y++;
        }
       echo json_encode($lluviaTemp);
     }
     pg_close($con);
  }
  if($rango==2)
  {
    $query5 = ("SELECT TO_CHAR(fecha, 'Dy') AS Dia , COALESCE(SUM(movimiento::jsonb::int),0) as cantidad FROM datos_pluviometro WHERE datos_pluviometro.fecha>= NOW() - '7 day'::INTERVAL GROUP BY (Dia) ORDER BY Dia ASC;");
    $lluviamm = pg_query($con,$query5);
    $lluvia= pg_fetch_all($lluviamm);
    if ($lluvia == false) echo "[]";
    else {
       $a=array();
       foreach($lluvia as &$k){
           foreach ($k as $i => &$value){
               array_push($a,$k[$i]);
               $k["cantidad"] = $k["cantidad"]*0.30303;
               break;
           }
       }
      echo json_encode($lluvia);
    }
    pg_close($con);
 }
 if($rango==3)
 {
   $query5 = ("SELECT TO_CHAR(fecha, 'Mon') AS Mes , COALESCE(SUM(movimiento::jsonb::int),0) as cantidad FROM datos_pluviometro WHERE datos_pluviometro.fecha>= NOW() - '12 month'::INTERVAL GROUP BY (Mes) ORDER BY Mes DESC;");
   $lluviamm = pg_query($con,$query5);
   $lluvia= pg_fetch_all($lluviamm);
   if ($lluvia == false) echo "[]";
   else {
      $a=array();
      foreach($lluvia as &$k){
          foreach ($k as $i => &$value){
              array_push($a,$k[$i]);
              $k["cantidad"] = $k["cantidad"]*0.30303;
              break;
          }
      }
     echo json_encode($lluvia);
   }
   pg_close($con);
}
if($rango==4)
{
  $query5 = ("SELECT TO_CHAR(fecha, 'YYYY') AS Ano , COALESCE(SUM(movimiento::jsonb::int),0) as cantidad FROM datos_pluviometro WHERE datos_pluviometro.fecha>= NOW() - '10 year'::INTERVAL GROUP BY (Ano) ORDER BY Ano ASC;");
  $lluviamm = pg_query($con,$query5);
  $lluvia= pg_fetch_all($lluviamm);
  if ($lluvia == false) echo "[]";
  else {
     $a=array();
     foreach($lluvia as &$k){
         foreach ($k as $i => &$value){
             array_push($a,$k[$i]);
             $k["cantidad"] = $k["cantidad"]*0.30303;
             break;
         }
     }
    echo json_encode($lluvia);
  }
  pg_close($con);
}
 ?>
