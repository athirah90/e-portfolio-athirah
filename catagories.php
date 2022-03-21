<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php 
if(isset($_POST["Submit"]))
{
$Catagory = mysql_real_escape_string($_POST["Catagory"]);
date_default_timezone_set("Asia/dhaka");
$CurrentTime=time();
$DateTime=strftime("%B-%d-%Y %H:%M:%S %A",$CurrentTime);
$DateTime;
$Admin = $_SESSION["Username"];
if(empty($Catagory))
{
$_SESSION["ErrorMessage"] = "All Fields must be filled out";
Redirect_to("Catagories.php");
}

elseif(strlen($Catagory)>99)
{
	$_SESSION["ErrorMessage"] = "Too long name for Catagory";
	Redirect_to("Catagories.php");
}
else
{
global $ConnectingDB;
$Query = "INSERT INTO catagory(datetime,name,creatorname)
VALUES('$DateTime','$Catagory','$Admin')";
$Execute = mysql_query($Query);
if($Execute)
{
$_SESSION["SuccessMessage"] = "Catagory Added Successfully";
Redirect_to("Catagories.php");
}
else{
	$_SESSION["ErrorMessage"] = "Catagory fails to Add";
	Redirect_to("Catagories.php");
	
}
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Manage Catagories</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js" ></script>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<link rel="stylesheet" type="text/css" href="css/adminstyles.css">
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
	<li><a href="AddNewPost.php">
	<span class="glyphicon glyphicon-list-alt"></span>
	&nbsp;Add New Post</a></li>
	<li class="active"><a href="Catagories.php">
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
				<h1>Manage Categories</h1>
				<div><?php echo Message();
			echo SuccessMessage();
			?></div>
				<div>
					<form action="Catagories.php" method="POST">
						<fieldset>
							<div class="form-group">
							<label for="catagoryname"><span class="FieldInfo" >Name:</span></label>
							<input class="form-control" type="text" name="Catagory" id="catagoryname" placeholder="Name">
							</div>
							<br>
							<input class="btn btn-success btn-block" type="submit" name="Submit" value="Add New Catagory">
							<br>
						</fieldset>
						
					</form>
				</div>

				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tr>
							<th>Sr No.</th>
							<th>Date  Time</th>
							<th>Catagory Name</th>
							<th>Creator Name</th>
							<th>Action</th>
						</tr>
						<?php 
							global $ConnectingDB;
							$ViewQuery = "Select * FROM catagory ORDER BY datetime desc";
							$Execute = mysql_query($ViewQuery);
							$SrNo = 0;
							while($DataRows = mysql_fetch_array($Execute))
							{
								$Id = $DataRows["id"];
								$DateTime = $DataRows["datetime"];
								$CatagoryName = $DataRows["name"];
								$CreatorName = $DataRows["creatorname"];
								$SrNo++;
							
						?>

						<tr>
							<td><?php echo $SrNo."." ?></td>
							<td><?php echo $DateTime ?></td>
							<td><?php echo $CatagoryName ?></td>
							<td><?php echo $CreatorName ?></td>
							<td><a href="DeleteCategory.php?id=<?php echo $Id;?>"><span class="btn btn-danger">Delete</span></a></td>
						</tr>

						<?php } ?>
					</table>
				</div>
				
			</div><!-- ending of main area-->
		</div><!-- ending of row -->
	</div> <!-- ending of container fluid-->

	<div id="Footer">
		<hr>
		<p>Theme By | Kalim Amzad | &copy;2017-2020 --- All right reserved.
		</p>
		<hr>
	</div>
	
	<div style="height: 10px; background: #27AAE1;"></div> 

</body>
</html>