<?php
// $command = escapeshellcmd('python video.py');
// $output = shell_exec($command);
// echo $output;


$fp = fopen('lec.txt', 'w');
fwrite($fp, 'Video');
fclose($fp);

?>
