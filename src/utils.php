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
?>

