<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
include "../config/db.php";

/* TAMBAH KEGIATAN */
if (isset($_POST['tambah'])) {
    mysqli_query($conn, "INSERT INTO kegiatan VALUES(
        '',
        '$_POST[judul]',
        '$_POST[deskripsi]',
        '$_POST[tanggal]'
    )");
    header("Location: kegiatan.php");
}

/* UPDATE KEGIATAN */
if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE kegiatan SET
        judul='$_POST[judul]',
        deskripsi='$_POST[deskripsi]',
        tanggal='$_POST[tanggal]'
        WHERE id='$_POST[id]'
    ");
    header("Location: kegiatan.php");
}

/* DELETE KEGIATAN */
if (isset($_GET['delete'])) {
    mysqli_query($conn, "DELETE FROM kegiatan WHERE id=$_GET[delete]");
    header("Location: kegiatan.php");
}

$kegiatan = mysqli_query($conn, "SELECT * FROM kegiatan");
?>

<link rel="stylesheet" href="../assets/style.css">

<div class="container">

<a href="dashboard.php" class="back-btn">← Kembali ke Dashboard</a>

<h1>Manajemen Kegiatan</h1>

<!-- TAMBAH KEGIATAN -->
<div class="card">
<h3>Tambah Kegiatan</h3>
<form method="POST">
    <input name="judul" placeholder="Judul kegiatan" required>
    <textarea name="deskripsi" placeholder="Deskripsi kegiatan"></textarea>
    <input type="date" name="tanggal" required>
    <button name="tambah">Tambah</button>
</form>
</div>

<!-- LIST KEGIATAN -->
<?php while ($k = mysqli_fetch_assoc($kegiatan)) { ?>
<div class="card">

<form method="POST">
    <input type="hidden" name="id" value="<?= $k['id'] ?>">
    <input name="judul" value="<?= $k['judul'] ?>">
    <textarea name="deskripsi"><?= $k['deskripsi'] ?></textarea>
    <input type="date" name="tanggal" value="<?= $k['tanggal'] ?>">
    <button name="update">Update</button>
    <a href="?delete=<?= $k['id'] ?>" class="danger"
       onclick="return confirm('Yakin hapus kegiatan ini?')">
       Delete
    </a>
</form>

<hr>

<h4>Laporan Anggota</h4>

<?php
$laporan = mysqli_query($conn,
"SELECT u.nama, ka.laporan, ka.tanggal_submit
 FROM kegiatan_anggota ka
 JOIN users u ON ka.user_id = u.id
 WHERE ka.kegiatan_id = $k[id]"
);
?>

<?php if (mysqli_num_rows($laporan) == 0) { ?>
<p><i>Belum ada anggota yang mengerjakan</i></p>
<?php } ?>

<?php while ($l = mysqli_fetch_assoc($laporan)) { ?>
<div class="report">
<b><?= $l['nama'] ?></b><br>
<?= $l['laporan'] ?><br>
<small><?= $l['tanggal_submit'] ?></small>
</div>
<?php } ?>

</div>
<?php } ?>

</div>
