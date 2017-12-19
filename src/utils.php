<?php 


function redirect($url, $statusCode = 303)
{
   header('Location: ' . $url, true, $statusCode);
   die();
}


function isEmpty($var){
	if($var == ""){
		return True;
	}

	return False;

}

function getHash($var){
	return md5($var);
}


function validateLogin($username1, $username2, $password1, $password2){
    	if(($username1==$username2) and( $password1 == $password2)){
    		return True;
    	}
    	return False;
    }

function getCountryTable(){
	$dbClient = new DatabaseClient();
	$dbClient->openConnection();
	$htmlCode = "<select class=\"form-control\" id=\"sel1\" name=\"reg_country\"> ";
	$countries =  $dbClient->getCountries();
	if ($countries == NULL){
		$htmlCode = $htmlCode.'<option>1</option>';
	}
	for($i = 0 ; count($countries)>$i ; $i++){
		$htmlCode = $htmlCode.'<option>'.strtoupper( $countries[$i] ).'</option>';
	}
	$htmlCode = $htmlCode."</select>";
	$dbClient->closeConnection();
	return $htmlCode;
}

function getEventtypeTable(){
	$dbClient = new DatabaseClient();
	$dbClient->openConnection();
	$htmlCode = "<select class=\"form-control\" id=\"sel2\" name=\"event_type\"> ";
	$locations =  $dbClient->getEventtypes();

	if ($locations == NULL){
		$htmlCode = $htmlCode.'<option>1</option>';
	}
	for($i = 0 ; count($locations)>$i ; $i++){
		$htmlCode = $htmlCode.'<option>'.$locations[$i].'</option>';
	}
	$htmlCode = $htmlCode."</select>";
	$dbClient->closeConnection();
	return $htmlCode;
}


function getLocationTable(){
	$dbClient = new DatabaseClient();
	$dbClient->openConnection();
	$htmlCode = "<select class=\"form-control\" id=\"sel1\" name=\"event_location\"> ";
	$locations =  $dbClient->getLocations();

	if ($locations == NULL){
		$htmlCode = $htmlCode.'<option>1</option>';
	}
	for($i = 0 ; count($locations)>$i ; $i++){
		$htmlCode = $htmlCode.'<option>'. $locations[$i].'</option>';
	}
	$htmlCode = $htmlCode."</select>";
	$dbClient->closeConnection();
	return $htmlCode;
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

