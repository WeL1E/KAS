<?php 
session_start(); 
include "koneksi.php";

if (isset($_POST['uname']) && isset($_POST['password'])) { //memeriksa id dan username

    $uname = $_POST['uname'];
    $pass = $_POST['password'];

    if (empty($uname)) {
        echo "<script>alert('Username tidak boleh kosong');</script>";
        echo "<script>window.location='login.php';</script>";
        exit();
    } else if(empty($pass)){
        echo "<script>alert('Password tidak boleh kosong');</script>";
        echo "<script>window.location='login.php';</script>";
        exit();
    } else {
        $sql = "SELECT * FROM admins WHERE username='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $uname && $row['password'] === $pass) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['nama'] = $row['nama'];
                $_SESSION['id'] = $row['id'];
                header("Location: home.php");
                exit();
            } else {
                echo "<script>alert('Username atau Password salah');</script>";
                echo "<script>window.location='login.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Username atau Password salah');</script>";
            echo "<script>window.location='login.php';</script>";
            exit();
        }
    }
    
} else {
    header("Location: login.php");
    exit();
}
?>