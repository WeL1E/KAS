<?php
// Sambungkan ke database
include 'koneksi.php';

// Tangkap data dari form
$username = $_POST['uname'];
$newPassword = $_POST['password'];

// Cek apakah username ada di database
$cekUsernameQuery = "SELECT * FROM admins WHERE username='$username'";
$cekUsernameResult = mysqli_query($conn, $cekUsernameQuery);

if (mysqli_num_rows($cekUsernameResult) > 0) {
    // Jika username ditemukan, lanjutkan dengan pembaruan password
    $updatePasswordQuery = "UPDATE admins SET password='$newPassword' WHERE username='$username'";
    $updatePasswordResult = mysqli_query($conn, $updatePasswordQuery);

    if ($updatePasswordResult) {
        echo "<script>alert('Password berhasil diperbarui');</script>";
        echo "<script>window.location='login.php';</script>";
    } else {
        echo "Gagal memperbarui password: " . mysqli_error($conn);
    }
} else {
    // Jika username tidak ditemukan, tampilkan pesan kesalahan
    echo "<script>alert('Username tidak valid');</script>";
	echo "<script>window.location='login.php';</script>";
}
?>
