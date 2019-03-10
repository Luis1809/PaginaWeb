<?php
$con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");

#Valor Ultrasonido
$query1 = ("SELECT profundida_act FROM datos_ultrasonicos WHERE datos_u_id = (SELECT MAX(datos_u_id) FROM datos_ultrasonicos);");
#Valor Pluviometro
$query2 = ("SELECT movimiento FROM datos_pluviometro WHERE datos_p_id = (SELECT MAX(datos_p_id) FROM datos_pluviometro);");
#Valor CPULoad
$query3 = ("SELECT cpu_usage FROM datos_micro WHERE id = (SELECT MAX(id) FROM datos_micro);");
#Valor CPUTemp
$query4 = ("SELECT cpu_temp FROM datos_micro WHERE id = (SELECT MAX(id) FROM datos_micro);");
#Hora
$query5 = ("SELECT hora FROM datos_micro WHERE id = (SELECT MAX(id) FROM datos_micro);");
#Fecha
$query6 = ("SELECT fecha FROM datos_micro WHERE id = (SELECT MAX(id) FROM datos_micro);");
#Latitud
$query7 = ("SELECT latitud FROM datos_gps WHERE datos_g_id = (SELECT MAX(datos_g_id) FROM datos_gps);");
#Dir Latitud
$query8 = ("SELECT dir_latitud FROM datos_gps WHERE datos_g_id = (SELECT MAX(datos_g_id) FROM datos_gps);");
#Longitud
$query9 = ("SELECT longitud FROM datos_gps WHERE datos_g_id = (SELECT MAX(datos_g_id) FROM datos_gps);");
#Dir Longitud
$query10 = ("SELECT dir_longitud FROM datos_gps WHERE datos_g_id= (SELECT MAX(datos_g_id) FROM datos_gps);");
#Porc_Bateria
$query11 = ("SELECT porcentaje FROM datos_bateria WHERE id = (SELECT MAX(id) FROM datos_bateria);");

$Ultrasonido = pg_query($con,$query1);
$Pluviometro = pg_query($con,$query2);
$CPU_load = pg_query($con,$query3);
$CPU_temp = pg_query($con,$query4);
$hora = pg_query($con,$query5);
$fecha = pg_query($con,$query6);
$latitud = pg_query($con,$query7);
$dir_latitud = pg_query($con,$query8);
$longitud = pg_query($con,$query9);
$dir_longitud = pg_query($con,$query10);
$Porc_bateria = pg_query($con,$query11);

$fila1= pg_fetch_row($Ultrasonido);
$fila2= pg_fetch_row($Pluviometro);
$fila3= pg_fetch_row($CPU_load);
$fila4= pg_fetch_row($CPU_temp);
$fila5= pg_fetch_row($hora);
$fila6= pg_fetch_row($fecha);
$fila7= pg_fetch_row($latitud);
$fila8= pg_fetch_row($dir_latitud);
$fila9= pg_fetch_row($longitud);
$fila10= pg_fetch_row($dir_longitud);
$fila11= pg_fetch_row($Porc_bateria);

pg_close($con);
?>
