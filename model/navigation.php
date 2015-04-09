<?php


function GetPrimaryNavigationItems(){
    $nav = array(
        'home' => 'Home',
        'search' => 'Search',
        'contact' => 'Contact'
     );

if (CheckSession())    

{   
    $nav['account'] = 'Account';
    $nav['logout'] = 'Log Out';
}
    else {
        $nav['login'] = 'Log In';
    }
    return $nav;
    
}



