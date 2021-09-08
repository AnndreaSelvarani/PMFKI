<?php
    $command = escapeshellcmd('new.py');
    $output = shell_exec($command);
    echo $output;
?>