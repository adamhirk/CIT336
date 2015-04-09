<?php
ini_set('display_errors', 1);
/**
 * A collection of functions related to Users and Passwords.
 **/
/// Define the User object.

class User
{
	var $designer_id;
	var $emailreg;
	var $passwordreg1;
	var $firstName;
	var $lastName;
        var $city;
        var $state;
        var $experience;
        var $price;
	var $role_id;
}

function CalculatePasswordHash($passwordreg1) {
	return sha1($passwordreg1 . 'addSomeExtraSalt123');
}

function DeleteUser($designer_id)
{
	$query = 'DELETE FROM designers WHERE designer_id=:designer_id';
	DbExecute($query, array(':designer_id' => $designer_id));
}


function CheckSession(){
    
	return(GetLoggedInUserId() != null);
}

function GetUser() {
        $designer_id=$_SESSION['designer_id'];
	$query = 'SELECT * FROM designers WHERE designer_id=:designer_id';
	$result = DbSelect($query, array(':designer_id' => $designer_id));
	
	if (array_key_exists(0, $result))
	{
		$user = new User();
		$user->designer_id = $result[0]['designer_id'];
		$user->emailreg = $result[0]['emailreg'];
		$user->firstname = $result[0]['firstname'];
		$user->lastname = $result[0]['lastname'];
                $user->city = $result[0]['city'];
                $user->state = $result[0]['state'];
                $user->experience = $result[0]['experience'];
                $user->price = $result[0]['price'];
		$user->role_id = $result[0]['role_id'];
		
		return $user;
	}
	
	return false;
}

function GetAllUsers()
{
	$users = array();
	$query = 'SELECT * FROM designers';
	$result = DbSelect($query);
	
	foreach ($result as $item)
	{
		$user = new User();
		$user->designer_id = $item['designer_id'];
		$user->emailreg = $item['emailreg'];
		$user->firstname = $item['firstname'];
		$user->lastname = $item['lastname'];
                $user->city = $item['city'];
                $user->state = $item['state'];
                $user->experience = $item['experience'];
                $user->price = $item['price'];
		$user->role_id = $item['role_id'];
		
		$users[] = $user;
	}
	
	return $users;
}

function GetLoggedInUserId()
{
	return (array_key_exists('designer_id', $_SESSION)) ? $_SESSION['designer_id'] : null;
        
}

function LoggedInUserIsAdmin()
{
	return array_key_exists('role_id', $_SESSION) && $_SESSION['role_id'] == ROLE_ID_ADMIN;
}


function LoginUser($emailreg, $passwordreg1) {
	$loggedIn = false;
	
	if ($emailreg && $passwordreg1) {
		$hash = CalculatePasswordHash($passwordreg1);
		$query = "SELECT * FROM designers WHERE emailreg=:emailreg";
		$result = DbSelect($query, array(':emailreg' => $emailreg));
		
		if (is_array($result) && array_key_exists(0, $result)) {
			$user = new User();
			$user->designer_id = $result[0]['designer_id'];
			$user->role_id = $result[0]['role_id'];
			SetUserSessionVariables($user);
			$loggedIn = true;
		}
	}
	
	return $loggedIn;
}



function RegisterUser($firstname, $lastname, $emailreg, $passwordreg1, $passwordreg2, $city, $state, $experience, $price, &$message) {
	$registered = false;
	
	if (ValidateEmail($emailreg, $message) &&
		ValidatePasswordLength($passwordreg1, $message)) {
		if ($passwordreg1 == $passwordreg2) {
			$query = "SELECT * FROM designers WHERE emailreg='$emailreg'";
			$result = DbSelect($query, array(':emailreg' => $emailreg));
			
			if (is_array($result) && count($result) == 0) {
				$hash = CalculatePasswordHash($passwordreg1);
				$query = "INSERT INTO designers(firstname, lastname, emailreg, passwordreg1, city, state, experience, price)";
				$query .= " VALUES(:firstname, :lastname, :emailreg, :passwordreg1, :city, :state, :experience, :price)";
				
				$designer_id = DbInsert($query, array(':firstname' => $firstname, ':lastname' => $lastname, ':emailreg' => $emailreg, ':passwordreg1' => $hash, ':city' => $city, ':state'=> $state, ':experience'=>$experience, ':price'=>$price));
				$u = new User();
				$u->designer_id = $designer_id;
				$u->role_id = null;
				SetUserSessionVariables($u);
				$registered = true;
                                echo $emailreg;
			} else{
                            $message .= "Email is already registered.";
                        }
		}
		else
		{
			$message .= "Password and Verify Password must match.";
		}
	}
	
	return $registered;
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}

function SelectState(){
     $state=intval($_GET['state']);
    $query="SELECT state FROM designers ORDER BY state";
    $result=DbSelect($query);
    
}



function UpdateUserInfo($designer_id, $emailreg, $firstname, $lastname, $city, $state, $experience, $price)
{
	$query = 'UPDATE designers SET emailreg=:emailreg, firstname=:firstname, lastname=:lastname, city=:city, state=:state, experience=:experience, price=:price WHERE designer_id=:designer_id';
	DbExecute($query, array(':emailreg' => $emailreg, ':firstname' => $firstname, ':lastname' => $lastname, ':city'=> $city, ':state'=> $state, ':experience'=> $experience, ':price'=> $price, ':designer_id' => $designer_id));
}

function SetUserSessionVariables(User $user) {
	$_SESSION['designer_id'] = $user->designer_id;
	$_SESSION['role_id'] = $user->role_id;
}

function UpdateUserRole($designer_id, $role_id)
{
	if ($designer_id && $role_id)
	{
		$role_id = (strtolower($role_id) == 'admin') ? ROLE_ID_ADMIN : ROLE_ID_USER;
		
		$query = 'UPDATE designers SET role_id=:role_id where designer_id=:designer_id';
		DbExecute($query, array(':role_id' => $role_id, ':designer_id' => $designer_id));	
	}
}

function UpdateUserPassword($passwordreg1, $designer_id = null)
{
	$designer_id = ($designer_id == null) ? GetLoggedInUserId() : $designer_id;
	$hash = CalculatePasswordHash($passwordreg1);
	
	$query = 'UPDATE designers SET passwordreg1=:hash WHERE designer_id=:designer_id';
	DbExecute($query, array(':hash' => $hash, ':designer_id' => $designer_id));
}

function ValidateEmail($emailreg, &$message) {
	// hi@something.co.uk
	if (filter_var($emailreg, FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	
	$message .= "Invalid Email address";
	return false;
}

function ValidatePasswordLength($name, &$message) {
	// TODO: make sure password contains UPPERCASE, lowercase, numbers, and special chars.
	
	if (strlen($name) >= 5) {
		return true;	
	} else {
		$message .= "Password must be at least 5 characters long";
		return false;
	} 
}


function ValidateOldPassword($passwordreg1)
{
	$return = false;
	$designer_id = GetLoggedInUserId();
	$hash = CalculatePasswordHash($passwordreg1);
	$query = 'SELECT * FROM designers WHERE designer_id=:designer_id';
	
	$result = DbSelect($query, array(':designer_id' => $designer_id));
	
	if ($result && count($result) > 0)
	{
		$return = true;
	}
	
	return $return;
}


function ValidatePassword($passwordreg1, &$message){
	$valid = false;
	
	if (strlen($passwordreg1) >= 3)
	{
		$valid = true;
	}
	else
	{
		$message = "The password must be at least 3 characters long.";
	}
	
	return $valid;
}