<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php 
if(isset($_POST["Submit"]))
{
$Title = mysql_real_escape_string($_POST["Title"]);
$Catagory = mysql_real_escape_string($_POST["Catagory"]); 
$Post = mysql_real_escape_string($_POST["Post"]);
date_default_timezone_set("Asia/dhaka");
$CurrentTime=time();
$DateTime=strftime("%B-%d-%Y %H:%M:%S %A",$CurrentTime);
$DateTime;
$Admin = $_SESSION["Username"];
$Image = $_FILES["Image"]["name"];
$Target = "Upload/".basename($_FILES["Image"]["name"]);
if(empty($Title))
{
$_SESSION["ErrorMessage"] = "Title can't be empty";
Redirect_to("AddNewPost.php");
}

elseif(strlen($Title)<2)
{
	$_SESSION["ErrorMessage"] = "Title should be at least two charachter";
	Redirect_to("AddNewPost.php");
}
else
{
global $ConnectingDB;
$Query = "INSERT INTO admin_panel(datetime,title,catagory,author,image,post)
VALUES('$DateTime','$Title','$Catagory','$Admin','$Image','$Post')";
$Execute = mysql_query($Query);
move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
if($Execute)
{
$_SESSION["SuccessMessage"] = "Post Added Successfully";
Redirect_to("AddNewPost.php");
}
else{
	$_SESSION["ErrorMessage"] = "Something went wrong. Try again";
	Redirect_to("AddNewPost.php");
	
} 
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add New Post</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js" ></script>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortout icon" type="image/x-icon" href="https://svgsilh.com/png-512/1390339.png" />	
	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">
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

						<li><a href="Logout.php" aria-haspopup="true">Log Out</a>
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
			<div class="col-sm-2">
	<ul id="Side_Menu" class="nav nav-pills nav-stacked">
	<li >
	<a href="Dashboard.php">
	<span class="glyphicon glyphicon-th"></span>
	&nbsp;Dashboard</a></li>
	<li class="active"><a href="AddNewPost.php">
	<span class="glyphicon glyphicon-list-alt"></span>
	&nbsp;Add New Post</a></li>
	<li><a href="Catagories.php">
	<span class="glyphicon glyphicon-tags"></span>
	&nbsp;Categories</a></li>
	<li><a href="Admins.php">
	<span class="glyphicon glyphicon-user"></span>
	&nbsp;Manage Admins</a></li>
	<li><a href="Comments.php">
	<span class="glyphicon glyphicon-comment"></span>
	&nbsp;Comments
<?php
$ConnectingDB;
$QueryTotal="SELECT COUNT(*) FROM comments WHERE status='OFF'";
$ExecuteTotal=mysql_query($QueryTotal);
$RowsTotal=mysql_fetch_array($ExecuteTotal);
$Total=array_shift($RowsTotal);
if($Total>0){
?>
<span class="label pull-right label-warning">
<?php echo $Total;?>
</span>
		
<?php } ?>
	</a>	
	</li>
	<li><a href="Blog.php?Page=1" target="_Blank">
	<span class="glyphicon glyphicon-equalizer"></span>
	&nbsp;Live Blog</a></li>
	<li><a href="Logout.php">
	<span class="glyphicon glyphicon-log-out"></span>
	&nbsp;Logout</a></li>	
		
	</ul>
	
	
	
	
	</div> <!-- Ending of Side area -->

			<div class="col-sm-10">
				<h1>Add New Post</h1>
				<div><?php echo Message();
			echo SuccessMessage();
			?></div>
				<div>
					<form action="AddNewPost.php" method="POST" enctype="multipart/form-data">
						<fieldset>
							<div class="form-group">
							<label for="title"><span class="FieldInfo" >Title:</span></label>
							<input class="form-control" type="text" name="Title" id="catagoryname" placeholder="Title">
							</div>
							
							<div class="form-group">
							<label for="catagoryselect"><span class="FieldInfo" >Categories:</span></label>
							<select class="form-control" id="catagoryselect" name="Catagory">
							<?php 
							global $ConnectingDB;
							$ViewQuery = "Select * FROM catagory ORDER BY datetime desc";
							$Execute = mysql_query($ViewQuery);
							
							while($DataRows = mysql_fetch_array($Execute))
							{
								$Id = $DataRows["id"];
								
								$CatagoryName = $DataRows["name"];
								?>
								<option><?php echo $CatagoryName; ?></option>

								<?php } ?>


						?
							</select>
							</div>

							<div class="form-group">
							<label for="imageselect"><span class="FieldInfo" >Select Image:</span></label>

							<input type="File" class="form-control" name="Image" id="imageselect">
							</div>

							<div class="form-group">
							<label for="postarea"><span class="FieldInfo" >Post:</span></label>
							<textarea class="form-control" name="Post" id="postarea">
								
							</textarea>
							</div>
							<br>
							<input class="btn btn-success btn-block" type="submit" name="Submit" value="Add New Post">
							<br>
						</fieldset>
						
					</form>
				</div>

						
				
			</div><!-- ending of main area-->
		</div><!-- ending of row -->
	</div> <!-- ending of container fluid-->

	<div id="Footer">
		<hr>
		<p>Athirah Khairi | &copy;2022 --- Science Computer.
		</p>
		<hr>
	</div>
	
	<div style="height: 10px; background: #27AAE1;"></div> 

</body>
</html>