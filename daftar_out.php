<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) { //memeriksa id dan username
    include 'koneksi.php';

    // Mengambil data yang berada di database
    $no=1;
    $ambildatar = mysqli_query($conn, "SELECT * FROM keluar");
?>
<?php
$query6 = mysqli_query($conn, "SELECT SUM(jumlah) AS total_jumlah FROM keluar");
$result6 = mysqli_fetch_assoc($query6);
$total6 = number_format($result6['total_jumlah'], 0, ',', ',');
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
        <h1><a href="home.php" class="d">Data Pengeluaran Kas</a></h1>
        <div class="tag">
            <h6 class="p">Selamat Datang! <?php echo $_SESSION['nama']; ?></h6>
        <a href="logout.php" class="q">Logout</a>
        </div>
    </div>
</div>
<table class="tabelbio">
    <tr>
        <th>No:</th>
        <th>KETERANGAN:</th>
        <th>HARGA:</th>
        <th>TANGGAL:</th>
    </tr>

    <?php //proses menampilkan data dari database
    while ($tampildatar = mysqli_fetch_array($ambildatar)) {
        echo "
        <tr>
            <td>$no</td>
            <td>$tampildatar[keterangan]</td>
            <td>Rp." . number_format($tampildatar['jumlah'], 0, ',', '.') . "</td>
            <td>$tampildatar[tanggal]</td>
        </tr>";

        $no++;
    }
    ?>

    <tr>
        <td colspan="4" style="text-align: left;">TOTAL PENGELUARAN : Rp.<?php echo $total6; ?></td>
    </tr>
</table>


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

<?php 
}else{
    header("Location: login.php");
    exit();
}
?>