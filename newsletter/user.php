<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head lang="pl">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<link rel="stylesheet" type="text/css" href="style.css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			<meta charset="utf-8">


			<style type="text/css">
				.op {
					background-color: red;
					padding: 20px;
				}
				.col-4 {
					/*border:1px solid red;*/
					border-left: 1px solid black;
					width: 20rem;
					float: right;
				}
				.col-8 {
					/*border:1px solid blue;*/
					width: 80rem;
					float: left;
				}
			</style>
	<title>Panel użytkownika</title>
</head>
<body>
<div class="container">
				<?php
					require('panel.php');
				?>
				
				<div class="row">
					<div class="header">
						<h1><a href="index.php"><img src="logo.png"></a></h1>
						<h1>Panel użytkownika</h1>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-8">
							
							<div>
								<?php
								
									require('connect.php');
									$user = $_SESSION["user"];

									if (isset($_GET['action'])) {
										if ($_GET['action'] == "edit") {
											$query = mysqli_query($connect,"SELECT * from user where mail='$user'");
											if (mysqli_num_rows($query) > 0) { 
									while ($wynik = mysqli_fetch_array($query)) {
											$user = $_SESSION["user"];
											echo "<form method='post' class='password'>
											<label for='old_pass'>Insert old password:</label>
											<input class='form-control' type='text' name='old_pass' id='old_pass'><br>
											<label for='new_pass'>Insert new password:</label>
											<input class='form-control' type='text' name='new_pass' id='new_pass'><br>
											<label for='new_pass2'>Confirm new password:</label>
											<input class='form-control' type='text' name='new_pass2' id='new_pass2'><br>
											<input type='submit' value='Change'>
											</form>";

										if (isset($_POST['old_pass'],$_POST['new_pass'],$_POST['new_pass2'])) {
											$old_pass = $_POST['old_pass'];
											$new_pass = $_POST['new_pass'];
											$new_pass2 = $_POST['new_pass2'];
											if ($old_pass == $wynik['pass']) {
												if ($new_pass == $new_pass2) {
													$change = mysqli_query($connect,"UPDATE user SET pass='$new_pass' where mail='$user'")or die('Query error');
														if ($change)
															echo "Password changed";

												}else {echo "Passwords have to match";}
											}

										}
									}
								}
							}
						}
							else {
								echo "Witaj " . $_SESSION["user"];
							}
								?>
							
							</div>
						</div>
						<div class="col-4">
							
						<ul class="nav flex-column">
						  <li class="nav-item">
						    <a class="nav-link" href="user.php?action=edit">Change password</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" href="edit.php">Edit post</a>
						  </li>
						   <li class="nav-item">
						    <a class="nav-link" href="news_adding.php">Add post</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" href="index.php">Posts</a>
						  </li>
						</ul>
						</div>
					</div>
				</div>
</body>
</html>