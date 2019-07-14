<?php
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

if(isset($desde)==false){
	$desde = $hasta;
}

if(isset($hasta)==false){
	$hasta = $desde;
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA
$con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
$registro =("CREATE TEMPORARY VIEW datos AS SELECT * FROM datos_ultrasonicos, datos_pluviometro,datos_micro, datos_bateria WHERE   datos_ultrasonicos.fecha = datos_pluviometro.fecha AND datos_pluviometro.fecha = datos_micro.fecha AND datos_micro.fecha = datos_bateria.fecha AND datos_ultrasonicos.hora = datos_pluviometro.hora AND datos_pluviometro.hora = datos_micro.hora AND
  datos_micro.hora = datos_bateria.hora AND datos_pluviometro.micro=$microval  AND datos_ultrasonicos.fecha BETWEEN '$desde' AND '$hasta' ORDER BY  datos_ultrasonicos.fecha ASC" );
$cview = pg_query($con,$registro);
//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX
if(pg_num_rows($cview)){
  $rs = pg_fetch_all($cview);
}


	pg_close($con);
  echo json_encode($rs);
?>
