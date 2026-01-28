<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
include "../config/db.php";

/* HAPUS */
if (isset($_GET['delete'])) {
    mysqli_query($conn, "DELETE FROM users WHERE id=$_GET[delete]");
    header("Location: users.php");
}

/* TAMBAH */
if (isset($_POST['tambah'])) {
    mysqli_query($conn, "INSERT INTO users VALUES(
        '',
        '$_POST[nama]',
        '$_POST[username]',
        '$_POST[password]',
        '$_POST[role]'
    )");
    header("Location: users.php");
}

$admin = mysqli_query($conn, "SELECT * FROM users WHERE role='admin'");
$anggota = mysqli_query($conn, "SELECT * FROM users WHERE role='anggota'");
?>

<link rel="stylesheet" href="../assets/style.css">

<div class="container">
<a href="dashboard.php" class="back-btn">← Kembali ke Dashboard</a>
<h1>Manajemen User</h1>

<div class="grid">

<div class="card">
<h3>Tambah Admin</h3>
<form method="POST">
<input name="nama" placeholder="Nama">
<input name="username" placeholder="Username">
<input name="password" placeholder="Password">
<input type="hidden" name="role" value="admin">
<button name="tambah">Tambah Admin</button>
</form>
</div>

<div class="card">
<h3>Tambah Anggota</h3>
<form method="POST">
<input name="nama" placeholder="Nama">
<input name="username" placeholder="Username">
<input name="password" placeholder="Password">
<input type="hidden" name="role" value="anggota">
<button name="tambah">Tambah Anggota</button>
</form>
</div>

</div>

<h2>Data Admin</h2>
<table>
<tr><th>Nama</th><th>User</th><th>Password</th><th>Aksi</th></tr>
<?php while ($a = mysqli_fetch_assoc($admin)) { ?>
<tr>
<td><?= $a['nama'] ?></td>
<td><?= $a['username'] ?></td>
<td><?= $a['password'] ?></td>
<td><a class="danger" href="?delete=<?= $a['id'] ?>">Hapus</a></td>
</tr>
<?php } ?>
</table>

<h2>Data Anggota</h2>
<table>
<tr><th>Nama</th><th>User</th><th>Password</th><th>Aksi</th></tr>
<?php while ($u = mysqli_fetch_assoc($anggota)) { ?>
<tr>
<td><?= $u['nama'] ?></td>
<td><?= $u['username'] ?></td>
<td><?= $u['password'] ?></td>
<td><a class="danger" href="?delete=<?= $u['id'] ?>">Hapus</a></td>
</tr>
<?php } ?>
</table>

</div>
