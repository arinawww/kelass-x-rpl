<?php
    $menu = ['profil', 'kontak', 'kegiatan', 'jadwal'];
    $berita = "lorem ipsum dolor sit amet consectetur adipisicing elit. Illum accusamus natus laborum tempore quo culpa porro quae blanditiis. Mollitia, quibusdam dolore impedit necessitatibus magni animi distinctio et velit qui iure.";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web SMPN 1 GEDANGAN</title>
</head>
<body>
    <div>
        <div>
            <ul>
                <li>
                     <?= $menu[0]; ?>
                </li>
                <li>
                    <?= $menu[1]; ?>
                </li>
                <li>
                    <?= $menu[2]; ?>
                </li>
                <li>
                    <?= $menu[3]; ?>
                </li>
            </ul>
        </div>
        <div>
            <h2>Berita</h2>
            <p><?= $berita; ?></p>
        </div>
        <div>
            <img src="<?= $img; ?>" alt="">
        </div>
        
    </div>
</body>
</html>