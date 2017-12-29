<?php
class DatabaseClient
{
    // property declaration
    public	$db = "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521)))(CONNECT_DATA=(SID=dbs)))" ;
	public	$conn = NULL;

	function  openConnection(){
		$this->conn = oci_connect("b21228932", "21228932", $this->db);
	}

	function  closeConnection(){
		$this->conn = oci_close($this->conn);
	}


	function getNormalMembers(){
		$sql = "select * from NORMALMEMBERS";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
	    oci_fetch_all($stmt, $res);
	    return $res;
	}


	function getGoldMembers(){
		$sql = "select * from goldmembers";
        $stmt = oci_parse($this->conn, $sql);
        oci_execute($stmt);
	    oci_fetch_all($stmt, $res);
	    return $res;
	}

	function addDiscount($discountPercentage){
        $sql = 'BEGIN ADDNEWDISCOUNT(:PERCENTAGE); END;';
        $stmt = oci_parse($this->conn, $sql);

        oci_bind_by_name($stmt, ':PERCENTAGE', $discountPercentage);

        return oci_execute($stmt);
    }
    function getDiscounts(){
	    $sql = "SELECT * FROM DISCOUNT";
	    $stmt = oci_parse($this->conn, $sql);

	    oci_execute($stmt);
	    oci_fetch_all($stmt, $res);
	    return $res;
    }
	function getLogs($userID){
		$sql = "select ML.LOGID, ML.LOGINFORMATION, ML.LOGDATE from MEMBERLOG ML where ML.USERID=" . (int)$userID ;
		$stmt = oci_parse($this->conn, $sql);

		oci_execute($stmt);
		oci_fetch_all($stmt, $res);
		return $res;
	}

	function updateUserPassword($userID, $password){
    	$sql = 'BEGIN UPDATEUSERPASSWORD(:USRID, :USRPASSWORD); END;';
  		$stmt = oci_parse($this->conn, $sql);

		oci_bind_by_name($stmt, ':USRID', $userID);
		oci_bind_by_name($stmt, ':USRPASSWORD', $password);

		//execution
		return oci_execute($stmt);
	}

	function updateMemberInfo($userID, $name, $phone, $email){
    	$sql = 'BEGIN UPDATEMEMBERINFO(:USRID, :MBRNAME, :MBRPHONENUMBER, :MBREMAIL); END;';
    	$stmt = oci_parse($this->conn, $sql);

    	oci_bind_by_name($stmt, ':USRID', $userID);
    	oci_bind_by_name($stmt, ':MBRNAME', $name);
    	oci_bind_by_name($stmt, ':MBRPHONENUMBER', $phone);
    	oci_bind_by_name($stmt, ':MBREMAIL', $email);

    	oci_execute($stmt);

	}

	function updateMember($userID, $userName, $userPassword, $addresID, $memberName, $memberPhone, $memberMail){
    	$sql = 'BEGIN UPDATEMEMBER(:USRID, :USRNAME, :USRPASSWORD, :USRTYPEID, :MBRTYPEID, :ADDID, :MBRNAME, :MBRPHONENUMBER, :MBREMAIL); END;';
  		$stmt = oci_parse($this->conn, $sql);

  		// TODO
  		oci_execute($stmt);
  	}


