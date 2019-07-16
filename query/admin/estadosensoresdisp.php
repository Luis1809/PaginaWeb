<?php
  $local = $_POST['data'];
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query1 = ("SELECT t1.profundidad, t2.temp
  FROM
      (select micro, COALESCE(AVG(profundida_act::jsonb::int),0) as profundidad from datos_ultrasonicos where
      (fecha|| ' ' ||hora)::timestamp>= NOW() - '5 minute'::INTERVAL and micro=$local GROUP BY micro) t1
  LEFT JOIN
      (select id_micro, AVG(cpu_temp) as temp from datos_micro where
      (fecha|| ' ' ||hora)::timestamp>= NOW() - '5 minute'::INTERVAL and id_micro=$local GROUP BY id_micro) t2
  ON (t1.micro = t2.id_micro);");

  $viewOri = pg_query($con,$query1);
  $view= pg_fetch_all($viewOri);
  if ($view == false) echo "[]";
  else {
    echo json_encode($view);
  }
  pg_close($con);
?>
