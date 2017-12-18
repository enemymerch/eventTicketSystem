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
		return -9; // means Email is taken
	}else if((int)$dbClient->isUsernameTaken($username)){
		return -10; // means username is taken
	}else{
		//first going to create address for user !
		// but going to need the countryIDü
		$countryID = $dbClient->getCountryID($country);
		$addressID = $dbClient->addNewAddress($street, $city, $countryID, $postcode ); 
		//now , going to add the new user
		$result = $dbClient->addNewMember($username, $email, $name, getHash($password), $street, $city, $phone, $postcode, $addressID);
		
	}

	$dbClient->closeConnection();
	return 0;
}
    function authenticateMemeber($username, $password){
        $dbClient = new DatabaseClient();
        $dbClient->openConnection();

        $result = $dbClient->getMembers();

        $userids = $result['USERID'];
        $usernames = $result['USERNAME'];
        $userpasswords= $result['USERPASSWORD'];
        //$i = 0;
        for($i = 0; $i<count($userids); $i++){
        	$r = $i;
        	echo $i;
        	if(validateLogin($username, $usernames[$i], getHash($password), $userpasswords[$i])){
       		    // YES
       		    session_start();
       		    $_SESSION["isLoggedIn"] = True;
       		    $_SESSION["USERTYPE"] = 1;
       		    //echo $usernames[$r];
       		    echo $i;
       		    echo count($userids);
       		    $_SESSION["USERID"] = $userids[$i];
       		    $_SESSION["USERNAME"] = $username;
       		    $_SESSION["USERPASSWORD"] = $userpasswords[$i];
       		    
       		    $dbClient->closeConnection();
    			
        		return True;
        	}
        }

    	$dbClient->closeConnection();
    	return False;
    }



?>