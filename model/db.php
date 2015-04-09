<?php
//I removed sensitive info. about my database here. Please continue to look around.

try {
    $db = new PDO($dsn, $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }            
            

 function DbExecute($query, $params = null)
{
    global $db;
    try 
    {
        $statement = $db->prepare($query);
        
        if (is_array($params))
        {
            foreach ($params as $key => $value)
            {
                $statement->bindValue($key, $value);
            }
        }
        
        $statement->Execute();
    }
    catch (Exception $e)
    {
        echo "Database exception, try again later.";
        error_log($e);
        exit();
    }
}

    
    
    
    
function DbInsert($query, $params = null)
{
    global $db;
    $return = false;
    
    try
    {
        $statement = $db->prepare($query);
        
        if (is_array($params))
        {
            foreach ($params as $key => $value)
            {
                $statement->bindValue($key, $value);
            }
        }
        
        $statement->Execute();
        $return = $db->lastInsertId();
    }
    catch (Exception $e)
    {
        echo "Database insert exception, please try again later.";
        error_log($e);
        exit();
    }
    
    return $return;
}   
    
    
    
    
    
    
    
    
    
    
function DbSelect($query, $params = null)
{
    global $db;
    $return = array();
    try 
    {
        $statement = $db->prepare($query);
        
        if (is_array($params))
        {
            foreach ($params as $key => $value)
            {
                $statement->bindValue($key, $value);
            }
        }
        
        $statement->Execute();
        
        while ($row = $statement->fetch())
        {
            $return[] = $row;
        }
    }
    catch (Exception $e)
    {
        echo "Database exception, try again later.";
        error_log($e);
        exit();
    }
    
    return $return;
}