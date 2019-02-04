<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<meta charset="utf-8">

		<title>Rejestracja</title>
	</head>
	<body>
		<div class="container">
			<?php
				require('panel.php');
			?>
		<div class="row">
		<div class="header">
		<h1><a href="index.php"><img src="logo.png"></a></h1>
		<h1>Rejestracja</h1>
		</div>
	</div>
		<div class="formularz">
		<?php 
		echo "<form method='post'>
		<div class='form-group>'
			<label for='email'>Adres e-mail:</label><input type='email' class='form-control' name='email' id='email' value='" . @$_POST['email'] ."' aria-describedby='emailHelp' placeholder=''><br>
		</div>
		<div class='form-group>'
			<label for='password'>Hasło:</label><input type='text' class='form-control' name='password' id='password'><br>
		</div>
		<div class='form-group>'
			<label for='confPassword'>Potwierdź hasło:</label><input type='text' class='form-control' name='confPassword' id='confPassword'><br>
		</div>
		<div class='form-group>'
			<label for='name'>Imię:</label><input type='text' class='form-control' name='name' id='name' value='" . @$_POST['name'] ."'><br>
		</div>
		<div class='form-group>'
			<label for='surname'>Nazwisko:</label><input type='text' class='form-control' name='surname' id='surname' value='" . @$_POST['surname'] ."'><br>
		</div>
		<div class='form-group>'
			<label for='city'>Miasto*:</label><input type='text' class='form-control' name='city' id='city' value='" . @$_POST['city'] ."'><br>
		</div>
		<div class='form-check>'
			<label for='terms' class='form-check-label'>Potwierdź regulamin</label>
			<input type='checkbox' name='terms' id='terms' class='form-check-input'>
		</div>
			<input type='submit' class='btn btn-primary' name='submit' value='Sign in' id='submit'>

		</form>";

			include("connect.php");
			$city = @$_POST['city'];
			if (isset($_POST['submit'])) {
				$email = $_POST['email'];
				$password = $_POST['password'];
				$confPassword = $_POST['confPassword'];
				$name = $_POST['name'];
				$surname = $_POST['surname'];
				
				$terms = @$_POST['terms'];

				if (!empty($email) && !empty($password) && !empty($confPassword) && !empty($name) && !empty($surname) && !empty($city) && !empty($terms)) {
					$wynik = mysqli_query($connect,"SELECT mail from user where mail='{$email}'");
					$liczba_rekordow = mysqli_num_rows($wynik);
						if ($liczba_rekordow == 0) {
								if ($password == $confPassword) {
									$add = "INSERT INTO user()
									VALUES('','{$email}','{$password}','{$name}','{$surname}','{$city}')";
									
									$connect->query($add);
									echo "Dodano do użytkowników";
									// echo "<script>location.href='rejestracja.php';</script>";
									// echo "<meta http-equiv='refresh' content='10'>";
								}
								else
								{
									echo "Hasła muszą być takie same";
								}
								
							}
					}elseif (!empty($email) && !empty($password) && !empty($confPassword) && !empty($name) && !empty($surname) && !empty($terms)) {
						$wynik = mysqli_query($connect,"SELECT mail from user where mail='{$email}'");
						$liczba_rekordow = mysqli_num_rows($wynik);
							if ($liczba_rekordow == 0) {
									if ($password == $confPassword) {
										$add = "INSERT INTO user()
										VALUES('','{$email}','{$password}','{$name}','{$surname}','')";
										$connect->query($add);
										echo "Dodano do użytkowników";
										echo "Przejdź do <a href='index.php'>Strony głównej</a>";
									// 	echo "<script>location.href='rejestracja.php';</script>";
									// 	echo "<meta http-equiv='refresh' content='10'>";
									}
									else
								{
									echo "Hasła muszą być takie same";
								}
								
							}

				}elseif (empty($email) && empty($password) && empty($confPassword) && empty($name) && empty($surname) && empty($terms)) {
					echo "Wypełnij pola";
				}
			}
		 ?>
		</div>
		 </div>
	</body>
</html>