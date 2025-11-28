<?php

    $sql = "SELECT * FROM tblkategori ORDER BY kategori ASC";
    $row = $db->getALL($sql);

    $no=1+$mulai;

?>
<div class="float-left mr-5">
    <a class="btn btn-primary" href="#" role="button">TAMBAH DATA</a>
</div>


<h3>kategori</h3>
<table>
    <thead>
        <tr>
            <th>no</th>
            <th>kategori</th>
            <th>delete</th>
            <th>update</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($row as $r): ?>
            <tr>
                <td><?php echo $n++?></td>
                <td><?php echo $r['kategori'] ?></td>
                <td><a href="?f=kategori&m=update&id=<?php echo $r['idkategori'] ?>">delete</a></td>
                <td><a href="?f=kategori&m=update&id=<?php echo $r['idkategori'] ?>">update</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php

    for ($i=1 $i <= $halaman ; $i++) {
        echo '<a href="?f=kategori&m=select&p="'.$i.'">'.$i.'</a>';
        echo '&nbsp &nbsp &nbsp';
    }

?>