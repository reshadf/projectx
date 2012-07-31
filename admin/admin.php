<?php  
session_start();
if(isset($_SESSION['username'])) {

$username = $_SESSION['username'];

if($_SERVER['REQUEST_METHOD']== 'POST'){
	
	if(isset($_POST['personal']))
	{
		try 
		{
		  $dbUpdate = new PDO('mysql:host=localhost;dbname=projectx', 'root', 'root');
		  $dbUpdate->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $stmtUpdate = $dbUpdate->prepare('  SELECT 
		                                member_id, username, password, gender, age, permission
		                            FROM  
		                                members
		                        	WHERE 
		                        		username = :username
		                        ');

		    $stmtUpdate->bindParam(':username', $username, PDO::PARAM_STR);

		    $stmtUpdate->execute();
		    
		    $formUpdate = '';
		    if($stmtUpdate === false)
		    {
		      $formUpdate = 'error 01';
		    }
		    else
		    {

		       while($row = $stmtUpdate->fetch(PDO::FETCH_ASSOC))
			      {
			      	$formUpdate .= '<form method="post" class="block">';
			        $formUpdate .= '<label>Member:</label> 16121992' . $row['member_id'] . '<br><br>';
			        $formUpdate .= '<label>Name:</label> <input type="text" value="' . $row['username'] . '"><br>';
			        $formUpdate .= '<label>Password:</label> <input type="password" value=""<br><br>';
			        $formUpdate .= '<label>Re-Typ Password:</label> <input type="password" value=""<br><br>';
			        $formUpdate .= '<input type="submit" name="change" value="change settings">';
			        $formUpdate .= '</form>';
			        
			      }

		    }
		    
		} 
		catch (PDOException $e) 
		{
		  $formUpdate = "Error:" . $e;
		}

		  $dbUpdate = NULL;
	}

	if(isset($_POST['change']))
	{
		try 
		{
		  $dbChange = new PDO('mysql:host=localhost;dbname=projectx', 'root', 'root');
		  $dbChange->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $stmtUpdateIt = $dbUpdate->prepare('  UPDATE 
		                                 members
		                            SET  
		                                username = , password = 

		                        	WHERE 
		                        		username = :username
		                        ');

		    $stmtUpdateIt->bindParam(':username', $username, PDO::PARAM_STR);

		    $stmtUpdateIt->execute();
		    
		    
		    if($stmtUpdateIt === false)
		    {
		      $updateMsg = 'error 01';
		    }
		    else
		    {
		    	$updateMsg = 'instellingen gewijzigd!'; 
		    }
		    
		} 
		catch (PDOException $e) 
		{
		  $formUpdate = "Error:" . $e;
		}

		  $dbUpdate = NULL;
	}

} // end request method post

 	try 
	{
	  $dbSet = new PDO('mysql:host=localhost;dbname=projectx', 'root', 'root');
	  $dbSet->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    $stmt = $dbSet->prepare('  SELECT 
	                                member_id, username, password, gender, age, permission
	                            FROM  
	                                members
	                        	WHERE 
	                        		username = :username
	                        ');

	    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

	    $stmt->execute();
	    
	    $msg = '';
	    if($stmt === false)
	    {
	      $msg = 'error 09';
	    }
	    else
	    {

	       while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		      {
		      	if($row['gender'] == 1)
			    {
			    	$row['gender'] = 'man';
			    }
			    else
			    {
			    	$row['gender'] = 'vrouw';
			    }

			    if($row['permission'] == 1)
			    {
			    	$row['permission'] = 'Admin';
			    }
			    if($row['permission'] == 2)
			    {
			    	$row['permission'] = 'Moderator';
			    }
			    if($row['permission'] == 3)
			    {
			    	$row['permission'] = 'News-Moderator';
			    }


		      	$msg .= '<section class="personalia">';
		        $msg .= '<label>Member:</label> 16121992' . $row['member_id'] . '<br>';
		        $msg .= '<label>Name:</label> ' . $row['username'] . ' | <a href="loguit.php">Log Uit</a><br/>';
		        $msg .= '<label>Gender:</label> ' . $row['gender'] . '<br>';
		        $msg .= '<label>Age:</label> ' . $row['age'] . '<br>';
		        $msg .= '<label>Permissions:</label> ' . $row['permission'] . '<br>';
		        $msg .= '</section>';
		      }

	    }
	    
	} 
	catch (PDOException $e) 
	{
	  $msg = "Error:" . $e;
	}

	  $dbSet = NULL;

?>
<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Admin Page</title>
  <link rel="stylesheet" href="style.css" type="text/css">
 </head>
 <body>
  <header>
 	
  </header>
  <div class="bodywrapper">
  <aside>
  	<h2>Admin Page</h2>

  	<h3>Personal</h3>
  	<hr>
  	<?php
 	echo $msg;

 	?>
 	<h3>Configuration</h3>
 	<hr>
 	<section class="managers">
 		<form method="post">
		 	<ul>
		 		<li><input type="submit" name="articles" value="Manage articles"></li>
		 		<li><input type="submit" name="personal" value="Personal"></li>
		 	</ul>
	 	</form>
 	</section>
  </aside>
  <section class="main" >
  		<?php
  			if(isset($formUpdate))
  			{
  				echo $formUpdate;
  			}
  		?>
  </section>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
 </div>
 </body>
</html>
<?php
}
//directe toegang blokkeren.
else {
	echo "direct access denied!! log correct in. <br/>";
	echo '<input type="button" value="Terug" onClick="history.go(-1);return true;">';   
	}
?>