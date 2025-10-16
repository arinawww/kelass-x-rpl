belajar php
<h1>saya belajar php</h1>
<?php
    $nama = "Arina Maulidiyah";
    $kelas = "10";
    $umur = "15";
    $lamat = "Gedangan Sidoarjo";
    $hobi = "badminton dan mendaki gunung";
    $cita_cita = "ingin kaya";
    $enter = "<br/>";

    echo $nama; 
    echo $enter;

    echo $kelas;
    echo $enter;

    echo $umur; 
    echo $enter;

    echo $alamat;
    echo $enter;

    echo $hobi;
    echo $enter;

    echo $cita_cita;
    echo $enter;

?>
<?php
echo "<h1>saya belajar php</h1>";
echo "saya kelas :";
echo 12;
?>

<?php
echo "<h1>NAMA : Arina Maulidiyah</h1>". "<br/>";
echo "KELAS : X-RPL". "<br/>";
echo "UMUR : saya tahun ini 15 taun, yakali 20 tahun". "<br/>";
echo "ALAMAT : Jl. Raden Rahmat RT 04 RW 01". "<br/>";
echo "HOBI : bermain badminton dan mendaki gunung". "<br/>";
echo "CITA - CITA : bisa masuk pb.djarum, dan ingin mengelili dunia dengan cara mendaki". "<br/>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Arina</title>
</head>
<body>
    <div>
        <h1>identitas</h1>
        <table>
            <tbody>
                <tr>
                    <td>
                        NAMA :
                    </td>
                    <td>
                        <?= $nama; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        ALAMAT :
                    </td>
                    <td>
                        <?= $alamat; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        KELAS :
                    </td>
                    <td>
                        <?= $kelas; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        HOBI :
                    </td>
                    <td>
                        <?= $hobi; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        UMUR :
                    </td>
                    <td>
                        <?= $umur; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        CITA CITA :
                    </td>
                    <td>
                        <?= $cita_cita?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>