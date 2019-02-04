<?php
	session_start();
?>
<!DOCTYPE html>
	<html lang="pl">
		<head>
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="stylesheet" type="text/css" href="style.css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<meta charset="utf-8">
			<title>Logowanie</title>
		</head>
		<body>
			<div class="container">
				<?php
					require('panel.php');
				?>
		<div class="row">
		<div class="header">
		<h1><a href="index.php"><img src="logo.png"></a></h1>
		<h1>Logowanie</h1>
		</div>
	</div>
		<div class="formularz">
		<?php 
		echo "<form method='post'>
		<div class='form-group>'
			<label for='email'>Adres e-mail:</label><input type='email' class='form-control' name='email' id='email' value='" . "' aria-describedby='emailHelp' placeholder=''><br>
		</div>
		<div class='form-group>'
			<label for='password'>Hasło:</label><input type='text' class='form-control' name='password' id='password'><br>
		</div>
		
			<input type='submit' class='btn btn-primary' name='submit' value='Sign in' id='submit'>

		</form>";

			include("connect.php");
			$city = @$_POST['city'];
			if (isset($_POST['submit'])) {
				$email = $_POST['email'];
				$password = $_POST['password'];

				$query = mysqli_query($connect,"SELECT * from user");
				if (mysqli_num_rows($query) > 0) {
					while ($wynik = mysqli_fetch_array($query)) {
						if ($email == $wynik['mail'] && $password == $wynik['pass']) {
							$query = mysqli_query($connect,"SELECT * from user where id_user=1");
							while ($wynik2 = mysqli_fetch_array($query)) {
							if ($email == $wynik2['mail'] && $password == $wynik2['pass']) {
								$_SESSION["user"] = $email;
								$_SESSION["password"] = $password;
								echo "<script>location.href='index.php';</script>";
							}
							else{
								$_SESSION["user"] = $email;
								$_SESSION["password"] = $password;
								echo "<script>location.href='index.php';</script>";
							}
						}
						}
						else
							echo "wal sie";
					}
				}
			}
		 ?>
		</div>
		 </div>
		</body>
	</html>