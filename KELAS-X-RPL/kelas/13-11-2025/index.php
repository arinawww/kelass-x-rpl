<form action="" method="POST">
    <label for="">NIS :</label><br>
    <input type="number" name="nis" id="nis" required placeholder="masukkan nis"><br>
    <label for="">Nama :</label><br>
    <input type="text" name="nama" id="nama" required placeholder="masukkan nama"><br>
    <label for="">Alamat :</label><br>
    <input type="text" name="alamat" id="alamat" required placeholder="masukkan alamat"><br>
    <label for="">Telepon :</label><br>
    <input type="text" name="telepon" id="telepon" required placeholder="masukkan telepon"><br>
    <input type="submit" name="simpan"value="simpan">
</form>

<?php

    $host = 'localhost';
    $user =  'root';
    $password = '';
    $db = 'dbsekolah';

    $koneksi = mysqli_connect($host, $user, $password, $db);


    if(isset($_POST['simpan'])) {
        $nis = $_POST['nis'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];

        //echo $nis," - ", $nama," - ", $alamat, " - ", $telepon;

        $sql = "INSERT INTO tblsiswa (nis, nama, alamat, telepon) VALUES ('$nis', '$nama', '$alamat', '$telepon')";
        echo $sql;
        $query = mysqli_query($koneksi, $sql);
        
    }

        $sql = "SELECT * FROM tblsiswa";
        $query = mysqli_query($koneksi, $sql);
        ?>

        <table border=1>
            <thead>
                <tr>
                    <th>nis</th>
                    <th>nama</th>
                    <th>alamat</th>
                    <th>telepon</th>
                </tr>
            </thead>
            <tbody>

        <?php
        while ($siswa = mysqli_fetch_array($query)){
        ?>

        
                <tr>
                    <td><?= $siswa['nis']; ?></td>
                    <td><?= $siswa['nama']; ?></td>
                    <td><?= $siswa['alamat']; ?></td>
                    <td><?= $siswa['telepon']; ?></td>
                </tr>
           
            
        <?php } ?>

            </tbody>
        </table>

    <?php?>

