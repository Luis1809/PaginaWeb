<?php
   include("graficolluvia.php");
   if(isset($_POST["rango"]))
   $rango =$_POST["rango"];
   if($rango==1)
   {
     $query5 = ("SELECT hora as HoraDia , (profundida_act::jsonb::int) as cantidad FROM datos_ultrasonicos WHERE datos_ultrasonicos.fecha>= NOW() - '1 day'::INTERVAL ;");
     $lluviamm = pg_query($con,$query5);
     $lluvia= pg_fetch_all($lluviamm);
     if ($lluvia == false) echo "[]";
     else {
       echo json_encode($lluvia);
     }
     pg_close($con);
  }
  if($rango==2)
  {
    $query5 = ("SELECT fecha AS Dia , (profundida_act::jsonb::int) as cantidad FROM datos_ultrasonicos WHERE datos_ultrasonicos.fecha>= NOW() - '7 day'::INTERVAL;");
    $lluviamm = pg_query($con,$query5);
    $lluvia= pg_fetch_all($lluviamm);
    if ($lluvia == false) echo "[]";
    else {
      echo json_encode($lluvia);
    }
    pg_close($con);
 }
 if($rango==3)
 {
   $query5 = ("SELECT fecha AS Mes , (profundida_act::jsonb::int) as cantidad FROM datos_ultrasonicos WHERE datos_ultrasonicos.fecha>= NOW() - '12 month'::INTERVAL;");
   $lluviamm = pg_query($con,$query5);
   $lluvia= pg_fetch_all($lluviamm);
   if ($lluvia == false) echo "[]";
   else {
      $a=array();
      foreach($lluvia as &$k){
          foreach ($k as $i => &$value){
              array_push($a,$k[$i]);
              break;
          }
      }
     echo json_encode($lluvia);
   }
   pg_close($con);
}
if($rango==4)
{
  $query5 = ("SELECT fecha AS Ano , (profundida_act::jsonb::int) as cantidad FROM datos_ultrasonicos WHERE datos_ultrasonicos.fecha>= NOW() - '10 year'::INTERVAL;");
  $lluviamm = pg_query($con,$query5);
  $lluvia= pg_fetch_all($lluviamm);
  if ($lluvia == false) echo "[]";
  else {
     $a=array();
     foreach($lluvia as &$k){
         foreach ($k as $i => &$value){
             array_push($a,$k[$i]);
             break;
         }
     }
    echo json_encode($lluvia);
  }
  pg_close($con);
}
 ?>
