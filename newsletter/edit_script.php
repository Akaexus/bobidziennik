				
				<?php
					include('connect.php');

					
					$result = mysqli_query($connect,"SELECT * from news inner join categories using(id_category) order by id asc");
					               $category = mysqli_query($connect,"SELECT distinct * FROM categories"); // Kwerenda kategorii

					if (isset($_GET['action'], $_GET['id'])) {
						echo "dupa";
					
					$action = $_GET['action'];
					$id= $_GET['id'];

					if ($action=="delete" && $id>0) {
											$delete = "DELETE from news where id={$id} LIMIT 1";
						$connect->query($delete);
						if($delete)
						echo "<script>location.href='edit.php';</script>";
							
						}
						elseif ($action == "edit") {
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
	}elseif ($action == "save") {
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
									      <td>'. '<a href="?action=edit&id='. $wynik['id'] .'"><button type="button" class="btn btn-light">Edit</button></a></td>
									      <td>'. '<a href="?action=delete&id='. $wynik['id'] .'"><button type="button" class="btn btn-danger">Delete</button></a></td>
									    </tr>';
	               			}
	               		}
	               		echo "</table>";
	               		
					}
				?>
	