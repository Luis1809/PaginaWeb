<?php
// $command = escapeshellcmd('python fotos.py');
// $output = shell_exec($command);
// echo $output;

$fp = fopen('lec.txt', 'w');
fwrite($fp, 'Fotos');
fclose($fp);
?>
