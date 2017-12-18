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
		echo gettype($addressID);
		return $addressID;
		
	}
	function getMembers(){
		$sql = 'Select * FROM MEMBERS';
		$stmt = oci_parse($this->conn, $sql);

		oci_execute($stmt);
		oci_fetch_all($stmt, $res);
		echo gettype($res);


		return $res;
		
	}

	function getAdmins(){
		$sql = 'Select * FROM ADMINS';
		$stmt = oci_parse($this->conn, $sql);

		oci_execute($stmt);
		oci_fetch_all($stmt, $res);
		echo gettype($res);


		return $res;
		
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
		echo 'OKAY';
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
