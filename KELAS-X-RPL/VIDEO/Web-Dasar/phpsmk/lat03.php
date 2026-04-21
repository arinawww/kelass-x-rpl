<?php

function belajar()
{
    echo "Saya belajar PHP";
}

function luasPersegi($p = 5, $l = 3)
{
    $luas = $p * $l;

    echo "Luas Persegi Panjang = " . $luas . "<br>";
}

function luas($p = 5, $l = 3) {
    $luas = $p * $l;

    return "Luas Persegi Panjang = " . $luas . "<br>";
}

function output()
{
    return "belajar function di php";
}

echo luas();

echo "<h1>" . output() . "</h1>";
?>