<?php
    if (!isset($_SESSION['email'])){
        header("location: index.php");
    }
?>

<h1>SELAMAT DATANG <?= $_SESSION ['email']?></h1>