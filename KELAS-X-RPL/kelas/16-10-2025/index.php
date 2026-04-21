<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"\>
</head>
<body>
    <div>
         <!-- Navbar -->
        <Nav class="navbar navbar-expand-lg navbar-light bg-primary shadow-sm sticky-top">
            <img src="img/Logo_SMENDA.jpg" alt="Logo" style="width:200px; height:200px; margin-right:10px; border-radius:50%; object-fit:cover;">
            <a class="navbar-brand brand" href="#home">SMKN 2 BUDURAN</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

           <div style="margin-left: auto; margin-right:20px;">
            <ol class="list-group list-group-numbered">
                <li class="list-group-item">
                     <a href="?menu=profil" class="text-decoration-none text-dark">Profil</a>
                </li>
                <li class="list-group-item">
                      <a href="?menu=sejarah" class="text-decoration-none text-dark">Sejarah</a>
                </li>
                <li class="list-group-item">
                      <a href="?menu=jurusan" class="text-decoration-none text-dark">Jurusan</a>
                 </li>
                <li class="list-group-item">
                     <a href="?menu=prestasi" class="text-decoration-none text-dark">Prestasi</a>
             </li>
                 <li class="list-group-item">
                      <a href="?menu=kegiatan" class="text-decoration-none text-dark">Kegiatan</a>
                </li>
                 <li class="list-group-item">
                      <a href="?menu=kontak" class="text-decoration-none text-dark">Kontak</a>
                </li>
            </ol>
           </div>
        

        </Nav>
    </div>
    <div>
        
        <section>
            <?php
                if (isset($_GET['menu'])){
                    $isi = $_GET ['menu'];

                    if ($isi == "profil"){
                        require_once "pages/profil.php";
                    }

                    if ($isi == "sejarah"){
                        require_once "pages/sejarah.php";
                    }

                    if ($isi == "jurusan"){
                        require_once "pages/jurusan.php";
                    }

                    if ($isi == "prestasi"){
                        require_once "pages/prestasi.php";
                    }

                    if ($isi == "kegiatan"){
                        require_once "pages/kegiatan.php";
                    }
                    
                    if($isi == "kontak")
                        require_once "pages/kontak.php";
                }else{
                   
                } 
            ?>
        </section>
        <footer>
                <p>
                    web ini di buat oleh Arina Maulidiyah
                </p>
        </footer>
    </div>
</body>
</html>