<?php
// Function untuk mendapatkan total pengguna
function getTotalUsers($conn) {
    $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
    $result = mysqli_fetch_assoc($query);
    return $result['total'] ?? 0;
}

// Function untuk mendapatkan total kegiatan
function getTotalKegiatan($conn) {
    $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM kegiatan");
    $result = mysqli_fetch_assoc($query);
    return $result['total'] ?? 0;
}

// Function untuk mendapatkan total kegiatan anggota (laporan)
function getTotalKegiatanAnggota($conn) {
    $query = mysqli_query($conn, "SELECT COUNT(*) as total FROM kegiatan_anggota");
    $result = mysqli_fetch_assoc($query);
    return $result['total'] ?? 0;
}
?>
