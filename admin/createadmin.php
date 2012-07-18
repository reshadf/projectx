<?php
include ("connect.php");

		$salt = "#@#123456789876548946234986$$23#423#%FAW%#AWD1314";	
		$pass = "password".$salt;


$sql = "INSERT INTO members(name, password)
        VALUES('name', '".sha1($pass)."')";

        $aanmaken = mysql_query($sql);

        if ($aanmaken === false){
        	echo mysql_error();

        }

        else {
        	echo "gelukt!";
        }
    
?>
