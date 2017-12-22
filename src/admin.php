<?php

    function deleteEvent($eventID){
        $dbClient = new DatabaseClient();
        $dbClient->openConnection();

        $result = $dbClient->deleteEventByID($eventID);

        $dbClient->closeConnection();
        return $result;
    }
    function updateEvent($eventID, $eventName, $eventInfo){
        $dbClient = new DatabaseClient();
        $dbClient->openConnection();

        $res = $dbClient->updateEventByID($eventID, $eventName, $eventInfo);

        $dbClient->closeConnection();
        return $res;
    }

    function getSelectedEvent($selectedEventID){
        $dbClient = new DatabaseClient();
        $dbClient->openConnection();

        $res = $dbClient->getEventByID($selectedEventID);
        $eventName = $res['EVENTNAME'];
        $eventInfo = $res['EVENTINFORMATION'];

        $dbClient->closeConnection();

        return array($eventName[0], $eventInfo[0]);
    }

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
        $locationID = $temp;
      }else{
        $locationID = $temp[0];
      }

      // getting eventtypeID
      $eventTypeID;
      $temp = $dbClient->getEventtypeIDByeventtype($eventType);
      if(gettype($temp) == "string" ){
        $eventTypeID = $temp;
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