<?php
//session_start();
//echo("<script>console.log('DesdeBase: ".$_SESSION['microses']."');</script>");
if(isset($_SESSION['microses'])){
  $disp=$_SESSION['microses'];

  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  #Valor Ultrasonido
  $query1 = ("SELECT profundida_act FROM datos_ultrasonicos WHERE datos_u_id = (SELECT MAX(datos_u_id) FROM datos_ultrasonicos WHERE micro=$disp);");
  #Valor Pluviometro
  $query2 = ("SELECT COALESCE(SUM(movimiento::jsonb::int),0) FROM datos_pluviometro WHERE datos_pluviometro.fecha>= NOW() - '1 day'::INTERVAL AND micro=$disp;");
  #Valor CPULoad
  $query3 = ("SELECT cpu_usage FROM datos_micro WHERE id = (SELECT MAX(id) FROM datos_micro WHERE id_micro=$disp);");
  #Valor CPUTemp
  $query4 = ("SELECT cpu_temp FROM datos_micro WHERE id = (SELECT MAX(id) FROM datos_micro WHERE id_micro=$disp);");
  #Hora
  $query5 = ("SELECT hora FROM datos_micro WHERE id = (SELECT MAX(id) FROM datos_micro WHERE id_micro=$disp);");
  #Fecha
  $query6 = ("SELECT fecha FROM datos_micro WHERE id = (SELECT MAX(id) FROM datos_micro WHERE id_micro=$disp);");
  #Latitud
  $query7 = ("SELECT latitud FROM datos_gps WHERE datos_g_id = (SELECT MAX(datos_g_id) FROM datos_gps WHERE micro=$disp);");
  #Longitud
  $query9 = ("SELECT longitud FROM datos_gps WHERE datos_g_id = (SELECT MAX(datos_g_id) FROM datos_gps WHERE micro=$disp);");
  #Porc_Bateria
  $query11 = ("SELECT porcentaje FROM datos_bateria WHERE id = (SELECT MAX(id) FROM datos_bateria WHERE micro=$disp);");
  #Rango_i
  $query12 = ("SELECT rango_i FROM micro WHERE id = $disp;");
  #Rango_s
  $query13 = ("SELECT rango_s FROM micro WHERE id = $disp;");

  $Ultrasonido = pg_query($con,$query1);
  $Pluviometro = pg_query($con,$query2);
  $CPU_load = pg_query($con,$query3);
  $CPU_temp = pg_query($con,$query4);
  $hora = pg_query($con,$query5);
  $fecha = pg_query($con,$query6);
  $latitud = pg_query($con,$query7);
  $longitud = pg_query($con,$query9);
  $Porc_bateria = pg_query($con,$query11);
  $rango_i = pg_query($con,$query12);
  $rango_s = pg_query($con,$query13);

  $fila1= pg_fetch_row($Ultrasonido);
  $fila2= pg_fetch_row($Pluviometro);
  $fila3= pg_fetch_row($CPU_load);
  $fila4= pg_fetch_row($CPU_temp);
  $fila5= pg_fetch_row($hora);
  $fila6= pg_fetch_row($fecha);
  $fila7= pg_fetch_row($latitud);
  $fila9= pg_fetch_row($longitud);
  $fila11= pg_fetch_row($Porc_bateria);
  $fila12= pg_fetch_row($rango_i);
  $fila13= pg_fetch_row($rango_s);

  pg_close($con);
}
?>
