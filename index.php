<?php 
session_start(); 
include "koneksi.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: login.php?error=Username_Tidak_Boleh_Kosong");
        exit();
	}else if(empty($pass)){
        header("Location: login.php?error=Password_Tidak_Boleh_Kosong");
        exit();
	}else{
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
            }else{
				header("Location: login.php?error=Username_atau_Password_salah");
                exit();
			}
		}else{
			header("Location: login.php?error=Username_atau_Password_salah");
            exit();
		}
	}
	
}else{
	header("Location: login.php");
	exit();
}