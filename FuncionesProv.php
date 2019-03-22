<?php

if(isset($_POST['provincia'])){
      $rs='';
      $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
      $query1 = ("SELECT * FROM ciudad where provincia_id = " . $_POST['provincia'] . "ORDER BY nombre ASC");
      $sql = pg_query($con,$query1);
      if(pg_num_rows($sql)){
        $rs = pg_fetch_all($sql);
      }
      echo json_encode($rs);
      pg_close($con);
}

if(isset($_POST['Ciudades'])){
      $rs='';
      $nombrec = $_POST['Ciudades'];
      $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
      $query1 = ("SELECT * FROM sector where ciu_id = (SELECT ciudad_id FROM ciudad where nombre = '$nombrec' ORDER BY nombre ASC) ;");
      $sql = pg_query($con,$query1);
      if(pg_num_rows($sql)){
        $rs = pg_fetch_all($sql);
      }
      echo json_encode($rs);
      pg_close($con);
}

function Prov(){
  $rs='';
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query1 = ("SELECT * FROM provincia ORDER BY nombre ASC;");
  $sql = pg_query($con,$query1);
  if(pg_num_rows($sql)){
    $rs = pg_fetch_all($sql);
  }
  return $rs;
  pg_close($con);
}

?>
