<?php
    $menu = ['profil','alamat','kontak','kegiatan','jadwal'];

    $berita = "SMP Negeri 1 Gedangan baru-baru ini menerima penghargaan nasional sebagai pemenang lomba Pangan Jajanan Sekolah (PJAS) Aman tingkat Nasional Regional Barat 2023, menjadikan sekolah ini tuan rumah untuk studi tiru dari BBPOM Serang.";

    $img = ['foto/logomtsn1sda.png'];

    $isiprofil = "mencakup status pendiriannya sejak 1984, visi dan misi untuk menciptakan generasi yang sadar beragama, santun, sehat, dan berwawasan luas, serta fasilitas penunjang seperti 28 ruang kelas,
     laboratorium, dan 'Learning Center'. Sekolah ini memiliki fokus pada Smart Generation, Real Exploration dan menumbuhkan kesadaran serta kompetensi akademik dan non-akademik.";

    $isialamat = "Jl. Rajawali No. 53, Gedangan, Sidoarjo.";

    $kontak = "Telp: (031) 8912842 | Email: smpngedangansda@gmail.com";

    $kegiatan = "Kegiatan meliputi: Upacara peringatan, Ekstrakurikuler, P5, dll.";
    $jadwal = "Senin - Rabu: 06.30 - 16.15 WIB | Kamis: 06.30 - 14.20 | Jumat: 06.30 - 11.40";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMP NEGERI 1 GEDANGAN                    </title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        /*Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #67919eff;
            color: #333;
            line-height: 1.6;
        }

        #header {
            background-color: #005f73;
            color: white;
            padding: 20px;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 25px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .logo {
            height: 130px;  /* Lebih besar */
            width: auto;
            flex-shrink: 0;
        }

        .header-container h1 {
            font-size: 32px;
            font-weight: bold;
        }



        #nav {
            background-color: #0a9396;
            padding: 15px;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        nav {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        nav a {
           color: white;
            font-weight: 600;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
            background-color: transparent;
        }

        nav a:hover {
            background-color: #007f86;
            color: #ffd166;
        }

        .container {
            padding: 40px 20px;
            max-width: 1100px;
            margin: auto;
        }

        .section {
            background-color: white;
            margin-bottom: 30px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: transform 0.2s ease;
        }

        .section:hover {
            transform: scale(1.01);
        }

        .section h2 {
            color: #005f73;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .section img {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 15px;
        }

        footer {
            background-color: #005f73;
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                text-align: center;
            }

            .logo {
                height: 100px;
            }

            .header-container h1 {
                font-size: 22px;
            }
        }

    </style>
</head>

<body>

    <header id="header">
        <div class="header-container">
            <img src="img/logo.saged.png" alt="Logo MTsN 1 Sidoarjo" class="logo">
             <h1>SMP NEGERI 1 GEDANGAN</h1>
        </div>
    </header>

    <nav>
        <a href="#profil"><?= $menu[0]; ?></a>
        <a href="#alamat"><?= $menu[1]; ?></a>
        <a href="#kontak"><?= $menu[2]; ?></a>
        <a href="#kegiatan"><?= $menu[3]; ?></a>
        <a href="#jadwal"><?= $menu[4]; ?></a>
    </nav>

    <div class="container">
        <div class="section" id="profil">
            <h2><?= $menu[0]; ?></h2>
            <p><?= $isiprofil; ?></p>
        </div>

        <div class="section" id="alamat">
            <h2><?= $menu[1]; ?></h2>
            <p><?= $isialamat; ?></p>
        </div>

        <div class="section" id="kontak">
            <h2><?= $menu[2]; ?></h2>
            <p><?= $kontak; ?></p>
        </div>

        <div class="section" id="kegiatan">
            <h2><?= $menu[3]; ?></h2>
            <p><?= $kegiatan; ?></p>
        </div>

        <div class="section" id="jadwal">
            <h2><?= $menu[4]; ?></h2>
            <p><?= $jadwal; ?></p>
        </div>

        <div class="section" id="berita">
            <h2> Berita </h2>
            <p><?= $berita; ?></p>
            <img src="<?= $img[0]; ?>" alt="Kegiatan Sekolah">
        </div> 
    </div>

    <footer>
        &copy; <?= date("Y"); ?> SMP NEGERI 1 GEDANGAN. All rights reserved.
    </footer>

</body>
</html>                 