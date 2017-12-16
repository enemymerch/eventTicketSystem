<!DOCTYPE html>
<html lang="en">


<?php 
// defining variable for validation 
// for login!
$login_username = "";
$login_password = "";
$login_info = "";
// for register
$reg_username = "";
$reg_email = "";
$reg_name = "";
$reg_password = "";
$reg_street = "";
$reg_city = "";
$reg_post_code = "";
$reg_phone = "";
$reg_info = "";
?>

<?php 
include 'C:/xampp/htdocs/src/member.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
	if($_POST['submit'] == "login"){ // post for login
		// LOGIN
        // getting variables from post!
		$username  = $_POST['login_email'];
		$password = $_POST['login_password']; 
		// going to check email and password 
        if( validateLoginInformation($userName, $password)){
            // TODO: login
            if( authenticateMemeber($username, $password)) {
             // TODO
             redirect("welcome_member.php");
            }else{
             $login_info = "Wrong login information";
            }
        }
    }else if($_POST['submit'] == "register"){
        // REGISTER
        // getting variables from post
		$username = $_POST['reg_username'];
		$email  = $_POST['reg_email'];
		$name = $_POST['reg_name'];
		$password = $_POST['reg_password']; 
		$street = $_POST['reg_street'];
		$city = $_POST['reg_city'];
		$postcode = $_POST['reg_post_code'];
		$phone = $_POST['reg_phone'];
		$country = $_POST['reg_country'];

		if( validateRegisterInformation($username, $email, $name, $password, $street, $city, $postcode, $phone)){
			// TODO: register
			$result = addNewMember($username, $email, $name, $password, $street, $city, $postcode, $phone, $country);

			if($result = -2 ){
				$reg_succes = "Username is already taken!";
			}else if($result = -1){
				$reg_succes = "Email  is already taken!";
			}else{
				$reg_succes = "You have successfully registered!";
			}
		}
	}
}


function validateRegisterInformation($usernmae, $email, $name, $password, $street, $city, $postCode, $phone){

	$result = True;
	if(isEmpty($usernmae)){
		global $reg_username;
		$reg_username = "Username is requered!";
		$result  = False;
	}

	// email
	if(isEmpty($email)){
		global $reg_email;
		$reg_email = "Email is requered!";
		$result  = False;
	}
	// name
	if(isEmpty($name)){
		global $reg_name;
		$reg_name = "Name is requered!";
		$result  = False;
	}
	// password
	if(isEmpty($password)){
		global $reg_password;
		$reg_password = "Name is requered!";
		$result  = False;
	}
	//street
	if(isEmpty($street)){
		global $reg_street;
		$reg_street	= "Street Address is requered!";
		$result  = False;
	}
	//city
	if(isEmpty($city)){
		global $reg_city;
		$reg_city = "City is requered!";
		$result  = False;
	}

	// postCode
	if(isEmpty($postCode)){
		global $reg_post_code;
		$reg_post_code = "Postcode is requered!";
		$result  = False;
	}

	// phone
	if(isEmpty($phone)){
		global $reg_phone;
		$reg_phone = "Phonenumber is requered!";
		$result  = False;
	}
	return $result;
}

function validateLoginInformation($username, $password){
	$result = True;
	// email
	if(isEmpty($username)){
		global $login_username;
		$login_username = "Username is requered to login!";
		$result  = False;
		
	}
	// name
	if(isEmpty($password)){
		global $login_password;
		$login_password = "Password is requered to login!";
		$result  = False;
	}

	return $result;
}

?>

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
	 				<h2 style="text-align: center" class="text-danger">To continue, login or register...</h2>
	 				<div class="row" style="margin-top: 10%">
	 					<div class="col-xs-6">
	 						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	 							<h4 style="text-align:center" class="text-info">Login</h4>
                                <p class="text-danger"><?php echo $login_info ?></p>
                                <div class="form-group">
	 								<label for="email">Username: <?php echo "<p>". $login_username."</p>"?></label>
	 								<input type="email" class="form-control" name="login_username" id="email">
	 							</div>
	 							<div class="form-group">
	 								<label for="pws">Password: <p><?php echo $login_password ;?></p></label>
	 								<input type="password" class="form-control" name="login_password" id="pwd">
	 							</div>
	 							<button name="submit" value="login" = type="submit" class="btn btn-default">Login</button>
	 						</form>
	 					</div>
	 					<div class="col-xs-6">
	 						<h4 class="text-info" style="text-align: center">Register</h4>
	 						<p class="text-danger"><?php echo $reg_info ?></p>
	 						<form  method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	 							<div class="form-group">
	 								<label for="username">Username: <?php echo "<p>". $reg_username."</p>"?></label>
	 								<input type="name" class="form-control" id="username" name="reg_username">
	 								<label for="email">Email Address: <?php echo "<p>". $reg_email."</p>"?></label>
	 								<input type="email" class="form-control" id="email" name="reg_email">
	 								<label for="name">Name: <?php echo "<p>". $reg_name."</p>"?></label>
	 								<input type="name" class="form-control" id="name" name="reg_name">
	 							</div>
	 							<div class="form-group">
	 								<label for="pws">Password: <?php echo "<p>". $reg_password."</p>"?></label>
	 								<input type="password" class="form-control" id="pwd" name="reg_password">
	 							</div>
	 							<div class="form-group">
	 								<h6>Address:</h6>
									
									<label for="Street">Street Address: <?php echo "<p>". $reg_street."</p>"?></label>									
									<textarea type="address" class="form-control" id="streetAddress" name="reg_street"></textarea>
									

									<label for="city">City: <?php echo "<p>". $reg_city."</p>"?></label>
	 								<input type="address" class="form-control" id="cityName" name="reg_city">

									<label for="city">PostCode: <?php echo "<p>". $reg_post_code."</p>"?></label>
	 								<input type="postCode" class="form-control" id="postCode" name="reg_post_code">

									<label for="city">Country:</label>
								
									<?php echo getCountryTable(); ?>
										
	 							</div>
								<div class=form-group> 
									<label for="phone">Phone Number: <?php echo "<p>". $reg_phone."</p>"?></label>
	 								<input type="phone" class="form-control" id="phoneNumber" name="reg_phone">
								</div>
	 							<button name="submit" value="register" type="submit" class="btn btn-default">Register</button>
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


