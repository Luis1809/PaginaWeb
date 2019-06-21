<?php
if(isset($_POST['data'])){
  $micro = $_POST['data'];
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query1 = ("select * FROM micro where id='$micro';");
  $view = pg_query($con,$query1);
  if(pg_num_rows($view)){
    $rs = pg_fetch_all($view);
    foreach ($rs as $dt){
      $query2 = ("select cpu_temp,cpu_usage FROM datos_micro where id = (SELECT MAX(id) FROM datos_micro where id_micro='$micro')");
      $micro2 = pg_query($con,$query2);
      $fila= pg_fetch_all($micro2);
      foreach ($fila as $fl){}

      $sector=$dt['localidad'];
      $query25 = ("select sector.nombre FROM sector where sector_id = '$sector';");
      $nombre = pg_query($con,$query25);
      $fila25= pg_fetch_all($nombre);
      foreach ($fila25 as $fl25){}
      }
    }

    pg_close($con);
    $a = array();
    $a = array_merge($fila,$fila25,$rs);
    echo json_encode($a);
    #sleep(1.5);

}
?>
