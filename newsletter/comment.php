<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<title>Wyświetlanie newsow</title>
</head>
<body>
	<div class="container">
	<?php
	require('panel.php');
	?>
	<div class="row">
	<div class="header">
	<h1><a href="index.php"><img src="logo.png"></a></h1>
	</div>
	</div>
	<?php
		include('connect.php');
		// echo "<div class='row align-items-end'";
		
		$result = mysqli_query($connect,"SELECT * from news inner join categories using(id_category)");
		$result2 = mysqli_query($connect,"SELECT * from categories");

		
				// echo "<ul class='list-group' class='list-unstyled'>";
				echo '<div id="menu" class="btn-group" role="group">';
				echo '<a href="index.php?cat=a" ><button type="button" class="btn btn-secondary">Wszystkie</button></a>';
		if(mysqli_num_rows($result2) >0){ 
			while ($wynik2 = mysqli_fetch_array($result2)) {
				echo '<a href="index.php?cat=' . $wynik2['id_category'] . ' " ><button type="button" class="btn btn-secondary">' . $wynik2['category'] . '</button></a>';
				// echo "</ul>";
			}
		}
		echo "</div>";
		$category = @$_GET['cat'];
		// echo "</div>";
		echo "<div class='content'>";
		echo "<div class='col-8'>";
		$result2 = mysqli_query($connect,"SELECT * from categories");
		$liczba = mysqli_num_rows($result2);
		if (isset($_GET['action'],$_GET['id_comment'])) {
					$action = $_GET['action'];
					$id= $_GET['id_comment'];
					// Usuwanie
					if ($action=="delete" && $id>0) {
											$delete = "DELETE from comment where id={$id} LIMIT 1";
						$comment = mysqli_query($connect,"SELECT * from comment");
						$wynik = mysqli_fetch_array($comment);
						$connect->query($delete);
						
						if($delete)
						echo "<script>location.href='comment.php?id=". $wynik['news'] ."'</script>";
						}
					}
		
		elseif (isset($_GET['id'])) {
			$id_post = $_GET['id'];
			$result3 = mysqli_query($connect,"SELECT * from news inner join categories using(id_category) where id='{$id_post}'");
					if(mysqli_num_rows($result3) >0){ 
						echo "<div class='article'>";
	               		while ($wynik = mysqli_fetch_array($result3))
	               			{
	               				$id= $wynik['id'];
	               				$comment = mysqli_query($connect,"SELECT * from news inner join comment on news.id=comment.news where news.id=$id");
	               				echo "<div class='article'>";
		               				echo "<h2>" . $wynik['title'] . " :: " . $wynik['date'] . " :: ". $wynik['category'] . "</h2>";
		               				echo "<div class='text'";
		               					echo "<p>" . $wynik['content'] . "</p>";
		               				echo "</div>";
		               				echo "<a href='comment.php?id=". $wynik['id'] ."'><button type='button' class='btn btn-primary'>
  											Comments <span class='badge badge-light'>". mysqli_num_rows($comment) ."</span>
										</button></a>";
	               				echo "</div>";
	               				if (isset($_SESSION["user"])) {
	               					$user = $_SESSION["user"];
	               					$user_info = mysqli_fetch_array(mysqli_query($connect,"SELECT * from user where mail='$user'"));
	               					$date = date('Y-m-d');
	               					$news = $wynik['id'];
	               					$user = $user_info['id_user'];
	               					echo $date . $news . $user;
	               					echo "<form method='post'>
	               						<textarea name='comment' rows=2 cols=100></textarea>
	               						<input type='submit' value='comment'>
	               					</form>";
	               					if (isset($_POST['comment'])) {
	               						$comment = $_POST['comment'];

	               						$result = mysqli_query($connect,"SELECT * FROM comment where id='$id'");
                						$liczba_rekordow = mysqli_num_rows($result);
                						echo $liczba_rekordow;
                						$add = mysqli_query($connect,"INSERT INTO comment () VALUES('','$date','$news','$comment','$user')");
                						if ($add) {
                							echo "super!";
                							echo "<script>location.href='comment.php?id=". $_GET['id'] ."';</script>";
                						}
	               					}
	               				}else
	               				{
	               					echo "";
	               				}
	               				
	               			}
	               	}

	        $result3 = mysqli_query($connect,"SELECT * from comment inner join user on comment.user=user.id_user where news='{$id_post}'");

					if(mysqli_num_rows($result3) >0){ 
						echo "<div class='article2'>";
	               		while ($wynik = mysqli_fetch_array($result3))
	               			{
	               				if (isset($_SESSION["user"])) {

	               					if ($_SESSION["user"] == "admin@admin.com") {
	               					$id= $wynik['id'];
	               					$comment = mysqli_query($connect,"SELECT * from comment inner join user on comment.user=user.id_user");
	               				echo "<div class='article'>";
		               				echo "<h2>" . $wynik['mail'] . " :: " . $wynik['date'] .  " <a href='?action=delete&id_comment=". $wynik['id'] ."'>Usuń komentarz</a></h2> ";
		               				echo "<div class='text'";
		               					echo "<p>" . $wynik['comment'] . "</p>";
		               				echo "</div>";
	               				echo "</div>";
	               				}
	               				else{
	               					$id= $wynik['id'];
	               				$comment = mysqli_query($connect,"SELECT * from comment inner join user on comment.user=user.id_user");
	               				echo "<div class='article'>";
		               				echo "<h2>" . $wynik['mail'] . " :: " . $wynik['date'] .  "</h2>";
		               				echo "<div class='text'";
		               					echo "<p>" . $wynik['comment'] . "</p>";
		               				echo "</div>";
	               				echo "</div>";
	               				}
	               				}else
	               				{
	               					$id= $wynik['id'];
	               				$comment = mysqli_query($connect,"SELECT * from comment inner join user on comment.user=user.id_user");
	               				echo "<div class='article'>";
		               				echo "<h2>" . $wynik['mail'] . " :: " . $wynik['date'] .  "</h2>";
		               				echo "<div class='text'";
		               					echo "<p>" . $wynik['comment'] . "</p>";
		               				echo "</div>";
	               				echo "</div>";
	               				}
	               				
	               				
	               				
	               			}
	               	}
		}

		
			echo "</div>";
			echo "</div>";
	?>
	</div>
</body>
</html>