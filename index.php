<?php
/*
 * BYU - CIT 336
 * Adam Kelley
 */

ini_set('display_errors', 1);

session_start();


require 'model/db.php';
require 'model/navigation.php';
require 'model/roles.php';
require 'model/users.php';
require 'model/search.php';

include 'views/header.php';

$action = strtolower(filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING));

switch ($action)
{
    case 'account':
        include 'views/menu.php';
        break;
    
    case 'home':
        include 'views/home.php';
        break;
    
    case 'error':
        include 'views/db_error.php';
        break;
    
    case 'changerole':
        $designer_id = (int) filter_input(INPUT_GET, 'designer_id', FILTER_SANITIZE_NUMBER_INT);
        $role_id = filter_input(INPUT_GET, 'role_id', FILTER_SANITIZE_STRING);
        
        if (LoggedInUserIsAdmin() && $designer_id && $role_id)
        {
            UpdateUserRole($designer_id, $role_id);
        }
        
        header('Location: /?action=editusers');
        exit();
    
    case 'deleteuser':
        $designer_id = (int) filter_input(INPUT_GET, 'designer_id', FILTER_SANITIZE_NUMBER_INT);
        
        if (LoggedInUserIsAdmin() && $designer_id)
        {
            DeleteUser($designer_id);
        }
        
        header('Location: /?action=editusers');
        exit();
        
    case 'deleteme':
        $designer_id = $_SESSION[designer_id];
        
        if (isset($designer_id))
        {
            DeleteUser($designer_id);
        }
        
        header('Location: /?action=logout');
        exit();
    
    case 'editusers':
        $page = (LoggedInUserIsAdmin()) ? 'views/edit_users.php' : 'views/register.php';
        $users = GetAllUsers();
        include $page;
        break;
        
    case 'contact':
        include 'views/contact.php';
        break;
    
    case 'search':
        $des =  GetStates();
        $citres = GetCity();
        $desres = GetDes();
        include 'views/search.php';
        break;
    
   
    
    case 'login':
        include 'views/register.php';
        break;
        
    case 'registersubmit':
            
            $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
            $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
            $emailreg = filter_input(INPUT_POST, 'emailreg', FILTER_SANITIZE_STRING);
            $passwordreg1 = filter_input(INPUT_POST, 'passwordreg1', FILTER_SANITIZE_STRING);
            $passwordreg2 = filter_input(INPUT_POST, 'passwordreg2', FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
            $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
            $experience = filter_input(INPUT_POST, 'experience', FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
            $message = '';
            
            if (RegisterUser($firstname, $lastname, $emailreg, $passwordreg1, $passwordreg2, $city, $state, $experience, $price, $message)) {
            header('Location: /?action=menu');
            exit();
        }
        
       include 'views/register.php';
       break;
            
                 
    case 'loginsubmit':
     
            $emailreg = filter_input(INPUT_POST, 'emailreg', FILTER_SANITIZE_EMAIL);
	    $passwordreg1 = filter_input(INPUT_POST, 'passwordreg1', FILTER_SANITIZE_STRING);
        
            if (LoginUser($emailreg, $passwordreg1)) {
              header('Location: /?action=menu');
            exit();
        }
        
        include 'views/register.php';
        break;
	
	        
    case 'menu':
        $page = (CheckSession()) ? 'views/menu.php' : 'views/register.php';
        include $page;
        break;
    
    case 'profile':
        $emailreg = filter_input(INPUT_POST, 'emailreg', FILTER_SANITIZE_EMAIL);
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
        $experience = filter_input(INPUT_POST, 'experience', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING);
        
        if ($userId = GetLoggedInUserId()) 
        {
            $page = 'views/profile.php';
            $user = GetUser();
        }
        
        if ($designer_id = GetLoggedInUserId()) 
        {
            $page = 'views/profile.php';
            
            if ($firstname && $lastname && $emailreg && $city && $state && $experience && $price) 
            {
                UpdateUserInfo($designer_id, $emailreg, $firstname, $lastname, $city, $state, $experience, $price);
                $user = GetUser();
                $message = 'User Info Updated.';
            }
            else
            {
                $message = 'Please fill in all information to update.';
            }
        }
        else
        {
            $page = 'views/login.php';
        }
        
        
        
        include $page;
        break;
        include $page;
        break;
    
    case 'logout':
        session_destroy();
        $_SESSION = array();
        header('Location: /');
        exit();
        break;
    
    case 'updatepassword':
        $oldpassword = $_POST['currentpassword'];
        $newpassword = $_POST['newpassword'];
        $newpassword2 = $_POST['repeatpassword'];
        $message = '';
        
        if ($newpassword == $newpassword2)
        {
            $validMessage = '';
            if (ValidatePassword($newpassword, $validMessage))
            {
                if (ValidateOldPassword($oldpassword))
                {
                    UpdateUserPassword($newpassword);
                    $message = 'Password Updated';
                }
                else
                {
                    $message = 'The old password did not match.';
                }
            }
            else
            {
                $message = $validMessage;
            }
        }
        else
        {
            $message = "The new passwords do not match";
        }
        
        if ($designer_id = GetLoggedInUserId()) 
        {
            $page = 'views/profile.php';
            $user = GetUser();
        }
  
        include 'views/profile.php';
        break;
    
    default:
        include 'views/home.php';
}
include 'views/footer.php';

