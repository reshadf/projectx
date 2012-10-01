<?php

/*
 * Loader
 */

function my_autoloader($className) 
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

spl_autoload_register('my_autoloader');

?>