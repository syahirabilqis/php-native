<?php
include_once('templates/header.php');
require_once('function.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Harga Paket Pulsa</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary btn-icon-split"
                data-toggle="modal" data-target="#tambahModal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Paket</span>
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                        <?php
                        $no = 1;
                        $paket = query("SELECT * FROM paket_pulsa");

                        foreach($paket as $data) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['provider']; ?></td>
                            <td><?= $data['jenis_paket']; ?></td>
                            <td><?= $data['kuota']; ?></td>
                            <td><?= $data['masa_aktif']; ?></td>
                            <td>Rp <?= number_format($data['harga']); ?></td>
                            <td>
                                <span class="badge badge-<?= $data['status']=='tersedia' ? 'success' : 'danger'; ?>">
                                    <?= $data['status']; ?>
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-success btn-sm">Ubah</button>
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>

                    <tfoot>
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
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
include_once('templates/footer.php');
?>
