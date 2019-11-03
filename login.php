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
<?php
if(isset($_POST['submit']))
{
	$amount=$_POST['amount'];
	$row=$_POST['submit'];
	$exp=explode(",", $row);
	$user=$exp[1];
	$pd=new PDO('mysql:host=localhost;dbname=income','root','');
	$p=$pd->prepare('update payment set paid=paid+?,balance=balance-? where user=?');
	$p->bindparam(1,$amount);
	$p->bindparam(2,$amount);
	$p->bindparam(3,$user);
	$p->execute();
	$q='select * from payment where user='.$user;
	$p=$pd->query($q);
	$row=$p->fetch();
	if($row[3]<0)
	{
		$t=0;
		$ret=$row[3]*(-1);
	}
	else
	{
		$t=1;
	}
	$p=$pd->prepare('update payment set paid=paid-?,balance=balance+? where user=?');
	$p->bindparam(1,$ret);
	$p->bindparam(2,$ret);
	$p->bindparam(3,$user);
	$p->execute();
	if($t==0)
	{
		echo '<h1 class="w3-green w3-container w3-margin w3-padding">Amount Returned : '.$ret.'</h1>';
	}
	else
	{
		echo '<h1 class="w3-green w3-container w3-margin w3-padding">Amount Returned : 0</h1>';
	}
	
}
if(isset($_POST['sub']))
	{
		$name=$_POST['user'];
		$pass=$_POST['pass'];
		$accept=0;
		$access=0;
		$pd=new PDO('mysql:host=localhost;dbname=income','root','');
		$q='select * from taxpayer';
		$p=$pd->query($q);
		while($row=$p->fetch())
		{
			if($row[0]==$name)
			{
				if($row[1]==$pass)
				{	$access=1;
					if($row[4]<=250000)
					{
						$tax=0;
					}
					else if($row[4]<=500000 and $row[4]>250000)
					{
						$tax=($row[4]-250000)*0.05;
					}
					else if($row[4]<=1000000 and $row[4]>500000)
					{
						$tax=($row[4]-500000)*0.2;
					}
					else
					{
						$tax=($row[4]-1000000)*0.3;	
					}
					$q1='select * from payment';
					$p1=$pd->query($q1);
					while ($rowx=$p1->fetch()){
						if($rowx[0]==$name)
						{
							$paid=$rowx[2];
							$balance=$rowx[3];
						}
					}
					$ret=0;
					$sub=$pass.','.$row[0];
					echo '
					<h1 class="w3-container w3-green w3-center w3-padding w3-jumbo w3-card-4">Income tax Office</h1>
					<div style="height:400px" class="w3-jumbo w3-container w3-yellow w3-padding w3-margin">
					<div id="pay1">
						<h1 class="w3-xxxlarge">
							Logged in as  '.$row[2].' '.$row[3].'<br><br>
							Annual salary : '.$row[4].'<br>
							Account number : '.$row[8].'<br><br>
							Tax to pay : '.$tax.'
						</h1>
					</div>
					<div id="pay2">
						<h1 class="w3-xxlarge">
							Tax to pay : '.$tax.'<br>Amount paid : '.$paid.'<br>Balance amount to pay : '.$balance.'<br><br>
						</h1>
						<form action="login.php" method="POST">
						<input class="w3-input w3-large w3-light-green" type="number" name="amount" placeholder="Enter the amount you want to pay">
						<button class="w3-button w3-green w3-large" value="'.$sub.'" name="submit" type="submit">Pay</button>
						</form>
					</div>
					</div>
					<div class="w3-center w3-margin w3-padding">
						<button id="btn" class="w3-green w3-btn w3-xxlarge">Proceed to payment</button>
					</div>';
				}
			}
		}
		if($access==0)
		{
				echo '
				<h1 class="w3-jumbo w3-container w3-red">invalid username or password <a class="w3-button w3-jumbo w3-pink w3-hover-black" href="index.php">Try again</a></h1>';
		}
	}
else if(isset($_POST['submit']))
{
	$amount=$_POST['amount'];
	$row=$_POST['submit'];
	$exp=explode(",", $row);
	$name=$exp[1];
	$pass=$exp[0];
	$accept=0;
	$access=0;
		$pd=new PDO('mysql:host=localhost;dbname=income','root','');
		$q='select * from taxpayer';
		$p=$pd->query($q);
		while($row=$p->fetch())
		{
			if($row[0]==$name)
			{
				if($row[1]==$pass)
				{
					$access=1;
					if($row[4]<=250000)
					{
						$tax=0;
					}
					else if($row[4]<=500000 and $row[4]>250000)
					{
						$tax=($row[4]-250000)*0.05;
					}
					else if($row[4]<=1000000 and $row[4]>500000)
					{
						$tax=($row[4]-500000)*0.2;
					}
					else
					{
						$tax=($row[4]-1000000)*0.3;	
					}
					$q1='select * from payment';
					$p1=$pd->query($q1);
					while ($rowx=$p1->fetch()){
						if($rowx[0]==$name)
						{
							$paid=$rowx[2];
							$balance=$rowx[3];
						}
					}
					$sub=$pass.','.$row[0];
					echo '
					<h1 class="w3-container w3-green w3-center w3-padding w3-jumbo w3-card-4">Income tax Office</h1>
					<div style="height:400px" class="w3-jumbo w3-container w3-yellow w3-padding w3-margin">
					<div id="pay1">
						<h1 class="w3-xxxlarge">
							Logged in as  '.$row[2].' '.$row[3].'<br><br>
							Annual salary : '.$row[4].'<br>
							Account number : '.$row[8].'<br><br>
							Tax to pay : '.$tax.'
						</h1>
					</div>
					<div id="pay2">
						<h1 class="w3-xxlarge">
							Tax to pay : '.$tax.'<br>Amount paid : '.$paid.'<br>Balance amount to pay : '.$balance.'<br><br>
						</h1>
						<form action="login.php" method="POST">
						<input class="w3-input w3-large w3-light-green" type="number" name="amount" placeholder="Enter the amount you want to pay">
						<button class="w3-button w3-green w3-large" value="'.$sub.'" name="submit" type="submit">Pay</button>
						</form>
					</div>
					</div>
					<div class="w3-center w3-margin w3-padding">
						<button id="btn" class="w3-green w3-btn w3-xxlarge">Proceed to payment</button>
					</div>';
				}
			}
		}
			if($access==0)
				{
					echo '
					<h1 class="w3-jumbo w3-container w3-red">invalid username or password <a class="w3-button w3-jumbo w3-pink w3-hover-black" href="index.php">Try again</a></h1>';
				}
}
else
{
	//----
}
?>
<button class="w3-red w3-button w3-margin w3-padding" onclick="redirect()">Go back</button>
</body>
</html>
<script type="text/javascript">
	function alrt()
	{
		alert('invalid username or password');
	}
	$(document).ready(function(){
	  $("#btn").click(function(){
	  	$("#pay1").fadeToggle(0);
	    $("#pay2").fadeToggle(0);
	  });
	});
	function redirect()
	{
		window.location="index.php";
	}
</script>