<?php

    function authenticateAdmin($username, $password){
        $dbClient = new DatabaseClient();
        $dbClient->openConnection();

        $result = $dbClient->getMembers();

        $userids = $result['USERID'];
        $usernames = $result['USERNAME'];
        $userpasswords= $result['USERPASSWORD'];
        //$i = 0;
        for($i = 0; $i<count($userids); $i++){
        	if(validateLogin($username, $usernames[$i], getHash($password), $userpasswords[$i])){
       		    // YES
       		    session_start();
       		    $_SESSION["isLoggedIn"] = True;
              $_SESSION["USERTYPE"] = 2;
       		    $_SESSION["USERID"] = $userids[$i];
       		    $_SESSION["USERNAME"] = $usernames[$i];
       		    $_SESSION["USERPASSWORD"] = $userpasswords[$i];
       		    
       		    $dbClient->closeConnection();
    			
        		return True;
        	}
        }

    	$dbClient->closeConnection();
    	return False;
    }
?>