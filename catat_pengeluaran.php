<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) { //memeriksa id dan username
    include 'koneksi.php';

    // Proses menyimpan ke database
    if (isset($_POST['proses'])) {
        $ket = $_POST['ket'];
        $harga = $_POST['harga'];
        $tanggal = $_POST['tanggal'];

        // Validasi data tidak boleh kosong
        if (empty($ket) || empty($harga) || empty($tanggal)) {
            echo "<script>alert('Semua Kolom Harus Terisi');</script>";
        } else {
            // Pemeriksaan apakah data sudah ada dalam database
            $cekquery = mysqli_query($conn, "SELECT * FROM keluar WHERE keterangan = '$ket' AND jumlah = '$harga' AND tanggal = '$tanggal'");
            $cekdata = mysqli_fetch_assoc($cekquery);

            if (!$cekdata) {
                // Jika data belum ada, lakukan penyimpanan
                mysqli_query($conn, "INSERT INTO keluar SET keterangan = '$ket', jumlah = '$harga', tanggal = '$tanggal'");
                echo "<script>alert('Data berhasil disimpan');</script>";
                echo "<meta http-equiv=refresh content=2;URL='daftar_out.php'>";
            } else {
                // Jika data sudah ada, berikan pesan kesalahan
                echo "<script>alert('Data dengan nama dan alamat tersebut sudah ada');</script>";
            }
        }
    }
} else { //jika belum login maka tidak bisa masuk ke halaman selanjutnya
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<title>HOME</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style/style2.css">
<body>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large"
    onclick="w3_close()">Close &times;</button>
    <a href="home.php" class="w3-bar-item w3-button">Dashboard</a>
    <a href="tambah_anggota.php" class="w3-bar-item w3-button">Tambah anggota</a>
    <a href="daftar_anggota.php" class="w3-bar-item w3-button">Daftar anggota</a>
    <a href="setor.php" class="w3-bar-item w3-button">Setor kas</a>
    <a href="daftar_kas.php" class="w3-bar-item w3-button">Daftar kas</a>
    <a href="nunda_kas.php" class="w3-bar-item w3-button">Nunda kas</a>
    <a href="catat_pengeluaran.php" class="w3-bar-item w3-button">Catat pengeluaran</a>
    <a href="daftar_out.php" class="w3-bar-item w3-button">Daftar pengeluaran</a>
</div>

<div id="main">

<div class="w3-teal">
    <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
    <div class="w3-container">
        <h1><a href="home.php" class="d">Catat Pengeluaran</a></h1>
        <div class="tag">
            <h6 class="p">Selamat Datang! <?php echo $_SESSION['nama']; ?></h6>
        <a href="logout.php" class="q">Logout</a>
        </div>
    </div>
</div>
<form action="" method="post">
    <table class="tabelbio">
        <tr>
            <th>Keterangan:</th>
            <th>Harga:</th>
            <th>Tanggal:</th>
        </tr>
        <tr>
            <th><input type="text" name="ket" placeholder="KETERANGAN"></th>
            <th><input type="text" name="harga" placeholder="HARGA"></th>
            <th><input type="date" name="tanggal" placeholder=""></th>
        </tr>
            <td colspan="4" style="text-align: left;"><input type="submit" value="SIMPAN" name="proses"></td>
        </tr>
    </table>
</form>

<footer>
    <p>Footer</p>
</footer>
<script>
function w3_open() {
    document.getElementById("main").style.marginLeft = "25%";
    document.getElementById("mySidebar").style.width = "25%";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
    document.getElementById("main").style.marginLeft = "0%";
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("openNav").style.display = "inline-block";
}
</script>

</body>
</html>

