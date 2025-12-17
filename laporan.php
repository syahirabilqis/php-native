<?php
include_once('templates/header.php');
require_once('koneksi.php');

// filter status
$status = isset($_GET['status']) ? $_GET['status'] : '';

if ($status == '') {
    $query = "SELECT * FROM paket_pulsa";
} else {
    $query = "SELECT * FROM paket_pulsa WHERE status='$status'";
}

$data = mysqli_query($koneksi, $query);
?>

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Laporan Paket Pulsa</h1>

<!-- Filter -->
<div class="card mb-3">
  <div class="card-body">
    <form method="GET">
      <div class="row">
        <div class="col-md-4">
          <select name="status" class="form-control">
            <option value="">-- Semua Status --</option>
            <option value="tersedia" <?= $status=='tersedia'?'selected':''; ?>>Tersedia</option>
            <option value="habis" <?= $status=='habis'?'selected':''; ?>>Habis</option>
          </select>
        </div>
        <div class="col-md-3">
          <button type="submit" class="btn btn-primary">Filter</button>
          <button onclick="window.print()" type="button" class="btn btn-success">
            Cetak
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Tabel Laporan -->
<div class="card shadow">
  <div class="card-body">
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
        </tr>
      </thead>
      <tbody>
        <?php $no=1; while($row = mysqli_fetch_assoc($data)) : ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $row['provider']; ?></td>
          <td><?= $row['jenis_paket']; ?></td>
          <td><?= $row['kuota']; ?></td>
          <td><?= $row['masa_aktif']; ?></td>
          <td>Rp <?= number_format($row['harga']); ?></td>
          <td><?= $row['status']; ?></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

</div>

<?php include_once('templates/footer.php'); ?>
