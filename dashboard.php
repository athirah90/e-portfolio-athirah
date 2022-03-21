<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php Confirm_Login(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
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
	<li class="active">
	<a href="Dashboard.php">
	<span class="glyphicon glyphicon-th"></span>
	&nbsp;Dashboard</a></li>
	<li><a href="AddNewPost.php">
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
	<div class="col-sm-10"> <!--Main Area-->
	<h1>Admin Dashboard</h1>
	
	<div><?php echo Message();
	      echo SuccessMessage();
	?></div>	
	
<div class="table-responsive">
	<table class="table table-striped table-hover">
		<tr>
			<th>No</th>
			<th>Post Title</th>
			<th>Date &Time</th>
			<th>Author</th>
			<th>catagory</th>
			<th>Banner</th>
			<th>Comments</th>
			<th>Action</th>
			<th>Details</th>
			
		</tr>
<?php
$ConnectingDB;
$ViewQuery="SELECT * FROM admin_panel ORDER BY id desc;";
$Execute=mysql_query($ViewQuery);
$SrNo=0;
while($DataRows=mysql_fetch_array($Execute)){
	$Id=$DataRows["id"];
	$DateTime=$DataRows["datetime"];
	$Title=$DataRows["title"];
	$catagory=$DataRows["catagory"];
	$Admin=$DataRows["author"];
	$Image=$DataRows["image"];
	$Post=$DataRows["post"];
	$SrNo++;
	?>
	<tr>
		
	<td><?php echo $SrNo; ?></td>
	<td style="color: #5e5eff;"><?php
	if(strlen($Title)>19){$Title=substr($Title,0,19).'..';}
	echo $Title;
	?></td>
	<td><?php
	if(strlen($DateTime)>12){$DateTime=substr($DateTime,0,12);}
	echo $DateTime;
	?></td>
	<td><?php
	if(strlen($Admin)>9){$Admin=substr($Admin,0,9);}
	echo $Admin; ?></td>
	<td><?php
	if(strlen($catagory)>10){$catagory=substr($catagory,0,10);}
	echo $catagory;
	?></td>
	<td><img src="Upload/<?php echo $Image; ?>" width="170px"; height="50px"></td>
	<td>
<?php
$ConnectingDB;
$QueryApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='ON'";
$ExecuteApproved=mysql_query($QueryApproved);
$RowsApproved=mysql_fetch_array($ExecuteApproved);
$TotalApproved=array_shift($RowsApproved);
if($TotalApproved>0){
?>
<span class="label pull-right label-success">
<?php echo $TotalApproved;?>
</span>
		
<?php } ?>

<?php
$ConnectingDB;
$QueryUnApproved="SELECT COUNT(*) FROM comments WHERE admin_panel_id='$Id' AND status='OFF'";
$ExecuteUnApproved=mysql_query($QueryUnApproved);
$RowsUnApproved=mysql_fetch_array($ExecuteUnApproved);
$TotalUnApproved=array_shift($RowsUnApproved);
if($TotalUnApproved>0){
?>
<span class="label  label-danger">
<?php echo $TotalUnApproved;?>
</span>
		
<?php } ?>
		
		
	</td>
	<td>
	<a href="EditPost.php?Edit=<?php echo $Id; ?>">
	<span class="btn btn-warning">Edit</span>
	</a>
	<a href="DeletePost.php?Delete=<?php echo $Id; ?>">
	<span class="btn btn-danger">Delete</span>
	</a>
	</td>
	<td>
	<a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank">
	<span class="btn btn-primary"> Live Preview</span>
	</a>
	</td>
	</tr>
	
	
<?php } ?>
	</table>
</div>
	
	    
	</div> <!-- Ending of Main Area-->
	
</div> <!-- Ending of Row-->
	
</div> <!-- Ending of Container-->

	<div id="Footer">
		<hr>
		<p>Athirah Khairi | &copy;2022 --- Science Computer.
		</p>
		<hr>
	</div>
	
	<div style="height: 10px; background: #27AAE1;"></div> 

</body>
</html>