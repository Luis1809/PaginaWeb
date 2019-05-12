<?php
$directory = "C:\Users\Luis J Rivera Mendez\Desktop\Proyecto\Fotos";
$images = glob($directory . "/*.jpg");

foreach($images as $image)
{
  echo $image;
}
?>
