<?php
$server = "localhost"; 
$gebruiker = "root"; 
$wachtwoord = "root"; 
$db = "portfolio"; 

$connectie = mysql_connect($server,$gebruiker,$wachtwoord) 
or die ("Kon niet connecten met de server"); 
mysql_select_db($db,$connectie) 
or die ("Kon de database niet selecteren"); 
?>