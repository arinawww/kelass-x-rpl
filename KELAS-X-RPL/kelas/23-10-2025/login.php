<h1>login</h1>

<form action="" method="POST">
    <input type="email" name="email" placeholder="email" required> <br>
    <input type="password" name="password" placeholder="password" required> <br>
    <input type="submit" value="login" name="login">
</form>

<?php
    if (isset($_POST['login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email == "siti@gmail.com" && $password == "allahuakbar"){
            $_SESSION['email'] = $email;
            header("location: index.php");
        }else{
            echo "email atau password salah";
        }
    }

?>