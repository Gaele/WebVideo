<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
  <head>
    <title>
      <?php if (!isset($title)) { ?>
        Mon super site
      <?php } else { echo $title; } ?>
    </title>
    
    <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
    
    <link rel="stylesheet" href="Web/css/Envision.css?v=1" type="text/css" />
  </head>
  
  <body>
    <div id="wrap">
      <div id="header">
        <h1 id="logo-text"><a href="/WebVideo/">Geek un film</a></h1>
        <p id="slogan">Louez, achetez, offrez</p>
      </div>
      
      <div  id="menu">
        <ul>
		  <?php if ($user->isAdministrator()) { ?>
		  <li><a href="/WebVideo/admin/">Administration</a></li>
          <?php } else if ($user->isAuthenticated()) { ?>
		  <li><a href="/WebVideo/">Videos</a></li>
          <li><a href="/WebVideo/gestionCompte.html">Mon Compte</a></li>
          <li><a href="/WebVideo/cartesPrePayees.html">Offrir un film</a></li>
		  <li><a href="/WebVideo/deconnexion.html">Deconnexion</a></li>
          <?php } else { ?>
		  <li><a href="/WebVideo/inscription">Inscription</a></li>
		  <li><a href="/WebVideo/">Connexion</a></li>
		  <?php } ?>
        </ul>
      </div>
      
      <div id="content-wrap">
        <div id="main">
          <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
          
          <?php echo $content; ?>
        </div>
      </div>
      <div id="footer"></div>
    </div>
	
  </body>
</html>