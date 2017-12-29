<!DOCTYPE html>
<html lang="en">

<head>


	<?php 
		// Loggin Control
		include 'C:/xampp/htdocs/src/myEvents.php';
		include 'C:/xampp/htdocs/src/adminLoginAuthentication.php';


	?>

		<title>myticket</title>
		 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

	</head>

	<body>


		<!-- NAVBAR  -->
		 <nav class="navbar navbar-inverse">
		 	<div class="container-fluid">
		    	<div class="navbar-header">
		      		<a class="navbar-brand" href="welcome_admin.php">My Events</a>
		    	</div>
		    	<ul class="nav navbar-nav">
		      		<li class="active"><a href="welcome_admin.php">Home</a></li>
		      		<li class="dropdown">
        				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
        					Events
        					<span class="glyphicon glyphicon-user"></a>
        				<ul class="dropdown-menu">
          					<li><a href="add_event.php">Add Event</a></li>
          					<li><a href="edit_event.php">Edit Event</a></li>
          					<li><a href="delete_event.php">Delete Event</a></li>
        				</ul>
      				</li>

		    	</ul>

		    	<ul class="nav navbar-nav navbar-right">
		    		<li class="dropdown">
        				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
        					<?php       		    
        						if(!isset($_SESSION)){
        							session_start();
        						}
        						echo $_SESSION["USERNAME"];
        					?>
        					<span class="glyphicon glyphicon-user"></a>
        				<ul class="dropdown-menu">
          					<li><a href="logout.php">Log Out</a></li>
        				</ul>
      				</li>
		    	</ul>
		  	</div>
		</nav> 

		<div class="container" style="margin-top: 10%; ">
			<div class="row">
				<h2 class="text-danger" style="text-align: center;">Handing Gold Members</h2>
				<div class="col-xs-4 col-xs-offset-1">
					<h4 class="text-info" style="text-align: center;">Currnet Gold Members</h4>
					<?php getGoldMemberTable();?>
				</div>
				<div class="col-xs-4 col-xs-offset-2">
					<h4 class="text-info"  style="text-align: center;">Make Gold Members</h4>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
						<div class="form-group">
							<?php getNormalMemberSelection(); ?>
							</br></br>
							<button type="submit" name="submit" value="makeGold" class="btn btn-default">Make Gold</button>
						</div>
					</form>	
				</div>

			</div>
		</div>


	 	<footer style="margin-top: 20%">
	 	</footer>
	</body>
</html>