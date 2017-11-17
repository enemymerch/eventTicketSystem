<!DOCTYPE html>
<html lang="en">

<head>

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
		      		<a class="navbar-brand" href="#">My Events</a>
		    	</div>
		    	<ul class="nav navbar-nav">
		      		<!--<li class="active"><a href="index.html">Home</a></li>-->
		    	</ul>
		    	<!-- <ul class="nav navbar-nav navbar-right">
		      		<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		      		<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		    	</ul>
		    -->
		  	</div>
		</nav> 


	 	<div class="container">
	 		<div class="row">
	 			<br><br>
	 			<div class="col-xs-8 col-xs-offset-2">
	 				<center><h2 class="text-danger">To continue, login or register...</h2></center>
	 					<p style="visibility: hidden;"> s </p>
	 					<?php 
	 						echo ' 
									<p  style="visibility: hidden;" id="info"> sqweqw </p>
	 					

				 					<script type="text/javascript">
										function hideInfoText(){
											var p = document.getElementById("info");
											p.stye.visibility = hidden;
										}	 

										function hideInfoText(){
											var p = document.getElementById("info");
											p.stye.visibility = "visible";
										}	 	
 										hideInfoText();
									</script>';
		
	 					?>

	 				<div class="row" style="margin-top: 10%">
	 					<div class="col-xs-6">
	 						<form>
	 							<center><h4 class="text-info">Login</h4></center>
	 							<div class="form-group">
	 								<label for="email">Email Address:</label>
	 								<input type="email" class="form-control" id="email">
	 							</div>
	 							<div class="form-group">
	 								<label for="pws">Password:</label>
	 								<input type="password" class="form-control" id="pwd">
	 							</div>
	 							<button type="submit" class="btn btn-default">Login</button>
	 						</form>
	 					</div>
	 					<div class="col-xs-6">
	 						<center><h4 class="text-info">Register</h4></center>
	 						<form>
	 							<div class="form-group">
	 								<label for="email">Email Address:</label>
	 								<input type="email" class="form-control" id="email">
	 								<label for="name">Name:</label>
	 								<input type="name" class="form-control" id="name">
	 							</div>
	 							<div class="form-group">
	 								<label for="pws">Password:</label>
	 								<input type="password" class="form-control" id="pwd">
	 							</div>
	 							<div class="form-group">
	 								<h6>Address:</h6>
									
									<label for="Street">Street Address:</label>
	 								<input type="address" class="form-control" id="streetAddress">
									
									<label for="city">City:</label>
									<textarea type="address" class="form-control" id="cityName"></textarea>
									
									<label for="city">PostCode:</label>
	 								<input type="postCode" class="form-control" id="postCode">

	 							</div>
	 							<button type="submit" class="btn btn-default">Register</button>
	 						</form>
	 					</div>
	 				</div>
	 			</div>
	 		</div>
	 	</div>

	 	<footer style="margin-top: 20%">
	 	</footer>
	</body>
</html>