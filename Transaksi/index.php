<?php
include '../koneksi.php';
$sql = "SELECT * FROM peminjaman INNER JOIN anggota ON
peminjaman.id_anggota=anggota.id_anggota INNER JOIN petugas ON
peminjaman.id_petugas=petugas.id_petugas ORDER BY peminjaman.tgl_pinjam";
$res = mysqli_query($koneksi, $sql);
$pinjam = array();
while ($data = mysqli_fetch_assoc($res)) {
    $pinjam[] = $data;
}
include '../aset/header.php';
?>
<div class="container">
    <div class="row mt-4">
        <div class="col-md"></div>
    </div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title"><i class="fas fa-edit"></i>Data Peminjaman</h2>
        <a href="form-pinjam.php"> <button type="submit" name="button" class="badge badge-primary">Mau Pinjam?</button> </a>
        <a href="form-kembali.php"> <button type="submit" name="button" class="badge badge-warning">Kembalikan</button> </a>
    </div>
    <div class="card-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Peminjam</th>
                <th scope="col">Tanggal Pinjam</th>
                <th scope="col">Tanggal Jatuh Tempo</th>
                <th scope="col">Petugas</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <?php
        $no = 1;
        foreach ($pinjam as $p) { ?>

            <tr>
                <th scope="row"><?= $no ?></th>
                <td><?= $p['nama'] ?></th>
                <td><?= date('d F Y', strtotime($p['tgl_pinjam'])) ?></th>
                <td><?= date('d F Y', strtotime($p['tgl_jatuhTemp'])) ?></th>
                <td><?= $p['nama_petugas'] ?></td>
                <td>
                    <?php
                    if (@$p['status'] == "dipinjam") {
                        echo '<h5><span class="badge badge-info">dipinjam</span></h5>';
                    } else {
                        echo '<h5><span class="badge badge-secondary">kembali</span></h5>';
                    }
                    ?>
                </td>
                <td>
                    <a href="detail.php?id_pinjam=<?= $p['id_pinjam'] ?>&nama=<?= $p['nama'] ?>" class="badge badge-success">Detail</a>
                    <a href="form-edit.php?id_pinjam=<?= $p['id_pinjam']?>" class="badge badge-warning">Edit</a>
                    <a href="hapus.php?id_pinjam=<?= $p['id_pinjam'] ?>" class="badge badge-danger">Hapus</a>
                </td>
            </tr>
        <?php
            $no++;
        }
        ?>
        </table>
    </div>
</div>
</div>
<?php
include '../aset/footer.php';
?>
