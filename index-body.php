<body>
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  <header>
    <div id="webtitle"> <a href="index.php"><h1><strong>Reshad</strong> Farid</h1></a> </div>

<?php

$menu_items = new NavigationItem();
$menu_array = array("home", "about", "playground");

$menu_items->setMenuItem($menu_array);
$menu = new Navigation($menu_items, "navigation", "mainmenu");

echo $menu->display();

?>
    
  </header>
  <div class="container" role="main">
    <?php 
        // load the content
        $page = isset($_GET['page']) ? $_GET['page'] : "home.php";
        if( file_exists($page)) include($page);
        else include("404.html");
        
    ?>
  </div>