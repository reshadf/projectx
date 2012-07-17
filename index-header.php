<?php
/*
 * Session start
 */
session_start();

/*
 * Error reportin 1 is aan 0 is uit
 */
ini_set('display_errors', 1); // 0 = uit, 1 = aan
error_reporting(E_ALL | E_STRICT);

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
 *  Menu block
 */
    $menu = '';
if (file_exists("index.ini") && is_array($content = parse_ini_file("index.ini", true)))
{
    if (array_key_exists("navigation", $content))
    {
        foreach ($content["navigation"] as $basename => $title)
        {       
            if(isset($_GET['page']) and $_GET['page'] == $basename)

            {
                $class = 'current';
            }
            else
            {
                $class = '';
            }
                $menu .= '<li><a class="' . $class . '" href="index.php?page=' . $basename . '">' . $title . '</a></li>';
        }
    }
}

  /*
   * get Content blocks
   */

  try 
{
  $db = new PDO('mysql:host=localhost;dbname=projectx', 'root', 'root');
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare('  SELECT 
                                id, title, content, description, thumbnail, data
                            FROM  
                                articles
                            ORDER BY 
                                data
                        ');

    $stmt->execute();
    

    if($stmt === false)
    {
      $msg = 'error 03';
    }
    else
    {
      $msg = '';
      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      {
        foreach($row as $rows => $key)
        {
          $msg .= '<article class="contentblock">';
          $msg .= '<figure> <a href="#"><img src="img/nofoto.gif" alt="Post thumbnail" class="thumbnail alignleft" /></a> </figure>';
          $msg .=  '<h2>' . $key['title'] . '</h2><time datetime=' . $key['data'] . '>' . $key['data'] . '</time>' ;
          $msg .= '<p>' . $key['description'] . '</p>';
          $msg .= '<a class="read-more" href="?id='. (int) ($key['id']) .'">lees verder</a>';
          $msg .= '</article>';
          $msg = preg_replace("#(^|[ \n\r\t])www.([a-z\-0-9]+).([a-z]{2,4})($|[ \n\r\t])#mi", "\\1<a href=\"http://www.\\2.\\3\" target=\"_blank\">www.\\2.\\3</a>\\4", $msg);
          $msg = preg_replace("#(^|[ \n\r\t])(((ftp://)|(http://)|(https://))([a-z0-9\-\.,\?!%\*_\#:;~\\&$@\/=\+]+))#mi", "\\1<a href=\"\\2\" target=\"_blank\">\\2</a>", $msg); 

        }

      }

    }
    
} 
catch (PDOException $e) 
{
  $msg = "Error:" . $e;
}

  $db = NULL;
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="nl"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>
<?php 
if(isset($_GET['page']))
  {
    switch($_GET['page']){

                case '1':
                print "Home | Reshad Farid Portfolio";
                break;

                case '2':
                print "About | Reshad Farid Portfolio";
                break;

                case '3':
                print "Portfolio | Reshad Farid Portfolio";
                break;

                case '4':
                print "Tips and Tricks | Reshad Farid Portfolio";
                break;

                default:
                print "Home | Reshad Farid Portfolio";
                break;
                }
  }
  else
  {
    echo 'Articel...';
  }
?>
</title>
  <meta name="description" content="">

  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/design.css">

  <script src="js/libs/modernizr-2.5.3.min.js"></script>
</head>