	function isUsernameTaken($username){
		$sql = 'BEGIN ISUSERNAMEUSED(:UNAME, :RES); END;';
		$stmt = oci_parse($this->conn, $sql);

		$result;
		//binding variables
		oci_bind_by_name($stmt, ':UNAME', $username);
		oci_bind_by_name($stmt, ':RES', $result);

		//execution
		oci_execute($stmt);

		return $result;
	}
	function isEmailTaken($email){
		$sql = 'BEGIN ISEMAILUSED(:EMAIL, :RES); END;';
		$stmt = oci_parse($this->conn, $sql);

		$result;
		//binding variables
		oci_bind_by_name($stmt, ':EMAIL', $email);
		oci_bind_by_name($stmt, ':RES', $result);

		//execution
		oci_execute($stmt);

		return $result;
	}
	function addNewAddress($street, $city, $countryID, $postcode){
		$result = False;

		$sql = 'BEGIN ADDNEWADDRESS(:STADD, :CITY, :COUNTRYID, :POSTCODE, :AID); END;';
		$stmt = oci_parse($this->conn, $sql);

		//binding variables		
		oci_bind_by_name($stmt, ':STADD', $street);
		oci_bind_by_name($stmt, ':CITY', $city);
		oci_bind_by_name($stmt, ':COUNTRYID', $countryID);
		oci_bind_by_name($stmt, ':POSTCODE', $postcode);
		$addressID  = 20 ;
		oci_bind_by_name($stmt, ':AID', $addressID,20);
		
		//execute
		oci_execute($stmt);
		return $addressID;
		
	}
    function deleteEventByID($eventID){
        $sql = 'BEGIN DELETEEVENT(:EVNTID); END;';
        $stmt = oci_parse($sql);

        oci_bind_by_name($stmt, ':EVNTID', $eventID);

        return oci_execute($stmt);
    }
	function getMembers(){
		$sql = 'Select * FROM MEMBERS';
		$stmt = oci_parse($this->conn, $sql);

		oci_execute($stmt);
		oci_fetch_all($stmt, $res);


		return $res;
		
	}

	function getAdmins(){
		$sql = 'Select * FROM ADMINS';
		$stmt = oci_parse($this->conn, $sql);

		oci_execute($stmt);
		oci_fetch_all($stmt, $res);


		return $res;
		
	}

	function updateEventByID($eventID, $eventName, $eventInfo){
	    $sql = 'BEGIN UPDATEEVENT(:EVNTID, :EVNTNAME, :EVNTINFORMATION); END;';
	    $stmt = oci_parse($this->conn, $sql);

        oci_bind_by_name($stmt, ':EVNTID', $eventID);
        oci_bind_by_name($stmt, ':EVNTNAME', $eventName);
        oci_bind_by_name($stmt, ':EVNTINFORMATION', $eventInfo);

        return oci_execute($stmt);
    }
    function getEventByID($eventID){
	    $sql = 'select * from event where EVENTID = '. $eventID;
	    $stmt = oci_parse($this->conn, $sql);

	    oci_execute($stmt);
	    oci_fetch_all($stmt, $res);

	    return $res;
    }
	function getEvents(){
		$sql = "select * from event";
		$stmt = oci_parse($this->conn, $sql);

		oci_execute($stmt);
		oci_fetch_all($stmt, $res);

		return $res;
	}

	function getEventtypeIDByeventtype($eventType){
		$sql = "select ET.EVENTTYPEID  ETID FROM EVENTTYPE ET WHERE ET.EVENTTYPE='".$eventType."'";
		$stmt = oci_parse($this->conn, $sql);

		oci_execute($stmt);
		oci_fetch_all($stmt, $res);

		return $res['ETID'];
	}
	function getLocationidBylocationname($locationName){
		$sql = "select L.LOCATIONID LID from LOCATION L WHERE L.LOCATIONNAME='".$locationName."'";
		$stmt = oci_parse($this->conn, $sql);
		oci_execute($stmt);
		oci_fetch_all($stmt, $res);
		return $res['LID'];
	}
	function getEventtypes(){
		$sql = 'select * from eventtype';
		$stmt = oci_parse($this->conn, $sql);

		oci_execute($stmt);
		oci_fetch_all($stmt, $res);
		//$id = $res['ID'];
		return $res['EVENTTYPE'];
	}
	function getLocations(){
		$sql = 'select * from location';
		$stmt = oci_parse($this->conn, $sql);

		oci_execute($stmt);
		oci_fetch_all($stmt, $res);
		//$id = $res['ID'];
		return $res['LOCATIONNAME'];
	}



