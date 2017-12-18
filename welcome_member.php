<!DOCTYPE html>
<html lang="en">

<head>


	<?php 
		// Loggin Control
		include 'C:/xampp/htdocs/src/loginAuthentication.php';

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
		      		<a class="navbar-brand" href="welcome_member.php">My Events</a>
		    	</div>
		    	<ul class="nav navbar-nav">
		      		<li class="active"><a href="welcome_member.php">Home</a></li>
		      		<li><a href="search_events.php">Events</a></li>

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
          					<li><a href="404.php">Edit Profile</a></li>
          					<li><a href="404.php">Log Out</a></li>
        				</ul>
      				</li>
		    	</ul>
		  	</div>
		</nav> 

		<div class="container" style="margin-top: 10%; ">
			<div class="row">
				<div class="col-xs-3 col-xs-offset-2">
					<h2 class="text-info" style="text-align: center">SEARCH FOR EVENTS</h2>
					</br>
					</br>
					</br>
						<button  class="btn btn-default center-block" name="submit" value="search" ><a href="search_events.php">SEARCH</a></button>
				</div>
				<div class="col-xs-3 col-xs-offset-2">
					<h2 class="text-info" style="text-align: center">YOUR PROFILE</h2>
					</br>
					</br>
					<?php 
					// TODO !!!
						$profileImagePath = $_SESSION['USERID'].".jpeg";
						if(file_exists($profileImagePath)){
							echo "<img src=\"". $profileImagePath . "\" class=\"img-rounded\" alt=\"Cinque Terre\">";
						}else{
							echo "<p class=\"text-danger\">You didn't uploaded a profile pic by the way...! </p>";
						}
					?>
					</br>
						<button  class="btn btn-default center-block" name="submit" value="edit"><a href="edit_profile.php">GO TO PROFILE</a></button>
				</div>
			</div>
		</div>
		<div class="container" style="margin-top: 10%;">
			<div class="row">
				<h2 class="text-info" style="text-align: center">DASHBOARD FOR HISTORY</h2>
			</div>
		</div>

	 	<footer style="margin-top: 20%">
	 	</footer>
	</body>
</html>