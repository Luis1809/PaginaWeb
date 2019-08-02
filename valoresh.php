<?php
  // include("PagFunc.php");
  if(isset($_POST['desde']) || isset($_POST['hasta'])){
  $microval=$_POST['data'];
  $page=$_POST['pagina'];
  $desdeOri=strval($_POST['desde']);
  $hastaOri=strval($_POST['hasta']);

  // $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
  // $limit = 8;
  // $startpoint= ($page * $limit) - $limit;
  // $microval = $_SESSION['microses'];
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query1 = ("SELECT datos_ultrasonicos.profundida_act,datos_pluviometro.movimiento, datos_micro.cpu_usage,
      datos_micro.cpu_temp, datos_micro.hora,datos_micro.fecha, datos_bateria.porcentaje FROM datos_ultrasonicos, datos_pluviometro,datos_micro,
      datos_bateria WHERE datos_ultrasonicos.fecha = datos_pluviometro.fecha AND datos_pluviometro.fecha = datos_micro.fecha AND
      datos_micro.fecha = datos_bateria.fecha AND datos_ultrasonicos.hora = datos_pluviometro.hora AND datos_pluviometro.hora = datos_micro.hora
      AND datos_micro.hora = datos_bateria.hora AND datos_pluviometro.micro=$microval AND datos_pluviometro.fecha >= '$desdeOri' AND datos_pluviometro.fecha <= '$hastaOri' ORDER BY datos_pluviometro.fecha, datos_pluviometro.hora ASC;");

  // $cview = pg_query($con,$query1);
  // $statement = ("datos");
  // $query2 = ("SELECT * FROM {$statement} LIMIT {$limit} OFFSET {$startpoint};");
  // if(pg_num_rows($view)){
  $result = pg_query($con, $query1);
  $lluvia= pg_fetch_all($result);
  if ($lluvia == false) echo "[]";
  else{
  $paginationHtml = '';
  while ($row = pg_fetch_assoc($result)) {
  	$paginationHtml.='<tr>';
    $paginationHtml.='<td class="text-sm-center">'.$row["hora"].'</td>';
  	$paginationHtml.='<td class="text-sm-center">'.$row["fecha"].'</td>';
  	$paginationHtml.='<td class="text-sm-center">'.$row["profundida_act"]. ' cm ' .'</td>';
  	$paginationHtml.='<td class="text-sm-center">'.$row["movimiento"]*0.30303. ' mm ' .'</td>';
  	$paginationHtml.='<td class="text-sm-center">'.$row["cpu_usage"]. ' % ' .'</td>';
    $paginationHtml.='<td class="text-sm-center">'.$row["cpu_temp"]. ' °C ' .'</td>';
  	$paginationHtml.='<td class="text-sm-center">'.$row["porcentaje"]. ' % ' .'</td>';
  	$paginationHtml.='</tr>';
  }
  $jsonData = array(
  	"html"	=> $paginationHtml,
  );
  pg_close($con);

  echo json_encode($jsonData);
  }

  }
  else{
  $microval=$_POST['data'];
  $page=$_POST['pagina'];


  // $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
  $limit = 7;
  $startpoint= ($page * $limit) - $limit;
  // $microval = $_SESSION['microses'];
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
    $query1 = ("CREATE TEMPORARY VIEW datos AS SELECT datos_ultrasonicos.profundida_act,datos_pluviometro.movimiento, datos_micro.cpu_usage,
      datos_micro.cpu_temp, datos_micro.hora,datos_micro.fecha, datos_bateria.porcentaje FROM datos_ultrasonicos, datos_pluviometro,datos_micro,
      datos_bateria WHERE datos_ultrasonicos.fecha = datos_pluviometro.fecha AND datos_pluviometro.fecha = datos_micro.fecha AND
      datos_micro.fecha = datos_bateria.fecha AND datos_ultrasonicos.hora = datos_pluviometro.hora AND datos_pluviometro.hora = datos_micro.hora
      AND datos_micro.hora = datos_bateria.hora AND datos_pluviometro.micro=$microval;");

  $cview = pg_query($con,$query1);
  $statement = ("datos");
  $query2 = ("SELECT * FROM {$statement} LIMIT {$limit} OFFSET {$startpoint};");
  $view = pg_query($con,$query2);
  // if(pg_num_rows($view)){
  $rs = pg_fetch_all($view);

  if ($rs == false) echo "[]";
  else echo json_encode($rs);
  }


?>
