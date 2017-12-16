<?php
include "db.php";
include "utils.php";


function addNewMember($username, $email, $name, $password, $street, $city, $postcode, $phone, $country){
	// creating a db Client
	$dbClient = new DatabaseClient();

	// opening the db connection
	$dbClient->openConnection();

	// first going to check if the email address if used ort not!
	
	if( (int)$dbClient->isEmailTaken($email)) { // is email taken ? 
		return -1; // means Email is taken
	}else if((int)$dbClient->isUsernameTaken($username)){
		return -2; // means username is taken
	}else{
		//first going to create address for user !
		// but going to need the countryIDü
		$countryID = $dbClient->getCountryID($country);
		$addressID = $dbClient->addNewAddress($street, $city, $countryID, $postcode ); 
		//now , going to add the new user
		$result = $dbClient->addNewMember($username, $email, $name, getHash($password), $street, $city, $phone, $postcode, $addressID);
		
	}

	$dbClient->closeConnection();
	return $result;
}
    function authenticateMemeber($username, $password){
        return False;
    }
?>