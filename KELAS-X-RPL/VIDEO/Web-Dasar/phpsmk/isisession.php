<?php
session_start();

echo $_SESSION['user'];
echo '<br>';

echo $_SESSION['nama'];
echo '<br>';

echo $_SESSION['alamat'];

echo '<brb>';

foreach($_SESSION as $key => $value){
    echo $key.'=>'.$value.'<br>';
}
?>