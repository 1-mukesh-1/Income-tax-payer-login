<!DOCTYPE html>
<html>
<head>
	<title>Registration page</title>
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
</body>
	<?php
	if(isset($_POST['register']))
	{
		$pd=new PDO('mysql:host=localhost;dbname=income','root','');
		$first=$_POST['fname'];
		$last=$_POST['lname'];
		$salary=$_POST['salary'];
		$address=$_POST['address'];
		$email=$_POST['email'];
		$phno=$_POST['phno'];
		$acno=$_POST['acno'];
		$pass=$_POST['pass1'];
		$initial=0;
		$q='select * from taxpayer';
		$p=$pd->query($q);
		$next=0;
		while($row=$p->fetch())
		{
			if($row[0]>$next)
			{
				$next=$row[0];
			}
		}
		$user=$next+1;
		$p=$pd->prepare('insert into taxpayer values(?,?,?,?,?,?,?,?,?)');
		$p->bindparam(1,$user);
		$p->bindparam(2,$pass);
		$p->bindparam(3,$first);
		$p->bindparam(4,$last);
		$p->bindparam(5,$salary);
		$p->bindparam(6,$address);
		$p->bindparam(7,$email);
		$p->bindparam(8,$phno);
		$p->bindparam(9,$acno);
		$p->execute();
		if($salary<=250000)
		{
			$tax=0;
		}
		else if($salary<=500000 and $salary>250000)
		{
			$tax=($salary-250000)*0.05;
		}
		else if($salary<=1000000 and $salary>500000)
		{
			$tax=($salary-500000)*0.2;
		}
		else
		{
			$tax=($salary-1000000)*0.3;	
		}
		$t=$pd->prepare('insert into payment values(?,?,?,?)');
		$t->bindparam(1,$user);
		$t->bindparam(2,$tax);
		$t->bindparam(3,$initial);
		$t->bindparam(4,$tax);
		$t->execute();
		$p=$pd->prepare('insert into registration values(?,?)');
		$p->bindparam(1,$user);
		$p->bindparam(2,$pass);
		$p->execute();
		$p=$pd->prepare('insert into admin values(?,?,?,?)');
		$p->bindparam(1,$user);
		$p->bindparam(2,$acno);
		$p->bindparam(3,$salary);
		$p->bindparam(4,$tax);
		$p->execute();
	}
	echo '
		<h1 class="w3-container w3-green w3-center w3-padding w3-jumbo w3-card-4">Registration</h1>';
	if(isset($_POST['register']))
	{
		echo '<div><h1 id="heading" class="w3-container w3-black w3-card-4 w3-margin w3-padding">Username : '.$user.'</h1></div><br>';
	}
	echo '
	<form onsubmit="return check()" name="myform" class="w3-container" method="POST" action="createaccount.php">
		<label>First Name</label><br><input type="text" name="fname" class="w3-input" required><br><br>
		<label>Last Name</label><br><input type="text" name="lname" class="w3-input" required><br><br>
		<label>Salary</label><br><input type="number" name="salary" class="w3-input" required><br><br>
		<label>address</label><br><input type="text" name="address" class="w3-input" required><br><br>
		<label>email</label><br><input type="text" name="email" class="w3-input" required><br><br>
		<label>Phone number</label><br><input type="text" name="phno" class="w3-input" required><br><br>
		<label>Account number</label><br><input type="text" name="acno" class="w3-input" required><br><br>
		<label>Password</label><br><input type="password" name="pass1" class="w3-input" required><br><br>
		<label>Confirm Password</label><br><input type="password" name="pass2" class="w3-input" required><br><br>
	<div>
		<a href="index.php" class="w3-padding w3-margin w3-btn w3-red w3-hover-black w3-right w3-large">Go back</a>
		<button onclick="check()" class="w3-btn w3-margin w3-black w3-hover-green w3-padding w3-large w3-left" name="register" value="clicked" type="submit">Register</button>
	</div>
	</form>
	';
	?>
</html>
<script type="text/javascript">
function check()
{
	var x=document.myform.pass1.value;
	var y=document.myform.pass2.value;
		if(x==y)
		{
			return true;
		}
		else
		{
			alert("Password must be same in both the fields");
			return false;
		}
}
function redirect1()
{
	window.location = "index.php"
}
function redirect2()
{
	window.location = "createaccount.php"
}
</script>