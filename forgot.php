<!DOCTYPE html>
<html>
<head>
	<title>Income tax</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
		<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-metro.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style type="text/css">
		.w3-lobster {
		  font-family: "Comic Sans MS", cursive, sans-serif;
		}
		#home{
		border-style: solid;
		border-width: 0px 0px 10px 0px;

		color:#cccccc
		}
		body{
			background-image: url("background.jpg");
		}
		#pay2{
			display: none;
		}
		</style>
</head>
<body>
	<h1>Change password</h1>
	<form action="forgot.php" method="POST">
		<input placeholder="Enter username" type="text" class="w3-input" name="user">
		<input placeholder="Enter password" type="password" class="w3-input" name="pass">
		<button name='sub' type="sub" class="w3-button w3-green">rename</button>
	</form>
	<?php
	if(isset($_POST['sub']))
	{
		$user=$_POST['user'];
		$pd=new PDO('mysql:host=localhost;dbname=income','root','');
		$p=$pd->prepare('update taxpayer set password=? where username='.$user);
		$p->bindparam(1,$pass);
		$p->execute();
		$p=$pd->prepare('update registration set password=? where username='.$user);
		$p->bindparam(1,$pass);
		$p->execute();
		echo '<h2>Password changed successfully</h2>';
	}
	?>
</body>
</html>