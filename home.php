<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) { //memeriksa id dan username
include 'koneksi.php';

//mentotalkan uang kas
$query = mysqli_query($conn, "SELECT SUM(jumlah) AS total_jumlah FROM masuk");
$result = mysqli_fetch_assoc($query);
$total1 = number_format($result['total_jumlah'], 0, ',', ',');

//mentotalkan uang pengeluaran
$query1 = mysqli_query($conn, "SELECT SUM(jumlah) AS total_jumlah FROM keluar");
$result1 = mysqli_fetch_assoc($query1);
$total2 = number_format($result1['total_jumlah'], 0, ',', ',');

//mentotalkan anggota
$query3 = mysqli_query($conn, "SELECT * FROM anggota");
$total3 = mysqli_num_rows($query3);

//mentotalkan pengeluaran
$query4 = mysqli_query($conn, "SELECT * FROM keluar");
$total4 = mysqli_num_rows($query4);
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
        <h1><a href="home.php" class="d">Dashboard</a></h1>
        <div class="tag">
            <h6 class="p">Selamat Datang! <?php echo $_SESSION['nama']; ?></h6>
        <a href="logout.php" class="q">Logout</a>
        </div>
    </div>
</div>
<ul>
    <li><a href="daftar_kas.php">TOTAL UANG KAS</a><br><div class="ttl3"><?php echo 'Rp.' . $total1;?></div></li>
    <li><a href="daftar_out.php">TOTAL PENGELUARAN UANG</a><br><div class="ttl3"><?php echo 'Rp.' . $total2;?></div></li>
    <li><a href="daftar_anggota.php">TOTAL ANGGOTA</a><br><div class="ttl3"><?php echo $total3 ?></div></li>
    <li><a href="daftar_out.php">TOTAL PENGELUARAN</a><br><div class="ttl3"><?php echo $total4 ?></div></li>
</ul>

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

