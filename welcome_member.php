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

		<?php 
			$member_name = 'Jack';
		?>

		<!-- NAVBAR  -->
		 <nav class="navbar navbar-inverse">
		 	<div class="container-fluid">
		    	<div class="navbar-header">
		      		<a class="navbar-brand" href="welcome_member.php">My Events</a>
		    	</div>
		    	<ul class="nav navbar-nav">
		      		<li class="active"><a href="welcome_member.php">Home</a></li>
		      		<li><a href="welcome_member.php">Events</a></li>

		    	</ul>

		    	<ul class="nav navbar-nav navbar-right">
		      		<!-- 
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		      			<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		      		-->
		    		<li class="dropdown">
        				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
        					<?php
        						echo $member_name;
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


<?php
// Create connection to Oracle
 $db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521)))(CONNECT_DATA=(SID=dbs)))" ;
$conn = oci_connect("b21228932", "21228932", $db);
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
else {
   print "Connected to Oracle!";
   $s = oci_parse($conn, 'select * from COUNTRY');
   oci_execute($s);
   oci_fetch_all($s, $res);
   $countries = $res['COUNTRYNAME'];
   
   echo '</br><ul>';
   for($i = 0 ; count($countries)>$i ; $i++){
   		echo '<li>'. $countries[$i] .'</li>';
   }
   echo '</ul>';
   
}
// Close the Oracle connection
oci_close($conn);
?>

	 	<footer style="margin-top: 20%">
	 	</footer>
	</body>
</html>