<h3>insert kategori</h3>
<div>
    <form action="" method="post">
    <div>
        <label for="kategori"></label>
        <input type="text" name="kategori" required placeholder="isi kategori">
    </div>

    <div>
        <input type="submit" name="simpan" value="simpan" class="btn btn-primary">
    </div>
    </form>
</div>

<?php

    if (isset($_POST['simpan'])){
        $kategori = $_POST['kategori'];

        $sql = "INSERT INTO tblkategori VALUES ('', '$kategori')";
        
        $db->runSQL($sql);

        header("location:?f=kategori&m=select");
    }


?>