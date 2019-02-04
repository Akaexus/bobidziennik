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
						<h1>Panel Administratora</h1>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-8">
							
							<div>
								<?php
								
											include('connect.php');

					
					$result = mysqli_query($connect,"SELECT * from user order by id_user asc");
					               $category = mysqli_query($connect,"SELECT distinct * FROM categories"); // Kwerenda kategorii

					if (isset($_GET['action'], $_GET['id'])) {
						echo "<h2>Panel Edycji</h2>";
					
					$action = $_GET['action'];
					$id= $_GET['id'];

					if ($action=="delete" && $id>0) {
											$delete = "DELETE from user where id_user={$id} LIMIT 1";
						$connect->query($delete);
						if($delete)
						echo "<script>location.href='user_manage.php';</script>";
							
						}
						elseif ($action == "edit") {
							$query = mysqli_query($connect,"SELECT * from user where id_user='$id'");

							if (mysqli_num_rows($query) > 0) { 
								while ($wynik = mysqli_fetch_array($query))
	               			{
									echo
               	'<form method="post" action="?action=save&id='.$wynik['id_user'].'">
               	<label for="mail">Mail:</label>
               	<input class="form-control" type="text" name="mail" id="mail" value="' . $wynik['mail'] .'"><br>
               	<label for="password">Password:</label>
               	<input class="form-control" type="text" name="password" id="password" value="' . $wynik['pass'] .'"><br>
               	<label for="name">Name:</label>
               	<input class="form-control" type="text" name="name" id="date" value="' . $wynik['name'] .'"><br>
               	<label for="surname">Surname:</label>
               	<input class="form-control" type="text" name="surname" id="surnme" value="' . $wynik['last_name'] .'"><br>
               	<label for="city">city:</label>
               	<input class="form-control" type="text" name="city" id="city" value="' . $wynik['city'] .'"><br>
               
               	
               	<input class="btn btn-primary" type="submit" name="submit" value="Confirm">';
               	echo "<button class='btn btn-danger' onclick=location.href='user_manage.php'>Cancel</button>";
               echo '</form>';
			}
		}
	}elseif ($action == "save") {
				$mail = trim($_POST['mail']);
                $password = trim($_POST['password']);
               	$name = trim($_POST['name']);
               	$surname = trim($_POST['surname']);
               	$city = trim($_POST['city']);
               	echo "UPDATE user set mail='$mail', `pass`='$password', `name`='$name', `last_name`='$surname' `city`='$city' where id_user=$id";
               	$change = mysqli_query($connect,"UPDATE user set mail='$mail', `pass`='$password', `name`='$name', `last_name`='$surname', `city`='$city' where id_user='$id'")or die('Błąd zapytania');
               	if ($change)
			echo "<script>location.href='user_manage.php'</script>";
			} 
						}
					else
					{
						echo '<table class="table">
						  <thead>
						    <tr>
						      <th scope="col">ID</th>
						      <th scope="col">Mail</th>
						      <th scope="col">Password</th>
						      <th scope="col">Name</th>
						      <th scope="col">Surname</th>
						      <th scope="col">City</th>
						    </tr>
						  </thead>
						  </tr>';
						  echo '<tbody>';
						  if(mysqli_num_rows($result) >0){ 
	               		while ($wynik = mysqli_fetch_array($result))
	               			{
	               				echo ' <tr>
									      <th scope="row">'. $wynik['id_user'] .'</th>
									      <td>'. $wynik['mail'] .'</td>
									      <td>'. $wynik['pass'] .'</td>
									      <td>'. $wynik['name'] .'</td>
									      <td>'. $wynik['last_name'] .'</td>
									      <td>'. $wynik['city'] .'</td>
									      <td>'. '<a href="?action=edit&id='. $wynik['id_user'] .'"><button type="button" class="btn btn-light">Edit</button></a></td>
									      <td>'. '<a href="?action=delete&id='. $wynik['id_user'] .'"><button type="button" class="btn btn-danger">Delete</button></a></td>
									    </tr>';
	               			}
	               		}
	               		echo "</table>";
	               		
					}
								?>
							
							</div>
						</div>
						<div class="col-4">
							
						<ul class="nav flex-column">
						  <li class="nav-item">
						    <a class="nav-link" href="admin.php?action=pass">Change password</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" href="edit.php">Edit post</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" href="#">Manage users</a>
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