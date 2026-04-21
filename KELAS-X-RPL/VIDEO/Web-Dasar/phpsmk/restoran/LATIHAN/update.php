
<?php

    require_once "../function.php";

    

    $sql = "SELECT * FROM tblkategori WHERE idkategori = $id";
    $result = mysqli_query($koneksi, $sql);

    $row=mysqli_fetch_assoc($result);

    echo $row['kategori'];

    // $kategori = 'jelly bear';
    // $id= 16;
    // $sql = "UPDATE tblkategori SET kategori='$kategori' WHERE idkategori=$id";

    // $result = mysqli_query($koneksi, $sql);

    //echo $sql;

?>