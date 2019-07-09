<?php
if(isset($_GET['part'])){
  $disp= $_GET['part'];
  global $path;    // path to directory has to be global, using it later in html
  $dir = "C:\xampp\htdocs\Fotos\Micro$disp";
  $files = scandir($dir, 1);                // read directory backkwards
  $picture = ($files[0]);                   // get las picture file name
  $path = "C:\xampp\htdocs\Fotos\Micro$disp";

  echo ' <img width="535" height="280" class="alignnone size-large" src="../Fotos/Micro'.$disp.'/'.$picture.'"> ';
}
?>
