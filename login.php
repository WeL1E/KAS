<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
			<div class="signup">
				<form action="index.php" method="post">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="text" name="uname" placeholder="Username">
					<input type="password" name="password" placeholder="Password">
					<button>Login</button>
				</form>
			</div>
			<div class="login">
			<form action="lupa.php" method="post">
				<label for="chk" aria-hidden="true">Lupa?</label>
				<input type="text" name="uname" placeholder="Username">
				<input type="password" name="password" placeholder="Password baru">
				<button type="submit">Kirim</button>
			</form>
			</div>
	</div>
</body>
</html>