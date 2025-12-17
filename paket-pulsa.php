<?php
include_once('templates/header.php');
require_once('function.php');
require_once('koneksi.php');

/* ================= TAMBAH ================= */
if (isset($_POST['tambah'])) {
    $provider     = $_POST['provider'];
    $jenis_paket  = $_POST['jenis_paket'];
    $kuota        = $_POST['kuota'];
    $masa_aktif   = $_POST['masa_aktif'];
    $harga        = $_POST['harga'];
    $status       = $_POST['status'];

    mysqli_query($koneksi, "INSERT INTO paket_pulsa
        (provider, jenis_paket, kuota, masa_aktif, harga, status)
        VALUES
        ('$provider','$jenis_paket','$kuota','$masa_aktif','$harga','$status')
    ");

    echo "<script>
        alert('Data berhasil ditambahkan');
        document.location.href='paket-pulsa.php';
    </script>";
}

/* ================= HAPUS ================= */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM paket_pulsa WHERE id_paket='$id'");
    echo "<script>
        alert('Data berhasil dihapus');
        document.location.href='paket-pulsa.php';
    </script>";
}

/* ================= UBAH ================= */
if (isset($_POST['ubah'])) {
    $id_paket    = $_POST['id'];
    $provider    = $_POST['provider'];
    $jenis_paket = $_POST['jenis_paket'];
    $kuota       = $_POST['kuota'];
    $masa_aktif  = $_POST['masa_aktif'];
    $harga       = $_POST['harga'];
    $status      = $_POST['status'];

    mysqli_query($koneksi, "UPDATE paket_pulsa SET
        provider='$provider',
        jenis_paket='$jenis_paket',
        kuota='$kuota',
        masa_aktif='$masa_aktif',
        harga='$harga',
        status='$status'
        WHERE id_paket='$id_paket'
    ");

    echo "<script>
        alert('Data berhasil diubah');
        document.location.href='paket-pulsa.php';
    </script>";
}

/* ================= DATA ================= */
$paket = query("SELECT * FROM paket_pulsa");
?>

<!-- ================= PAGE ================= -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Harga Paket Pulsa</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahModal">
                <i class="fas fa-plus"></i> Tambah Paket
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Provider</th>
                            <th>Jenis Paket</th>
                            <th>Kuota</th>
                            <th>Masa Aktif</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach ($paket as $data) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['provider']; ?></td>
                            <td><?= $data['jenis_paket']; ?></td>
                            <td><?= $data['kuota']; ?></td>
                            <td><?= $data['masa_aktif']; ?></td>
                            <td>Rp <?= number_format($data['harga']); ?></td>
                            <td><?= $data['status']; ?></td>
                            <td>
                                <button class="btn btn-success btn-sm"
                                  data-toggle="modal"
                                  data-target="#ubahModal<?= $data['id_paket']; ?>">
                                  Ubah
                                </button>

                                <a href="?hapus=<?= $data['id_paket']; ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin hapus data?')">
                                   Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- ================= MODAL TAMBAH ================= -->
<div class="modal fade" id="tambahModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST">
        <div class="modal-header">
          <h5>Tambah Paket Pulsa</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <input type="text" name="provider" class="form-control mb-2" placeholder="Provider" required>
          <input type="text" name="jenis_paket" class="form-control mb-2" placeholder="Jenis Paket" required>
          <input type="text" name="kuota" class="form-control mb-2" placeholder="Kuota">
          <input type="text" name="masa_aktif" class="form-control mb-2" placeholder="Masa Aktif">
          <input type="number" name="harga" class="form-control mb-2" placeholder="Harga" required>
          <select name="status" class="form-control">
            <option value="tersedia">Tersedia</option>
            <option value="habis">Habis</option>
          </select>
        </div>

        <div class="modal-footer">
          <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ================= MODAL UBAH ================= -->
<?php foreach ($paket as $data) : ?>
<div class="modal fade" id="ubahModal<?= $data['id_paket']; ?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST">
        <input type="hidden" name="id" value="<?= $data['id_paket']; ?>">

        <div class="modal-header">
          <h5>Ubah Paket Pulsa</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">
          <input type="text" name="provider" class="form-control mb-2" value="<?= $data['provider']; ?>" required>
          <input type="text" name="jenis_paket" class="form-control mb-2" value="<?= $data['jenis_paket']; ?>" required>
          <input type="text" name="kuota" class="form-control mb-2" value="<?= $data['kuota']; ?>">
          <input type="text" name="masa_aktif" class="form-control mb-2" value="<?= $data['masa_aktif']; ?>">
          <input type="number" name="harga" class="form-control mb-2" value="<?= $data['harga']; ?>" required>
          <select name="status" class="form-control">
            <option value="tersedia" <?= $data['status']=='tersedia'?'selected':''; ?>>Tersedia</option>
            <option value="habis" <?= $data['status']=='habis'?'selected':''; ?>>Habis</option>
          </select>
        </div>

        <div class="modal-footer">
          <button type="submit" name="ubah" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>

<?php include_once('templates/footer.php'); ?>
