<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) { //memeriksa id dan username
    include 'koneksi.php';

    // Ambil data di URL
    $id = $_GET["id"];

    // Ambil data dari database untuk ditampilkan pada form
    $query = "SELECT * FROM keluar WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);

        // Proses menyimpan ke database
        if (isset($_POST['proses'])) {
            $keterangan = $_POST['keterangan'];
            $jumlah = $_POST['jumlah'];
            $tanggal = $_POST['tanggal'];

            // Validasi data tidak boleh kosong
            if (empty($keterangan) || empty($jumlah)) {
                echo "<script>alert('Semua Kolom Harus Terisi');</script>";
            } else {
                // Lakukan pembaruan data ke database
                $query_update = "UPDATE keluar SET keterangan='$keterangan' ,jumlah='$jumlah' ,tanggal='$tanggal' WHERE id='$id'";
                $result_update = mysqli_query($conn, $query_update);

                if ($result_update) {
                    echo "<script>alert('Data berhasil diperbarui');</script>";
                    echo "<meta http-equiv=refresh content=2;URL='daftar_out.php'>";
                } else {
                    echo 'Error: ' . mysqli_error($conn);
                }
            }
        }
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
    
} else {
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
        <h1><a href="home.php" class="d">Edit Pengeluaran</a></h1>
        <div class="tag">
            <h6 class="p">Selamat Datang! <?php echo $_SESSION['nama']; ?></h6>
        <a href="logout.php" class="q">Logout</a>
        </div>
    </div>
</div>
<form action="" method="post">
    <table class="tabelbio">
        <tr>
            <th>KETERANGAN:</th>
            <th>JUMLAH:</th>
            <th>TANGGAL:</th>
        </tr>
        <tr>
            <th><input type="text" name="keterangan" placeholder="KETERANGAN" value="<?php echo $data['keterangan']; ?>"></th>
            <th><input type="text" name="jumlah" placeholder="JUMLAH" value="<?php echo $data['jumlah']; ?>"></th>
            <th><input type="date" name="tanggal" placeholder="" value="<?php echo $data['tanggal']; ?>"></th>
        </tr>
        <tr>
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