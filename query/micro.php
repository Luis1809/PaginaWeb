<?php
  $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
  $query1 = ("SELECT * FROM micro");
  $sql = pg_query($con,$query1);
  if(pg_num_rows($sql)){
    $rs = pg_fetch_all($sql);
  }
  echo json_encode($rs);
  pg_close($con);
?>
