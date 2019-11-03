<!DOCTYPE html>
<html>
<head>
	<title>Income tax</title>
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
		</style>
</head>
<body>
	<?php
	echo '
	<h1 class="w3-container w3-green w3-center w3-padding w3-jumbo w3-card-4">Income tax Office</h1>
<div class="w3-padding w3-margin">
	<h2 class="w3-xxlarge">Login</h2><br><br>
	<form method="POST" action="login.php">
		<label>Username</label><input class="w3-input" type="text" name="user" required><br>
		<label>Password</label><input class="w3-input" type="Password" name="pass" required><br><br>
		<button class="w3-button w3-black w3-hover-green" name="sub" type="submit">Login</button><br><br>
	</form>
	<a href="createaccount.php">if you are a new user please register here</a><br>
	<a href="forgot.php">Forgot password</a>
</div>
	';
	?>
</body>
</html>
<script type="text/javascript">
	function redirect1()
	{
		window.location = "loggedin.php";
	}
</script>