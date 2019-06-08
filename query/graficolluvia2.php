<?php
   include("graficolluvia.php");
   if(isset($_POST["rango"]))
   $rango =$_POST["rango"];
   if($rango==1)
   {
     $query5 = ("SELECT extract(hour from hora) as HoraDia , COALESCE(SUM(movimiento::jsonb::int),0) as cantidad FROM datos_pluviometro WHERE datos_pluviometro.fecha>= NOW() - '1 day'::INTERVAL GROUP BY extract(hour from hora);");
     $lluviamm = pg_query($con,$query5);
     $lluvia= pg_fetch_all($lluviamm);
     if ($lluvia == false) echo "[]";
     else {
        $a=array();
        foreach($lluvia as &$k){
            foreach ($k as $i => &$value){
              if ($k[$i] > 12) {
                array_push($a,$k[$i]);
                $k[$i] = ($k[$i]-12).':00 PM';
                $k["cantidad"] = $k["cantidad"]*0.30303;
                break;
              }
              else {
                array_push($a,$k[$i]);
                $k[$i] = $k[$i].':00 AM';
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
        $x=0;
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
 ?>
