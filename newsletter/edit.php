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
							<?php
								if ($_SESSION["user"] == "admin@admin.com") {
									echo "<h1>Panel Administratora</h1>";
								}
								else {
									echo "<h1>Panel Użytkownika</h1>";
								}
							?>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-8">
							
							<div>
								<?php
								
											include('connect.php');
					if ($_SESSION["user"] == "admin@admin.com") {
						// Uber zapytanie
					$result = mysqli_query($connect,"SELECT * from news inner join categories using(id_category) inner join user on news.author=user.id_user ORDER BY news.id asc"); 
					               $category = mysqli_query($connect,"SELECT distinct * FROM categories"); // Kwerenda kategorii

					if (isset($_GET['action'], $_GET['id'])) {
						echo "<h2>Panel Edycji</h2>";
					
					$action = $_GET['action'];
					$id= $_GET['id'];
					// Usuwanie
					if ($action=="delete" && $id>0) {
											$delete = "DELETE from news where id={$id} LIMIT 1";
						$connect->query($delete);
						if($delete)
						echo "<script>location.href='edit.php';</script>";
							
						}
						elseif ($action == "edit") { 		// Edycja
							$query = mysqli_query($connect,"SELECT * from news inner join categories using(id_category) where id={$id}");

							if (mysqli_num_rows($query) > 0) { 
								while ($wynik = mysqli_fetch_array($query))
	               			{
									echo
               	'<form method="post" action="?action=save&id='.$wynik['id'].'">
               	<label for="title">Title:</label>
               	<input class="form-control" type="text" name="title" id="title" value="' . $wynik['title'] .'"><br>
               	<label for="date">Date:</label>
               	<input class="form-control" type="date" name="date" id="date" value="' . $wynik['date'] .'"><br>
               	<label for="list">Category:</label>
               	<select class="form-control" id="list" name="list" value="' . $wynik['category'] .'">
               	<option selected="selected" value="' . $wynik['id_category'] . '">' . $wynik['category'] . '</option>';
               	
               	for ($i=0; $i < mysqli_num_rows($category); $i++) {  // Wyświetlanie opcji wyboru
               		while ($list = @mysqli_fetch_array($category))
               			{echo '<option  value="' . $list['id_category'] . '">' . $list['category'] . '</option>';}
               	}
               	echo '</select><br>
               	<label id="content">Content:</label><br>
               	<textarea class="form-control" rows="7" cols="50" name="content" id="content">' . $wynik['content'] .'</textarea><br>
               	<input class="btn btn-primary" type="submit" name="submit" value="Confirm">';
               	echo "<button class='btn btn-danger' onclick=location.href='edit.php'>Cancel</button>";
               echo '</form>';
			}
		}
	}elseif ($action == "save") {		// Zapis
				$title = trim($_POST['title']);
                $date = trim($_POST['date']);
               	$list = trim($_POST['list']);
               	$content = trim($_POST['content']);
               	$change = mysqli_query($connect,"UPDATE news set title='$title', `date`='$date', id_category='$list', content='$content' where id='$id'")or die('Błąd zapytania');
               	if ($change)
			echo "<script>location.href='edit.php'</script>";
			} 
						}
					else
					{
						echo '<table class="table">
						  <thead>
						    <tr>
						      <th scope="col">ID</th>
						      <th scope="col">Title</th>
						      <th scope="col">Date</th>
						      <th scope="col">Category</th>
						      <th scope="col">Author</th>
						      <th scope="col">Edit</th>
						      <th scope="col">Delete</th>
						    </tr>
						  </thead>
						  </tr>';
						  echo '<tbody>';
						  if(mysqli_num_rows($result) >0){ 
	               		while ($wynik = mysqli_fetch_array($result))
	               			{
	               				echo ' <tr>
									      <th scope="row">'. $wynik['id'] .'</th>
									      <td>'. $wynik['title'] .'</td>
									      <td>'. $wynik['date'] .'</td>
									      <td>'. $wynik['category'] .'</td>
									      <td>'. $wynik['mail'] .'</td>
									      <td>'. '<a href="?action=edit&id='. $wynik['id'] .'"><button type="button" class="btn btn-light">Edit</button></a></td>
									      <td>'. '<a href="?action=delete&id='. $wynik['id'] .'"><button type="button" class="btn btn-danger">Delete</button></a></td>
									    </tr>';
	               			}
	               		}
	               		echo "</table>";
	               		
					}
					}
					else{			// Panel usera
						echo "jesteś tylko userem<br>";
						$user = $_SESSION["user"];
						$user_info = mysqli_query($connect,"SELECT * FROM user where mail='$user'");
						$author_info = mysqli_fetch_assoc($user_info);
						$author = $author_info['id_user'];
						
						$result = mysqli_query($connect,"SELECT * from news inner join categories using(id_category) inner join user on news.author=user.id_user where news.author='$author' ORDER BY news.id asc"); 
					               $category = mysqli_query($connect,"SELECT distinct * FROM categories"); // Kwerenda kategorii

					if (isset($_GET['action'], $_GET['id'])) {
						echo "<h2>Panel Edycji</h2>";
					
					$action = $_GET['action'];
					$id= $_GET['id'];
					// Usuwanie
					if ($action=="delete" && $id>0) {
											$delete = "DELETE from news where id={$id} LIMIT 1";
						$connect->query($delete);
						if($delete)
						echo "<script>location.href='edit.php';</script>";
							
						}
						elseif ($action == "edit") { 		// Edycja
							$query = mysqli_query($connect,"SELECT * from news inner join categories using(id_category) where id={$id}");

							if (mysqli_num_rows($query) > 0) { 
								while ($wynik = mysqli_fetch_array($query))
	               			{
									echo
               	'<form method="post" action="?action=save&id='.$wynik['id'].'">
               	<label for="title">Title:</label>
               	<input class="form-control" type="text" name="title" id="title" value="' . $wynik['title'] .'"><br>
               	<label for="date">Date:</label>
               	<input class="form-control" type="date" name="date" id="date" value="' . $wynik['date'] .'"><br>
               	<label for="list">Category:</label>
               	<select class="form-control" id="list" name="list" value="' . $wynik['category'] .'">
               	<option selected="selected" value="' . $wynik['id_category'] . '">' . $wynik['category'] . '</option>';
               	
               	for ($i=0; $i < mysqli_num_rows($category); $i++) {  // Wyświetlanie opcji wyboru
               		while ($list = @mysqli_fetch_array($category))
               			{echo '<option  value="' . $list['id_category'] . '">' . $list['category'] . '</option>';}
               	}
               	echo '</select><br>
               	<label id="content">Content:</label><br>
               	<textarea class="form-control" rows="7" cols="50" name="content" id="content">' . $wynik['content'] .'</textarea><br>
               	<input class="btn btn-primary" type="submit" name="submit" value="Confirm">';
               	echo "<button class='btn btn-danger' onclick=location.href='edit.php'>Cancel</button>";
               echo '</form>';
			}
		}
	}elseif ($action == "save") {		// Zapis
				$title = trim($_POST['title']);
                $date = trim($_POST['date']);
               	$list = trim($_POST['list']);
               	$content = trim($_POST['content']);
               	$change = mysqli_query($connect,"UPDATE news set title='$title', `date`='$date', id_category='$list', content='$content' where id='$id'")or die('Błąd zapytania');
               	if ($change)
			echo "<script>location.href='edit.php'</script>";
			} 
						}
					else
					{
						echo '<table class="table">
						  <thead>
						    <tr>
						      <th scope="col">ID</th>
						      <th scope="col">Title</th>
						      <th scope="col">Date</th>
						      <th scope="col">Category</th>
						      <th scope="col">Author</th>
						      <th scope="col">Edit</th>
						      <th scope="col">Delete</th>
						    </tr>
						  </thead>
						  </tr>';
						  echo '<tbody>';
						  if(mysqli_num_rows($result) >0){ 
	               		while ($wynik = mysqli_fetch_array($result))
	               			{
	               				echo ' <tr>
									      <th scope="row">'. $wynik['id'] .'</th>
									      <td>'. $wynik['title'] .'</td>
									      <td>'. $wynik['date'] .'</td>
									      <td>'. $wynik['category'] .'</td>
									      <td>'. $wynik['mail'] .'</td>
									      <td>'. '<a href="?action=edit&id='. $wynik['id'] .'"><button type="button" class="btn btn-light">Edit</button></a></td>
									      <td>'. '<a href="?action=delete&id='. $wynik['id'] .'"><button type="button" class="btn btn-danger">Delete</button></a></td>
									    </tr>';
	               			}
	               		}
	               		echo "</table>";
	               		
					}
					}
					
								?>
							
							</div>
						</div>
						<div class="col-4">
							
						<ul class="nav flex-column">
							<?php
								if ($_SESSION["user"] == "admin@admin.com") {
									echo 
									"<li class='nav-item'>
						   			 <a class='nav-link' href='admin.php?action=pass'>Change password</a>
						 		 	</li>";
								}
								else{
									echo 
									"<li class='nav-item'>
						   			 <a class='nav-link' href='user.php?action=edit'>Change password</a>
						 		 	</li>";
								}
							?>
						  
						  <li class="nav-item">
						    <a class="nav-link" href="edit.php">Edit post</a>
						  </li>
						  <?php
						  	if ($_SESSION["user"] == "admin@admin.com") {
						  		echo 
						  		"<li class='nav-item'>
						   			 <a class='nav-link' href='user_manage.php'>Manage users</a>
						 		 </li>";
						  	}else{echo "";}
						  ?>
						
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