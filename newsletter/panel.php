	<?php
	if (isset($_SESSION["user"])) {
		echo "<div class='panel'>";
		if ($_SESSION["user"] == "admin@admin.com") {
			echo "<a href='admin.php'>". $_SESSION["user"] . "</a> | <a href='?action=logout'>Log out</a>";
		}
		else{
		echo "<a href='user.php'>". $_SESSION["user"] . "</a> | <a href='?action=logout'>Log out</a>";
	}
		"</div>";
		if (isset($_GET['action'])) {
			if ($_GET['action'] == "logout") {
			session_unset();
			session_destroy();
			echo "<script>location.href='index.php';</script>";
		}
		}
	}else{
		echo "<div class='panel'>
			<a href='login.php'>Login</a> | <a href='rejestracja.php'>Sign in</a>
		</div>";
	}
	?>