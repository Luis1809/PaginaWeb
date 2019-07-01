<?php
if(isset($_GET['part'])){
  $disp= $_GET['part'];
  global $path;    // path to directory has to be global, using it later in html
<<<<<<< HEAD
  $dir = "C:\Apache24\htdocs\Fotos\Micro$disp";
  $files = scandir($dir, 1);                // read directory backkwards
  $picture = ($files[0]);                   // get las picture file name
  $path = "C:\Apache24\htdocs\Fotos\Micro$disp";
=======
  $dir = "C:\Fotos";
  $files = scandir($dir, 1);                // read directory backkwards
  $picture = ($files[0]);                   // get las picture file name
  $path = "C:\Fotos";
>>>>>>> 1ad58fadc2507200a8e3e62c2303c94e06b125ea

  echo ' <img width="560" height="280" class="alignnone size-large" src="../Fotos/Micro'.$disp.'/'.$picture.'"> ';
}
?>
