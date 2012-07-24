<?php

if(!isset($_GET['id']))
{
    
    if (isset($msg))
    {

      $mailErrors = array();

      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {

          if(!isset($_POST['name']) || trim($_POST['name']) == '')
          {
            $mailErrors[] = 'vul uw naam in s.v.p';
          }

          if(!isset($_POST['email']) || trim($_POST['email']) == '')
          {
            $mailErrors[] = 'vul een email in s.v.p';
          }

          if(!isset($_POST['message']) || trim($_POST['message']) == '')
          {
            $mailErrors[] = 'vul een bericht in s.v.p';
          }

          $mailerr = '';
          if( count($mailErrors) > 0 )
             {
                $err = '';
                $err .= '<section class="main"><br>';
                foreach ($mailErrors as $error) {
                  $err .=  $error . '<br>';
                }
                $err .= '<a href="index.php" class="read-more">opnieuw</a>';
                $err .= '</section>';

                echo $err;
             }
          
          else
          {
            $website_naam = 'reshadfarid.nl';
            // Jouw eigen geldige emailadres
            $eigen_emailadres = 'info@reshadfarid.nl';
            // Een geldig emailadres voor errors
            $error_emailadres = 'reshadfar@gmail.com';
            // De naam van de verzender
            $naam_verzender = 'afzender';
            // Het geldige emailadres van de afzender
            $email_verzender = $_POST['email'];
            // Een geldig emailadres of helemaal leeg laten
            $bcc_emailadres = '';
            // HTML mail? True/False
            $html = true;

            $to      = 'reshadfar@gmail.com';
            $subject = 'contactform reshadfarid.nl';
            $message = 'Bericht: ' . $_POST['message'] . "\r\n";
            $headers   = 'From: ' . $website_naam . ' <' . $eigen_emailadres . '>' . PHP_EOL;
            $headers  .= 'Reply-To: ' . $naam_verzender . ' <' . $email_verzender . '>' . PHP_EOL;
            $headers  .= 'Return-Path: Mail-Error <' . $error_emailadres . '>' . PHP_EOL;
            $headers  .= ($bcc_emailadres != '') ? 'Bcc: ' . $bcc_emailadres . PHP_EOL : '';
            $headers  .= 'X-Mailer: PHP/' . phpversion() . PHP_EOL;
            $headers  .= 'X-Priority: Normal' . PHP_EOL;
            $headers  .= ($html) ? 'MIME-Version: 1.0' . PHP_EOL : '';
            $headers  .= ($html) ? 'Content-type: text/html; charset=iso-8859-1' . PHP_EOL : '';

            mail($to, $subject, $message, $headers);

            $succeed = '';
            $succeed .= '<section class="main">';
            $succeed .= 'mail succesvol verstuurd';
            $succeed .= '<a href="index.php" class="read-more">Ga verder</a>';
            $succeed .= '</section>';

            echo $succeed;
          }
      }
      else
      { 
             ?>
                    <section class="main">
                  <form action="" method="post"> 
                    
                    <fieldset id="user-details">  
                      
                      <label for="name">Naam:</label>
                      <input type="text" name="name" value="" placeholder="Vul uw naam in" > 
                    
                      <label for="email">Email:</label> 
                      <input type="email" name="email" value=""  placeholder="Vul uw email adress in"/> 
                    
                    </fieldset>
                    
                    <fieldset id="user-message">
                    
                      <label for="message">Uw bericht:</label> 
                      <textarea name="message" rows="0" cols="0" placeholder="Vul hier uw bericht in"></textarea> 
                    
                      <input type="submit" value="Verzenden" name="submit" class="submit" />   
                    
                    </fieldset>
                     
                  </form>
                </section>     
              <?php
      }

        echo htmlspecialchars_decode($msg);
    }
}

else
{

try 
{
  $dbContent = new PDO('mysql:host=localhost;dbname=projectx', 'root', 'root');
  $dbContent->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmtContent = $dbContent->prepare('  SELECT 
                                              id, title, content, description, thumbnail, data
                                          FROM  
                                              articles
                                          WHERE 
                                              id = '.mysql_real_escape_string($_GET['id']).'
                                      ');

    $stmtContent->execute();
    

    if($stmtContent === false)
    {
      $msg = 'error 03';
    }
    else
    {
      $msg = '';
      $row = $stmtContent->fetchAll(PDO::FETCH_ASSOC);
      {

        foreach($row as $rows => $key)
        {
          $msg .= '<article class="content">';
          $msg .= '<figure> <a href="#"><img src="img/nofoto.gif" alt="Post thumbnail" class="thumbnail alignleft" /></a> </figure>';
          $msg .=  '<h2>' . $key['title'] . '</h2><time datetime=' . $key['data'] . '>' . $key['data'] . '</time>' ;
          $msg .= '<p>' . $key['content'] . '</p>';
          $msg .= '<a class="read-less" href="index.php">Terug</a>';
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

  $dbContent = NULL;

  if(isset($msg))
  {
    echo htmlspecialchars_decode($msg);
  }   
}

?>