<?php
  global $path;    // path to directory has to be global, using it later in html
  $dir = "C:\Apache24\htdocs\Fotos";
  $files = scandir($dir, 1);                // read directory backkwards
  $picture = ($files[0]);                   // get las picture file name
  $path = "C:\Apache24\htdocs\Fotos";

  echo ' <img width="540" height="280" class="alignnone size-large" src="../Fotos/'.$picture.'"> '
?>
