<nav>
    <ul>
        <li><a href="kontak">kontak</a></li>
        <li><a href="sejarah">sejarah</a></li>
        <li><a href="jurusan">jurusan</a></li>
    </ul>
</nav>

<?php

    if (isset($_GET['menu'])) {
        $menu = $_GET['menu'];

        echo $menu;
    }

?>