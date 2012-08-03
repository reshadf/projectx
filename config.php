<?php

require 'loader.php';

$url = new Url();

$path = $url->getUrl();

if(strpos($path, 'localhost') || strpos($path, '127.0.0.1'))
{

	/*
	 * local gegevens
	 */

	$host = 'localhost';
	$database = 'projectx';
	$username = 'root';
	$password = 'root';

}
else
{
	/*
	 * extern gegevens
	 */

	$host = '85.17.24.74';
	$database = 'projectx';
	$username = 'reshad';
	$password = 'Playstation3';
}
?>