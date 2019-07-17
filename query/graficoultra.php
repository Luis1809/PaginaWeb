<?php
   include("graficolluvia.php");
   if(isset($_POST["rango"]) && isset($_POST['microval'])){
   $rango =$_POST["rango"];
   $disp=$_POST['microval'];
   if($rango==1)
   {
      $query5 = ("SELECT t1.HoraDia, t1.cantidad, t2.rango_i, t2.rango_s
      FROM
          (SELECT micro, hora as HoraDia , (profundida_act::jsonb::int) as cantidad FROM datos_ultrasonicos
      	WHERE datos_ultrasonicos.fecha>= NOW() - '1 day'::INTERVAL AND micro =$disp) t1
      LEFT JOIN
          (select id, rango_i, rango_s from micro where id=$disp) t2
      ON (t1.micro = t2.id);");
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
    // $query5 = ("SELECT fecha AS Dia , (profundida_act::jsonb::int) as cantidad FROM datos_ultrasonicos WHERE datos_ultrasonicos.fecha>= NOW() - '7 day'::INTERVAL AND micro = $disp;");
    $query5 = ("SELECT t1.Dia, t1.cantidad, t2.rango_i, t2.rango_s
    FROM
        (SELECT micro, fecha as Dia , (profundida_act::jsonb::int) as cantidad FROM datos_ultrasonicos
      WHERE datos_ultrasonicos.fecha>= NOW() - '7 day'::INTERVAL AND micro =$disp) t1
    LEFT JOIN
        (select id, rango_i, rango_s from micro where id=$disp) t2
    ON (t1.micro = t2.id);");
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
   // $query5 = ("SELECT fecha AS Mes , (profundida_act::jsonb::int) as cantidad FROM datos_ultrasonicos WHERE datos_ultrasonicos.fecha>= NOW() - '12 month'::INTERVAL AND micro = $disp;");
   $query5 = ("SELECT t1.Mes, t1.cantidad, t2.rango_i, t2.rango_s
   FROM
       (SELECT micro, fecha as Mes , (profundida_act::jsonb::int) as cantidad FROM datos_ultrasonicos
     WHERE datos_ultrasonicos.fecha>= NOW() - '12 month'::INTERVAL AND micro =$disp) t1
   LEFT JOIN
       (select id, rango_i, rango_s from micro where id=$disp) t2
   ON (t1.micro = t2.id);");
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
  // $query5 = ("SELECT fecha AS Ano , (profundida_act::jsonb::int) as cantidad FROM datos_ultrasonicos WHERE datos_ultrasonicos.fecha>= NOW() - '10 year'::INTERVAL AND micro = $disp;");
  $query5 = ("SELECT t1.Ano, t1.cantidad, t2.rango_i, t2.rango_s
  FROM
      (SELECT micro, fecha as Ano , (profundida_act::jsonb::int) as cantidad FROM datos_ultrasonicos
    WHERE datos_ultrasonicos.fecha>= NOW() - '10 year'::INTERVAL AND micro =$disp) t1
  LEFT JOIN
      (select id, rango_i, rango_s from micro where id=$disp) t2
  ON (t1.micro = t2.id);");
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
}
 ?>
