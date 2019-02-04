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
				echo '<a href="?cat=a" ><button type="button" class="btn btn-secondary">Wszystkie</button></a>';
		if(mysqli_num_rows($result2) >0){ 
			while ($wynik2 = mysqli_fetch_array($result2)) {
				echo '<a href="?cat=' . $wynik2['id_category'] . ' " ><button type="button" class="btn btn-secondary">' . $wynik2['category'] . '</button></a>';
				// echo "</ul>";
			}
		}
		echo "</div>";
		$category = @$_GET['cat'];
		// echo "</div>";
		echo "<div class='content'>";
		echo "<div class='col-8'";
		$result2 = mysqli_query($connect,"SELECT * from categories");
		$liczba = mysqli_num_rows($result2);



		switch ($category){
			 
				case 1:
					$result3 = mysqli_query($connect,"SELECT * from news inner join categories using(id_category) where id_category='{$category}'");
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
	               				
	               			}
	               	}
					break;
				case 2:
					$result3 = mysqli_query($connect,"SELECT * from news inner join categories using(id_category) where id_category='{$category}'");
					if(mysqli_num_rows($result3) >0){ 
						echo "<div class='article'>";
	               		while ($wynik = mysqli_fetch_array($result3))
	               			{
	               				$id= $wynik['id'];
	               				$comment = mysqli_query($connect,"SELECT * from news inner join comment on news.id=comment.news where news.id=$id");
	               				echo "<div class='article'>";
		               				echo "<h2>" . $wynik['title'] . " :: " . $wynik['date'] . " :: ". $wynik['category'] . "</h2>";
		               				echo "<div class='text'";
		               					echo "<p class='lead'>" . $wynik['content'] . "</p>";
		               				echo "</div>";
		               				echo "<a href='comment.php?id=". $wynik['id'] ."'><button type='button' class='btn btn-primary'>
  											Comments <span class='badge badge-light'>". mysqli_num_rows($comment) ."</span>
										</button></a>";
	               				echo "</div>";
	               			}
	               	}
					break;
						case 3:
					$result3 = mysqli_query($connect,"SELECT * from news inner join categories using(id_category) where id_category='{$category}'");
					if (mysqli_num_rows($result3) >0) {
						echo "<div class='article'>";
	               		while ($wynik = mysqli_fetch_array($result3))
	               			{
	               				$id= $wynik['id'];
	               				$comment = mysqli_query($connect,"SELECT * from news inner join comment on news.id=comment.news where news.id=$id");
	               				echo "<div class='article'>";
		               				echo "<h2>" . $wynik['title'] . " :: " . $wynik['date'] . " :: ". $wynik['category'] . "</h2>";
		               				echo "<div class='text'";
		               					echo "<p class='lead'>" . $wynik['content'] . "</p>";
		               				echo "</div>";
		               				echo "<a href='comment.php?id=". $wynik['id'] ."'><button type='button' class='btn btn-primary'>
  											Comments <span class='badge badge-light'>". mysqli_num_rows($comment) ."</span>
										</button></a>";
	               				echo "</div>";
	               			}
	               	}
					break;

						case 4:
					$result3 = mysqli_query($connect,"SELECT * from news inner join categories using(id_category) where id_category='{$category}'");
					if(mysqli_num_rows($result3) >0){
						echo "<div class='article'>";
	               		while ($wynik = mysqli_fetch_array($result3))
	               			{
	               				$id= $wynik['id'];
	               				$comment = mysqli_query($connect,"SELECT * from news inner join comment on news.id=comment.news where news.id=$id");
	               				echo "<div class='article'>";
		               				echo "<h2>" . $wynik['title'] . " :: " . $wynik['date'] . " :: ". $wynik['category'] . "</h2>";
		               				echo "<div class='text'";
		               					echo "<p class='lead'>" . $wynik['content'] . "</p>";
		               				echo "</div>";
		               				echo "<a href='comment.php?id=". $wynik['id'] ."'><button type='button' class='btn btn-primary'>
  											Comments <span class='badge badge-light'>". mysqli_num_rows($comment) ."</span>
										</button></a>";
	               				echo "</div>";
	               			}
					}
	               	
					break;

						case 5:
					$result3 = mysqli_query($connect,"SELECT * from news inner join categories using(id_category) where id_category='{$category}'");
					if(mysqli_num_rows($result3) >0) {  
						echo "<div class='article'>";
	               		while ($wynik = mysqli_fetch_array($result3))
	               			{
	               				$id= $wynik['id'];
	               				$comment = mysqli_query($connect,"SELECT * from news inner join comment on news.id=comment.news where news.id=$id");
	               				echo "<div class='article'>";
		               				echo "<h2>" . $wynik['title'] . " :: " . $wynik['date'] . " :: ". $wynik['category'] . "</h2>";
		               				echo "<div class='text'";
		               					echo "<p class='lead'>" . $wynik['content'] . "</p>";
		               				echo "</div>";
		               				echo "<a href='comment.php?id=". $wynik['id'] ."'><button type='button' class='btn btn-primary'>
  											Comments <span class='badge badge-light'>". mysqli_num_rows($comment) ."</span>
										</button></a>";
	               				echo "</div>";
	               			}
	               	}
					break;

						case 'a':
					$result3 = mysqli_query($connect,"SELECT * from news inner join categories using(id_category)");
					if(mysqli_num_rows($result3) >0) {  
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
		               				// echo "<a href='comment.php?id=". $wynik['id'] ."'>comments: " . mysqli_num_rows($comment) ."</a>";
	               				echo "</div>";
	               			}
	               	}
					break;
				default:
				$result3 = mysqli_query($connect,"SELECT * from news inner join categories using(id_category)");
				
					if(mysqli_num_rows($result3) >0) {  
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
	               			}
	               	}

					break;
				
			}
			echo "</div>";
			echo "</div>";
	?>
	</div>
</body>
</html>