<?php
    $local = $_POST['data'];
    $con= pg_connect("host=localhost port=5432 dbname=Proyecto user=LuisR password=ProyGA99");
    $query25 = ("SELECT sector.nombre FROM sector where sector_id = (Select localidad from micro where id = $local);");
    $nombre = pg_query($con,$query25);
    $fila25= pg_fetch_row($nombre);
    echo$fila25[0];
?>
