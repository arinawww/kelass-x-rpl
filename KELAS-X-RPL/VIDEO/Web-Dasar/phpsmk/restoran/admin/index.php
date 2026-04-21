<?php

    require_once "../dbcontroller.php";
    $db = new DB;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin page | aplikasi restoran SMK</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
</head>
<body>
    <div class="container">

        <div class="row">
            <div class="col-md3">
                <h2>restoran</h2>
            </div>

            <div class="col-md-9">
                <div class="float-right mt-4">logout</div>
                    
            </div>

        </div>

        <div class="row mt-5">
            <div class="col-md-3">
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link" href="?f=kategori&m=select">kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="?f=menu&m=select">menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="?f=pelanggan&m=select">pelanggan</a></li>
                    <li class="nav-item"><a class="nav-link" href="?f=order&m=select">order</a></li>
                    <li class="nav-item"><a class="nav-link" href="?f=order detail&m=select">order detail</a></li>
                    <li class="nav-item"><a class="nav-link" href="?f=useri&m=select">user</a></li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <?php
            
                if (isset($_GET['f']) && isset($_GET['m'])) {
                    $f=$_GET['f'];
                    $m=$_GET['m'];

                    $file = '../'.$f.'/'.$m.'.php';

                    require_once $file;
                }
            
            ?>
        </div>

        <div class="row mt-5">
            <p class="text-center">2019 - copyright@smkreviit.com</p>
        </div>

    </div>
    
</body>
</html>