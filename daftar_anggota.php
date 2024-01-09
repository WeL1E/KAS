<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) { //memeriksa id dan username
    include 'koneksi.php';

    // Mengambil data di database
    $no=1;
    $ambildata = mysqli_query($conn, "SELECT * FROM anggota");
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
        <h1><a href="home.php" class="d">Data Anggota</a></h1>
        <div class="tag">
            <h6 class="p">Selamat Datang! <?php echo $_SESSION['nama']; ?></h6>
        <a href="logout.php" class="q">Logout</a>
        </div>
    </div>
</div>

<table class="tabelbio">
    <tr>
        <th>No:</th>
        <th>NAMA:</th>
        <th>ALAMAT:</th>
        <th>AKSI:</th>
    </tr>

    <?php //proses menampilkan data dari database
    while ($tampildata = mysqli_fetch_array($ambildata)) {
        echo "
        <tr>
            <td>$no</td>
            <td>$tampildata[nama]</td>
            <td>$tampildata[alamat]</td>
            <td>
                <form method='GET' action='edit_anggota.php'>
                    <input type='hidden' name='id' value='$tampildata[id]'>
                    <input type='submit' value='EDIT' style='width: 100%;'>
                </form>
                
                <form method='GET' action='daftar_anggota.php'>
                    <input type='hidden' name='hapus_id' value='$tampildata[id]'>
                    <input type='submit' value='HAPUS' name='hapus' style='width: 100%; margin-top: 5px;'>
                </form>
            </td>
        </tr>";

        $no++;
    }
    ?>
</table>

<?php //proses hapus data dari database
if(isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus_id'];
    
    $query_delete = "DELETE FROM anggota WHERE id='$id_hapus'";
    
    if (mysqli_query($conn, $query_delete)) {
        echo "<script>alert('Data berhasil dihapus');</script>";
        echo "<meta http-equiv=refresh content=2;URL='daftar_anggota.php'>";
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>

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
} else {
    header("Location: login.php");
    exit();
}
?>
