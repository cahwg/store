<?php
// Memulai session
session_start();
include '../koneksi.php';

// Menerima data username dan password dari form
$username = $_POST['username'];
$password = $_POST['password'];
$nama_user = $_POST['nama_user'];
$id_level = $_POST['id_level'];

// Anda perlu menghash kata sandi dengan algoritma yang aman sebelum menyimpannya di database
// Contoh penggunaan fungsi password_hash:
// $hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Mengeksekusi operasi INSERT dengan prepared statement
$query = "INSERT INTO tb_user (username, password, nama_user, id_level) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($kon, $query);
if ($stmt) {
    // Mengikat parameter ke prepared statement
    mysqli_stmt_bind_param($stmt, "sssi", $username, $password, $nama_user, $id_level);

    // Mengeksekusi prepared statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Operasi INSERT berhasil
        header('location: index.php');
    } else {
        // Operasi INSERT gagal
        echo "Gagal menambahkan pengguna. Silakan cek kembali data yang dimasukkan.";
    }
} else {
    echo "Gagal menyiapkan pernyataan SQL.";
}
?>