	function addNewTicket($eventID, $ticketPrice, $ticketSeat){
		$sql = 'BEGIN ADDNEWTICKET(:EVNTID, :TCKTSTATUSID, :TCKTPRICE, :TCKTSEAT); END;';
		$stmt = oci_parse($this->conn, $sql);
		
		$ticketStatusID = 1;
		oci_bind_by_name($stmt, ':EVNTID', $eventID);
		oci_bind_by_name($stmt, ':TCKTSTATUSID', $ticketStatusID);
		oci_bind_by_name($stmt, ':TCKTPRICE', $ticketPrice);
		oci_bind_by_name($stmt, ':TCKTSEAT', $ticketSeat);

		oci_execute($stmt);
	}
	function addNewEvent($eventTypeID, $locationID, $eventName, $eventInfo, $eventDate){
		$sql = 'BEGIN ADDNEWEVENT(:LCATIONID, :EVNTTYPEID, :EVNTNAME, :EVNTINFORMATION , :EVNTDATE, :EID); END;';
		$stmt = oci_parse($this->conn, $sql);
		$tokens = explode("T", $eventDate);
		$tempDate = $tokens[0]. " " . $tokens[1] ;
		$eventID;
		oci_bind_by_name($stmt, ':LCATIONID', $locationID);
		oci_bind_by_name($stmt, ':EVNTTYPEID', $eventTypeID);
		oci_bind_by_name($stmt, ':EVNTNAME', $eventName);
		oci_bind_by_name($stmt, ':EVNTINFORMATION', $eventInfo);
		oci_bind_by_name($stmt, ':EVNTDATE', $tempDate);
		oci_bind_by_name($stmt, ':EID', $eventID, 20);

		oci_execute($stmt);

		return $eventID;
	}

	function addNewMember($username, $email, $name, $password, $street, $city, $phone, $postcode, $addID){
		$result = False;

		$sql = 'BEGIN ADDNEWMEMBER(:USRNAME, :USRPASSWORD, :USRTYPEID, :MBRTYPEID, :ADDID, :MBRNAME, :MBRPHONENUMBER, :MBREMAIL); END;';
		$stmt = oci_parse($this->conn, $sql);
		// email
		oci_bind_by_name($stmt, ':USRNAME', $username);
		// password
		oci_bind_by_name($stmt, ':USRPASSWORD', $password);
		//USRTYPEID
		$temp = 2;
		oci_bind_by_name($stmt, ':USRTYPEID', $temp);
		//membertypeid
		$temp = 1;
		oci_bind_by_name($stmt, ':MBRTYPEID', $temp);
		// addressid
		oci_bind_by_name($stmt, ':ADDID', $addID);
		//	memberName
		oci_bind_by_name($stmt, ':MBRNAME', $name);
		//MBRPHONENUMBER
		oci_bind_by_name($stmt, ':MBRPHONENUMBER', $phone);
		//email
		oci_bind_by_name($stmt, ':MBREMAIL', $email);
		
		//execute
		$result = oci_execute($stmt);
		
		return $result;
	}

	function  addNewCountry($country){
		$sql = 'BEGIN ADDNEWCOUNTRY(:CTRYNAME); END;';
		$stmt = oci_parse($this->conn,$sql);
		oci_bind_by_name($stmt,':CTRYNAME',$country,32);
		oci_execute($stmt);
	}


	function getCountryID($country){
		$sql = "select C.COUNTRYID ID from COUNTRY C Where C.COUNTRYNAME ='". $country."'";
		$stmt = oci_parse($this->conn, $sql);
		oci_execute($stmt);
		oci_fetch_all($stmt, $res);
		$id = $res['ID'];
		return $id[0];
	}

	function getCountries(){
		$stmt = oci_parse($this->conn, $this->getSelectSQL('COUNTRY'));
		oci_execute($stmt);
		oci_fetch_all($stmt, $res);
		$countries = $res['COUNTRYNAME'];

		return $countries;
	}

	function getSelectSQL($tableName){
		return 'select * from '.$tableName;
	}
}

?>
