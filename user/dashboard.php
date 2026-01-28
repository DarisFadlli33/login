<?php
session_start();
include "../config/db.php";
$user = $_SESSION['nama'];
$id_user = $_SESSION['id'];

$kegiatan = mysqli_query($conn, "SELECT * FROM kegiatan");

if (!isset($_SESSION['id'])) {
    header("Location: ../auth/login.php");
    exit;
}

if (isset($_POST['kirim'])) {
    mysqli_query($conn, "INSERT INTO kegiatan_anggota VALUES(
        '',
        '$_POST[kegiatan_id]',
        '$id_user',
        '$_POST[laporan]',
        CURDATE()
    )");
}
?>

<link rel="stylesheet" href="../assets/style.css">

<div class="container">
<h1>Dashboard Anggota</h1>

<?php while ($k = mysqli_fetch_assoc($kegiatan)) { ?>
<div class="card">
<h3><?= $k['judul'] ?></h3>
<p><?= $k['deskripsi'] ?></p>

<form method="POST">
<input type="hidden" name="kegiatan_id" value="<?= $k['id'] ?>">
<textarea name="laporan" placeholder="Tulis laporan kegiatan"></textarea>
<button name="kirim">Kirim Laporan</button>
</form>

</div>
<?php } ?>
</div>
