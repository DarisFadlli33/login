<?php
session_start();
include "../config/db.php";

$user = $_POST['username'];
$pass = md5($_POST['password']);

$query = mysqli_query($conn,
    "SELECT * FROM users WHERE username='$user' AND password='$pass'"
);

$data = mysqli_fetch_assoc($query);

if ($data) {
    $_SESSION['login'] = true;
    $_SESSION['role'] = $data['role'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['id'] = $data['id'];


    if ($data['role'] == 'admin') {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../user/dashboard.php");
    }
} else {
    echo "Login gagal";
}
