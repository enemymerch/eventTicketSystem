<?php

    function authenticateAdmin($username, $password){
        $dbClient = new DatabaseClient();
        $dbClient->openConnection();

        $result = $dbClient->getAdmins();

        $userids = $result['USERID'];
        $usernames = $result['USERNAME'];
        $userpasswords= $result['USERPASSWORD'];
        //$i = 0;
        for($i = 0; $i<count($userids); $i++){
        	if(validateLogin($username, $usernames[$i], $password, $userpasswords[$i])){
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



    function addEvent($name, $info, $date, $eventType, $locationName, $ticketNumber, $ticketPrice){
      $dbClient = new DatabaseClient();
      $dbClient->openConnection();

      // getting locationID
      $locationID ;
      $temp = $dbClient->getLocationidBylocationname($locationName);
      if(gettype($temp) == "string" ){
        $locationID = $tmep;
      }else{
        $locationID = $temp[0];
      }

      // getting eventtypeID
      $eventTypeID;
      $temp = $dbClient->getEventtypeIDByeventtype($eventType);
      if(gettype($temp) == "string" ){
        $eventTypeID = $tmep;
      }else{
        $eventTypeID = $temp[0];
      }

      // adding new event
      $eventID = $dbClient->addNewEvent($eventTypeID, $locationID, $name, $info, $date);
      
       
      // creating new tickets;
      for($i = 0;$i<(int)$ticketNumber; $i++){
        $dbClient->addNewTicket($eventID, $ticketPrice, $i);
      }

      return True;
    }
?>