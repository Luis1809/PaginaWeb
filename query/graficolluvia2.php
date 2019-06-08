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
     else echo json_encode($lluvia);
     pg_close($con);
  }
 ?>
