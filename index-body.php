<body>
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  <header>
    <div id="webtitle"> <a href="index.html"><h1><strong>Reshad</strong> Farid</h1></a> </div>
    <nav role="navigation" class="navigation">
            <?php
            echo '
                   <ul>
                    '.$menu.'
                </ul>
            ';
            ?>
    </nav>
    
  </header>
  <div class="container" role="main">
    <?php 
        if (!isset($_GET['page'])) {
          $_GET['page'] = 'main.php';
          
        }
        switch ($_GET['page']){
          case 'main.php':
          case 'about.php':
          case 'portfolio.php':
          case 'tips.php':
            $file = $_GET['page'];
            break;
          default:
            $file = '404.html';
        }
        if(file_exists($file))
        {
          include_once $file;
        }
        else
        {
          include '404.html';
        }
        
    ?>
  </div>