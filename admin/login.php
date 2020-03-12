<?php require_once '../lib/Session.php'; ?>
<?php require_once '../config/config.php'; ?>
<?php require_once '../lib/Database.php'; ?>
<?php require_once '../helpers/Format.php'; ?>
<?php
	$db = new Database();
	$fm = new Format();
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$username = mysqli_real_escape_string($db->link, $fm->sanitaization($_POST['username']));
		$password = mysqli_real_escape_string($db->link, md5($_POST['password']));

		$query = "SELECT * FROM tbl_users WHERE username = '$username' AND password = '$password'";
		$result = $db->select($query);

		if ($result) {
			$value = mysqli_fetch_array($result);
			$row = mysqli_num_rows($result);

			if ($row > 0) {
				Session::set('login', true);
				Session::set('username', $value['username']);
				Session::set('userId', $value['id']);
				header("Location: index.php");
			} else {
				echo "<span style='color: red; font-size: 18px;'>Username not found</span>";
			}
		} else {
			echo "<span style='color: red;font-size: 18px;'>Username and Password does not match.</span>";
		}
		
	}
?>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>