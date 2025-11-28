<form action=""method="POST">
    Email : <input type="email" name="email" required placeholder="masukkan email">
    Password : <input type="password" name="password" required placeholder="masukkan password">
    <input type="submit" name="login" value="login">


</form>


<?php
    session_start();

    if (isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $_SESSION['email'] = $email;
        header("location: login.php");
        echo "email :" . $email . "<br>";
        echo "password :" . $password . "<br>";
    }

    $isi = "halo dunia";
    $hasil = isset ($isi);
    echo $hasil;

    if (isset($isi)){
        echo "variabel data isi";
    } else {
        echo "variabel tidak ada isi";
    }

    var_dump($isi);

?>