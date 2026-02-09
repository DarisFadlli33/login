<?php
session_start();
include "../config/db.php";
include "../config/stats.php";

// Cek apakah user sudah login
if (!isset($_SESSION['id'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Dapatkan data statistik
$totalUsers = getTotalUsers($conn);
$totalKegiatan = getTotalKegiatan($conn);
?>

<link rel="stylesheet" href="../assets/style.css">

<div class="dashboard">

    <div class="sidebar">
        <h2>ADMIN</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="users.php">Users</a>
        <a href="kegiatan.php">Kegiatan</a>
        <a href="../auth/logout.php">Logout</a>
    </div>

    <div class="content">
        <div class="topbar">
            <h1>Dashboard Admin</h1>
            <a class="logout" href="../auth/logout.php">Logout</a>
        </div>

        <div class="stats">
            <div class="stat-card">
                <h3>Total User</h3>
                <p><?php echo $totalUsers ?? 0; ?></p>
            </div>
            <div class="stat-card">
                <h3>Total Kegiatan</h3>
                <p><?php echo $totalKegiatan ?? 0; ?></p>
            </div>
        </div>

        <div class="card">
            <h3>Selamat Datang Admin 👋</h3>
            <p>Kelola user dan pantau kegiatan anggota di sini.</p>
        </div>
    </div>

</div>
