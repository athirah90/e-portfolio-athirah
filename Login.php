<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php
if(isset($_POST["Submit"])){
$Username=mysql_real_escape_string($_POST["Username"]);
$Password=mysql_real_escape_string($_POST["Password"]);

if(empty($Username)||empty($Password)){
	$_SESSION["ErrorMessage"]="All Fields must be filled out";
	Redirect_to("Login.php");
	
}
else{
	$Found_Account=Login_Attempt($Username,$Password);
	$_SESSION["User_Id"]=$Found_Account["id"];
	$_SESSION["Username"]=$Found_Account["username"];
	if($Found_Account){
	$_SESSION["SuccessMessage"]="Welcome  {$_SESSION["Username"]} ";
	Redirect_to("Dashboard.php");
		
	}else{
		$_SESSION["ErrorMessage"]="Invalid Username / Password";
	Redirect_to("Login.php");
	}
	
}	
}	


?>

<!DOCTYPE>

<html>
	<head>
		<title>Log-in</title>
                <link rel="stylesheet" href="css/bootstrap.min.css">
                <script src="js/jquery-3.2.1.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
                <link rel="stylesheet" type="text/css" href="css/menu.css">
		<link rel="stylesheet" href="css/adminstyles.css">
<style>
	.FieldInfo{
    color: rgb(251, 174, 44);
    font-family: Bitter,Georgia,"Times New Roman",Times,serif;
    font-size: 1.2em;
}
body{
	background-color: #ffffff;
}

</style>
                
	</head>
	<body>
	<head>
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js" ></script>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="css/publicstyles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortout icon" type="image/x-icon" href="https://svgsilh.com/png-512/1390339.png" />	

</head>
<body>
<header>
			<a class="logo" a href="Blog.php"><img src ="tyrahlogo.jpg" style="width: 190px; height: 77px"></a>
			<nav > 
					<ul>
						<li class="active"><a href="Blog.php">Home</a></li>
						<li><a href="Blog.php?catagory=About Me" aria-haspopup="true">About Me</a>
						</li>
						
						<li><a href="Blog.php?catagory=Education" aria-haspopup="true">Education</a>
							<ul>
								<li><a href="#">Primary School</a>
								<ul>
										<li><a href="Blog.php?catagory=Education">SKDB</a></li>
										<li><a href="Blog.php?catagory=Education">SKKB</a></li>
									
								</ul>
								</li>
								<li><a href="#">Secondary School</a>
									<ul>
										<li><a href="Blog.php?catagory=Education">SMK Keroh</a></li>
										
									</ul>
								</li>
							</ul>
						</li>

						<li><a href="Blog.php?catagory=Qualification" aria-haspopup="true">Qualification</a>
						</li>

						<li><a href="Blog.php?catagory=Activity" aria-haspopup="true">Activity</a>
						</li>


						<li><a href="Blog.php?catagory=interest" aria-haspopup="true">Interest</a>
						</li>

						<li><a href="Login.php" aria-haspopup="true">Login</a>
						</li>

						<form action="Blog.php" class="navbar-form navbar-right">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Search" name="Search" >
						</div>
		         		<button class="btn btn-default" name="SearchButton">Go</button>
				
					</form>
					</ul>
			</nav>
		</header>
<div class="container-fluid">
<div class="row">
	
	<div class="col-sm-offset-4 col-sm-4">
		
		<?php echo Message();
	      echo SuccessMessage();
	?>
	<h2>Welcome back !</h2>
	
<div>
<form action="login_act.php" method="post">
	<fieldset>
	<div class="form-group">
	<label for="Username"><span class="FieldInfo">UserName:</span></label>
	<div class="input-group input-group-lg">
	<span class="input-group-addon">
	<span class="glyphicon glyphicon-envelope text-primary"></span>
	</span>
	<input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
	</div>	
	</div>
	
	<div class="form-group">
	<label for="Password"><span class="FieldInfo">Password:</span></label>
	<div class="input-group input-group-lg">
	<span class="input-group-addon">
	<span class="glyphicon glyphicon-lock text-primary"></span>
	</span>
	<input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
	</div>
	</div>
	
	<br>
<input class="btn btn-info btn-block" type="Submit" name="Submit" value="Login">
	</fieldset>
	<br>
</form>

	</div> <!-- Ending of Main Area-->
	
</div> <!-- Ending of Row-->
	
</div> <!-- Ending of Container-->

	    
	</body>
</html>