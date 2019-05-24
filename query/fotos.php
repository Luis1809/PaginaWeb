<?php
$command = escapeshellcmd('fotos.py');
$output = shell_exec($command);
echo $output;
?>
