<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="pl">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" type="text/css" href="style.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <!-- Include Editor style. -->
      <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_editor.min.css' rel='stylesheet' type='text/css' />
      <link href='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/css/froala_style.min.css' rel='stylesheet' type='text/css' />
       
      <!-- Include JS file. -->
      <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.8.1/js/froala_editor.min.js'></script>

      
      <title>Dodawanie newsow</title>
   </head>
   <body>
      <div class="container">
        <?php
          require('panel.php');
        ?>
        <div class="header">
        <h1><a href="index.php"><img src="logo.png"></a></h1>
        <h1>Dodawanie newsow</h1>
         </div>
         <div class="content">
            <?php 
               include('connect.php');
               $today = date('Y-m-d');
               $category = mysqli_query($connect,"SELECT distinct * FROM categories"); // Kwerenda kategorii
               	// Generowanie formularza
               	echo "<div class='formularz'>";
               	echo
               	'<form method="post">
               	<label for="title">Title:</label>
               	<input class="form-control" type="text" name="title" id="title">
               	<label for="date">Date:</label>
               	<input class="form-control" type="date" name="date" id="date" value="'. $today .'">
               	<label for="list">Category:</label>
               	<select class="form-control" id="list" name="list">
               	';
               	for ($i=0; $i < mysqli_num_rows($category); $i++) {  // Wyświetlanie opcji wyboru
               		while ($wynik = @mysqli_fetch_array($category))
               			{echo '<option value="' . $wynik['id_category'] . '">' . $wynik['category'] . '</option>';}
               	}
               		 
               	echo '</select><br>
               	<label id="content">Content:</label><br>
               	<textarea class="form-control" rows="4" cols="50" name="content"></textarea><br>
                 <script>
  $(function() {
    $("textarea#froala-editor").froalaEditor()
  });
</script>
               	<input class="btn btn-primary" type="submit" name="submit" value="Wyslij">
               </form>';
               echo "</div>";
               //
               if (isset($_POST['title']) && isset($_POST['date']) && isset($_POST['list']) && isset($_POST['content'])) {
                	$title = $_POST['title'];
                	$date = $_POST['date'];
                	$list = $_POST['list'];
                	$content = $_POST['content'];
                  $author = $_SESSION["user"];
                	
                  $user_info = mysqli_query($connect,"SELECT * FROM user where mail='$author'"); // Informacje o autorze
                  $author_info = mysqli_fetch_array($user_info);

                	$result = mysqli_query($connect,"SELECT * FROM news where title='$title'");
                	$liczba_rekordow = mysqli_num_rows($result);
                  $author = $author_info['id_user'];
                	if ($liczba_rekordow == 0) {
                 		if (!empty($title) && !empty($date) && !empty($content)) {
                 		$add = "INSERT INTO news ()	VALUES ('','$title','$date','$list','$content','$author');";
                 		$connect->query($add);
                 		echo "News added";
                 	}
                	}
               }
               else
               {
               	echo "";
               }
               
               ?>
         </div>
      </div>
    
   </body>
</html>