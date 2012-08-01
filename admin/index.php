<?php
session_start();
ini_set('display_errors', 0); // 0 = uit, 1 = aan
error_reporting(E_ALL);

/*
 * AutoLoader 
 */ 

function __autoload($className) 
  {
    // haal de base dir op.
      $base = dirname(__FILE__);
      
      // het pad ophalen
      $path = $className;

      // alle paden samenvoegen tot waar ik zijn moet en de phpfile eraan plakken.
      $file = $base . "/lib/" . $path . '.php';       
      
      // als file bestaat haal op anders error
      if (file_exists($file)) 
      {
          require $file;      
      }
      else 
      {
          error_log('Class "' . $className . '" could not be autoloaded');
          throw new Exception('Class "' . $className . '" could not be autoloaded from: ' . $file); 
      }
  }

  /*
   * login query
   */
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$naam = $_POST['username'];
  	$wachtwoord = $_POST['password'];

  	try 
	{
	  $db = new PDO('mysql:host=localhost;dbname=projectx', 'root', 'root');
	  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    $stmt = $db->prepare('  SELECT 
	                                member_id, username, password, gender, age, permission
	                            FROM  
	                                members
	                        	WHERE 
	                        		username = :username
	                        	AND
	                        		password = :password
	                        ');

	    $stmt->bindParam(':username', $naam, PDO::PARAM_STR);
	    $stmt->bindParam(':password', $wachtwoord, PDO::PARAM_STR);

	    $stmt->execute();

	    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	    
	    $msg = '';
	    if($stmt === false)
	    {
	      $msg = 'error 07';
	    }
	    else
	    {
	       if($stmt->rowCount() == 0)
	        {
	            throw new PDOException('Er zijn geen rijen gevonden waar de naam ' . $naam . ' in voor komt');
	        }
	        else
	        {
	        	$_SESSION['username'] = $_POST['username'];
	        	header("location: " . basename('admin.php'));
	        }

	    }
	    
	} 
	catch (PDOException $e) 
	{
	  $msg = "Error:" . $e;
	}

	  $db = NULL;
  }

?>


<!DOCTYPE html>
<!--[if lte IE 6]><html class="preIE7 preIE8 preIE9"><![endif]-->
<!--[if IE 7]><html class="preIE8 preIE9"><![endif]-->
<!--[if IE 8]><html class="preIE9"><![endif]-->
<!--[if gte IE 9]><!--><html><!--<![endif]-->
 <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Login Page</title>
  <link rel="stylesheet" href="stylesheet.css" type="text/css">
 </head>
 <body>
<?php

	$loginForm = new formhandler();

	$loginForm->textField("Naam", "username", FH_STRING);
	$loginForm->passField("Wachtwoord", "password", FH_PASSWORD);
	$loginForm->submitButton("Inloggen");

	$loginForm->flush();

	if(isset($msg))
	{
		echo $msg;
	}


?>
  
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
 </body>
</html>