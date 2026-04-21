<h1>ANDA SUDAH LOGOUT YAAAA !</h1>

<?php
session_start();
session_destroy();
header("location: index.php");
?>