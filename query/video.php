<?php
$command = escapeshellcmd('video.py');
$output = shell_exec($command);
echo $output;
?>
