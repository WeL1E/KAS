<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) { //memeriksa id dan username
    include 'koneksi.php';

    // Ambil data di URL
    $id = $_GET["id"];

    // Ambil data dari database untuk ditampilkan pada form
    $query = "SELECT * FROM anggota WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = mysqli_fetch_assoc($result);

        // Proses menyimpan ke database
        if (isset($_POST['proses'])) {
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];

            // Validasi data tidak boleh kosong
            if (empty($nama) || empty($alamat)) {
                echo "<script>alert('Semua Kolom Harus Terisi');</script>";
            } else {
                // Lakukan pembaruan data ke database
                $query_update = "UPDATE anggota SET nama='$nama', alamat='$alamat' WHERE id='$id'";
                $result_update = mysqli_query($conn, $query_update);

                if ($result_update) {
                    echo "<script>alert('Data berhasil diperbarui');</script>";
                    echo "<meta http-equiv=refresh content=2;URL='daftar_anggota.php'>";
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
        <h1><a href="home.php" class="d">Edit Anggota</a></h1>
        <div class="tag">
            <h6 class="p">Selamat Datang! <?php echo $_SESSION['nama']; ?></h6>
        <a href="logout.php" class="q">Logout</a>
        </div>
    </div>
</div>
<form action="" method="post">
    <table class="tabelbio">
        <tr>
            <th>NAMA:</th>
            <th>ALAMAT:</th>
        </tr>
        <tr>
            <th><input type="text" name="nama" placeholder="NAMA" value="<?php echo $data['nama']; ?>"></th>
            <th><input type="text" name="alamat" placeholder="ALAMAT" value="<?php echo $data['alamat']; ?>"></th>
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