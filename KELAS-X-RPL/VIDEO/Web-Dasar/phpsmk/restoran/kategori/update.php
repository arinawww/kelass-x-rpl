<?php

    if (isset($_GET['id'])){
        $id=$_GET['id'];

        $sql = "SELECT * FROM tblkategori WHERE idkategori=$id";

        $row=$db->getITEM($sql);
    }
?>

<h3>update kategori</h3>
<div>
    <form action="" method="post">
    <div>
        <label for="kategori"></label>
        <input type="text" name="kategori" required placeholder value="<?php echo $row['kategori']?>" class="form-control">
    </div>

    <div>
        <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
    </div>
    </form>
</div>

<?php

    if (isset($_POST['simpan'])){
        $kategori = $_POST['kategori'];

        $sql = "UPDATE tblkategori SET kategori='$kategori' WHERE idkategori=$id";

        $db->runSQL($sql);

        header("location:?f=kategori&m=select");
    }

?>