<?php
/*
 * Session start
 */
session_start();

/*
 * Error reportin 1 is aan 0 is uit
 */
ini_set('display_errors', 1); 
error_reporting(E_ALL | E_STRICT);

require 'config.php';

  /*
   * get Content blocks
   */

try 
{
  $db = new PDO('mysql:=$host;dbname=' . $database , $username, $password);
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
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="nl"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="nl"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="nl"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="nl"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>
<?php 
   
if (file_exists("index.ini") && is_array($title = parse_ini_file("index.ini", true)))
{
    if (array_key_exists("title", $title))
    {
        foreach ($title["title"] as $basename => $title)
        {       
            if(isset($_GET['page']) and $_GET['page'] == $basename)
            {
              echo $title;
            }
        }
    }

    else
    {
      echo 'Reshad Farid';
    }
}
?>
</title>
  <meta name="description" content="De persoonlijke website van Reshad Farid. Kom alles te weten over zijn programmeer skills zijn projecten en veel meer coole dingen!">

  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/design.css">

  <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.5.3/modernizr.min.js" type="text/javascript"></script>

<!-- Begin Cookie Consent plugin by Silktide - http://silktide.com/cookieconsent -->
<link rel="stylesheet" type="text/css" href="css/cookiebar.css"/>
<script type="text/javascript" src="http://assets.cookieconsent.silktide.com/1.0.8/plugin.min.js"></script>
<script type="text/javascript">
// <![CDATA[
cc.initialise({
  cookies: {
    analytics: {
                title: 'Analytics',
      description: 'Analyics is een cookie wat wij plaatsen om aan de hand van uw gedrag op onze website '+
        ''
            }
  },
  settings: {
                consenttype: "explicit", /* explicit voor opt-in en "implicit voor opt-out" */
    tagPosition: "vertical-left",
    refreshOnConsent: true,
    disableallsites: true,
    hideallsitesbutton: true,
                bannerPosition: "top"
  },
        strings: {
        notificationTitle: 'Om u een goede beleving van de website te geven moeten wij cookies plaatsen',
        notificationTitleImplicit: 'Wij gebruiken cookies om u een prettig bezoek te bezorgen',
        customCookie: 'Speciale cookies',
        seeDetails: 'Meer informatie',
        seeDetailsImplicit: 'Verander instellingen',
        hideDetails: 'Verberg informatie',
        allowCookies: 'Toestaan',
        allowForAllSites: 'Overal Toestaan',
        savePreference: 'Opslaan',
        saveForAllSites: 'Overal Opslaan',
        privacySettings: 'Cookie instellingen',
        privacySettingsDialogTitleA: 'Cookie instellingen',
        privacySettingsDialogTitleB: 'voor deze website',
        privacySettingsDialogSubtitle: 'Sommige dingen op deze website hebben uw toestemming nodig om goed te werken',
        changeForAllSitesLink: 'Verander instellingen voor alle sites',
        preferenceUseGlobal: 'Gebruik algemene instellingen',
        preferenceConsent: 'Toestaan',
        preferenceDecline: 'Verbieden',
        notUsingCookies: 'Deze website gebruikt geen cookies',
        allSitesSettingsDialogTitleA: 'Cookie instellingen',
        allSitesSettingsDialogTitleB: 'voor alle websites',
        allSitesSettingsDialogSubtitle: 'Je geeft nu toestemming aan elke site met dezelfde bar.',
        backToSiteSettings: 'Terug naar website instellingen',
        preferenceAsk: 'Vraag het me altijd',
        preferenceAlways: 'Altijd toestaan',
        preferenceNever: 'Altijd verbieden',
                        allowCookiesImplicit: 'sluiten',
                        closeWindow: 'Sluit venster'
      }
});
// ]]>
</script>


</head>