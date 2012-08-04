<?php  
session_start();

ini_set('display_errors', 1); // 0 = uit, 1 = aan
error_reporting(E_ALL | E_STRICT);
if(isset($_SESSION['username'])) {

$username = $_SESSION['username'];

require 'config.php';

if($_SERVER['REQUEST_METHOD']== 'POST'){

	if(isset($_POST['wijzigart']))
	{
		try 
		{
		  $dbChange = new PDO('mysql:=$host;dbname=' . $database , $username, $password);
		  $dbChange->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $stmtUpdateIt = $dbChange->prepare('  UPDATE 
						                                articles
						                            SET  
						                                title = :title, content = :content, description = :description

						                        	WHERE 
						                        		id = :id
						                        ');

		    $stmtUpdateIt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
		    $stmtUpdateIt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
		    $stmtUpdateIt->bindParam(':content', $_POST['content'], PDO::PARAM_STR);
		    $stmtUpdateIt->bindParam(':description', $_POST['description'], PDO::PARAM_STR);

		    $stmtUpdateIt->execute();
		    
		    
		    if($stmtUpdateIt === false)
		    {
		      $updateMsg = 'error 01';
		    }
		    else
		    {
		    	$updateMsg = 'artikel gewijzigd!'; 
		    }
		    
		} 
		catch (PDOException $e) 
		{
		  $formUpdate = "Error:" . $e;
		}

		  $dbUpdate = NULL;	
	}
	
	if(isset($_POST['personal']))
	{
		try 
		{

		  $dbUpdate = new PDO('mysql:=$host;dbname=' . $database , $username, $password);

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
			        $formUpdate .= '<label>Name:</label> <input type="text" name="name" value="' . $row['username'] . '"><br>';
			        $formUpdate .= '<label>Password:</label> <input name="pass" type="password" value=""<br><br>';
			        $formUpdate .= '<label>Re-Typ Password:</label> <input name="repassword" type="password" value=""<br><br>';
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
		if(!$_POST['pass'] || trim($_POST['pass'] == '') || !$_POST['pass'] || trim($_POST['pass'] == '') )
		{
			$updateMsg = 'vul alle velden in';
		}
		else
		{
			if($_POST['pass'] === ($_POST['repassword']))
			{
				try 
				{

				  $dbChange = new PDO('mysql:=$host;dbname=' . $database , $username, $password);
				  $dbChange->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				    $stmtUpdateIt = $dbChange->prepare('  UPDATE 
								                                members
								                            SET  
								                                password = :password

								                        	WHERE 
								                        		username = :name
								                        ');

				    $stmtUpdateIt->bindParam(':name', $username, PDO::PARAM_STR);
				    $stmtUpdateIt->bindParam(':password', $_POST['pass'], PDO::PARAM_STR);

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
			else
			{
				$updateMsg = 'wachtwoord niet hetzelfde';
			}
		}
	}

	if(isset($_POST['articles']))
	{
		try 
		{
		  $dbUpdate = new PDO('mysql:=$host;dbname=' . $database , $username, $password);
		  $dbUpdate->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $stmtUpdate = $dbUpdate->prepare('  SELECT 
		                                id, title, content, description, thumbnail, data
		                            FROM  
		                                articles
		                        ');

		    $stmtUpdate->execute();
		    
		    $formUpdate = '';
		    if($stmtUpdate === false)
		    {
		      $formUpdate = 'error 08';
		    }
		    else
		    {
		    	$formUpdate .= '<section class="articles">';
			    $formUpdate .= '<table>';
			    $formUpdate .= '<tr>';
		      	$formUpdate .= '<td>';
		      	$formUpdate .= 'Datum';
		      	$formUpdate .= '</td>';
		      	$formUpdate .= '<td>';
		      	$formUpdate .= 'ID';
		      	$formUpdate .= '</td>';
		      	$formUpdate .= '<td>';
		      	$formUpdate .= 'Titel';
		      	$formUpdate .= '</td>';
		      	$formUpdate .= '</tr>';

		       while($row = $stmtUpdate->fetch(PDO::FETCH_ASSOC))
			      {
			      	$formUpdate .= '<tr>';
			      	$formUpdate .= '<td>';
			      	$formUpdate .= $row['data'];
			      	$formUpdate .= '</td>';
			      	$formUpdate .= '<td>';
			      	$formUpdate .= $row['id'];
			      	$formUpdate .= '</td>';
			      	$formUpdate .= '<td>';
			      	$formUpdate .= '<a href="?article_id=' . $row['id'] . '">' . $row['title'] . '</a>';
			      	$formUpdate .= '</td>';
			      	$formUpdate .= '</tr>';
			      }
			    $formUpdate .= '</table>';
			    $formUpdate .= '</section>';

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
	  $dbSet = new PDO('mysql:=$host;dbname=' . $database , $username, $password);
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

 	if(!isset($_GET['article_id']))
 	{
 	echo	'
 	<h3>Configuration</h3>
 	<hr>
		<section class="managers">
	 		<form method="post">
			 	<ul>
			 		<li><input type="submit" name="articles" value="Manage articles" href=" "></li>
			 		<li><input type="submit" name="personal" value="Personal" href=" "></li>
			 	</ul>
		 	</form>
	 	</section>';
 	}
 	?>
  </aside>
  <section class="main" >
  		<?php
  			if(isset($formUpdate))
  			{
  				echo $formUpdate;
  			}

  			if(isset($updateMsg))
  			{
  				echo $updateMsg;
  			}

  			if(isset($_GET['article_id']))
			{
			  try 
			  {
			    $dbContent = new PDO('mysql:=$host;dbname=' . $database , $username, $password);
			    $dbContent->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			      $stmtContent = $dbContent->prepare('  SELECT 
			                                                id, title, content, description, thumbnail, data
			                                            FROM  
			                                                articles
			                                            WHERE 
			                                                id = '.(int)($_GET['article_id']).'
			                                        ');

			      $stmtContent->execute();
			      

			      if($stmtContent === false)
			      {
			        $art = 'error 03';
			      }
			      else
			      {
			        $art = '';
			        $row = $stmtContent->fetchAll(PDO::FETCH_ASSOC);
			        {

			          foreach($row as $rows => $key)
			          {
			            $art .= '<article class="articles">';
			            $art .= '<form method="post">';
			            $art .= 'Geplaatst op:  <time>' . $key['data'] . '</time><br><br>';
			            $art .= 'ID <input name="id" type="text" value="' . $key['id'] . '" readonly>';
			            $art .= '<br><a href="admin.php">Terug</a>';
			            $art .= '<figure> <a href="#"><img src="../img/nofoto.gif" alt="Post thumbnail" class="thumbnail" /></a> </figure>';
			            $art .= 'Titel:  <input type="text" name="title" value="' . $key['title'] . '"<br><br><br>' ;
			            $art .= 'Beschrijving: <br><textarea name="description">' . $key['description'] . '</textarea><br><br>';
			            $art .= 'Content: <br><textarea name="content">' . $key['content'] . '</textarea>';
			            $art .= '<br><input type="submit" value="wijzig" name="wijzigart">';
			            $art .= '</form>';
			            $art .= '</article>';
			          }
			        }
			      }
			      
			  } 
			  catch (PDOException $e) 
			  {
			    $art = "Error:" . $e;
			  }

			    $dbContent = NULL;

			    if(isset($art))
			    {
			      echo htmlspecialchars_decode($art);
			    }
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