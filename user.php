<?php
include_once('templates/header.php');
require_once('koneksi.php');

/* TAMBAH USER */
if (isset($_POST['tambah'])) {
    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level    = $_POST['level'];

    mysqli_query($koneksi,"INSERT INTO user VALUES(
        null,'$nama','$username','$password','$level'
    )");
}

/* HAPUS USER */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi,"DELETE FROM user WHERE id_user='$id'");
}

/* UBAH USER */
if (isset($_POST['ubah'])) {
    $id       = $_POST['id'];
    $nama     = $_POST['nama'];
    $username = $_POST['username'];
    $level    = $_POST['level'];

    mysqli_query($koneksi,"UPDATE user SET
        nama='$nama',
        username='$username',
        level='$level'
        WHERE id_user='$id'
    ");
}

$user = mysqli_query($koneksi,"SELECT * FROM user");
?>

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Data User</h1>

<button class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahUser">
Tambah User
</button>

<table class="table table-bordered">
<tr>
  <th>No</th>
  <th>Nama</th>
  <th>Username</th>
  <th>Level</th>
  <th>Aksi</th>
</tr>

<?php $no=1; while($u=mysqli_fetch_assoc($user)) : ?>
<tr>
  <td><?= $no++; ?></td>
  <td><?= $u['nama']; ?></td>
  <td><?= $u['username']; ?></td>
  <td><?= $u['level']; ?></td>
  <td>
    <button class="btn btn-success btn-sm" data-toggle="modal"
    data-target="#ubah<?= $u['id_user']; ?>">Ubah</button>

    <a href="?hapus=<?= $u['id_user']; ?>" class="btn btn-danger btn-sm"
    onclick="return confirm('Hapus user?')">Hapus</a>
  </td>
</tr>

<!-- Modal Ubah -->
<div class="modal fade" id="ubah<?= $u['id_user']; ?>">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <input type="hidden" name="id" value="<?= $u['id_user']; ?>">
      <div class="modal-body">
        <input type="text" name="nama" class="form-control mb-2" value="<?= $u['nama']; ?>">
        <input type="text" name="username" class="form-control mb-2" value="<?= $u['username']; ?>">
        <select name="level" class="form-control">
          <option value="admin" <?= $u['level']=='admin'?'selected':''; ?>>Admin</option>
          <option value="kasir" <?= $u['level']=='kasir'?'selected':''; ?>>Kasir</option>
        </select>
      </div>
      <div class="modal-footer">
        <button name="ubah" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
<?php endwhile; ?>
</table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahUser">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <div class="modal-body">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama" required>
        <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <select name="level" class="form-control">
          <option value="admin">Admin</option>
          <option value="kasir">Kasir</option>
        </select>
      </div>
      <div class="modal-footer">
        <button name="tambah" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<?php include_once('templates/footer.php'); ?>
