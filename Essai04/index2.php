<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
        <title>Title</title>
		<link rel="stylesheet" href="Web/css/Envision.css?v=1" type="text/css" />
</head>
<body>
	<div id="wrap">
		<div id="header">
			<h1 id="logo-text"><a href="/">Mon super site</a></h1>
			<p id="slogan">Comment ça « il n'y a presque rien » ?</p>
		</div>

		<div  id="menu">
			<ul>
				<li><a href="/">Accueil</a></li>
				<li><a href="/admin/">Admin</a></li>
				<li><a href="/admin/news-insert.html">Ajouter une news</a></li>
			</ul>
		</div>

		<div id="content-wrap">
			<div id="main">

	<form action="" method="post">
          <legend><h1>Je recherche</h1></legend>
  <p>
    <label>Prix Location <=</label>
    <input type="text" name="prixLocation" value="<?php if (isset($_POST['prixLocation'])) echo htmlspecialchars($_POST['prixLocation']); ?>" /><br />
    
    <label>Titre</label>
	<input type="text" name="titre" value="<?php if (isset($_POST['titre'])) echo htmlspecialchars($_POST['titre']); ?>" /><br />
    
	
    <!--<label>Style</label><input type="text" name="titre" value="<?php if (isset($news)) echo $news['titre']; ?>" /><br />-->
	
    <!-- <label>Contenu dans la description</label><textarea rows="8" cols="60" name="contenu"><?php if (isset($news)) echo $news['contenu']; ?></textarea><br />-->	
<?php
if(isset($news) && !$news->isNew())
{
?>
    <input type="hidden" name="id" value="<?php echo $news['id']; ?>" />
    <input type="submit" value="Modifier" name="modifier" />
<?php
}
else
{
?>
    <input type="submit" value="Chercher" />
<?php
}
?>
  </p>
</form>
			
<?php

# LOAD XML FILE 
$XML = new DOMDocument();
$XML->load( "GeekAFilm.xml" );
//$XML->load( "movies.xml" );
//movies

# START XSLT
$xslt = new XSLTProcessor();
$XSL = new DOMDocument();
$XSL->load( 'listeVideos4.xsl', LIBXML_NOCDATA);
//$XSL->load( 'style4.xsl', LIBXML_NOCDATA);
$xslt->importStylesheet( $XSL );

if(isset($_POST['prixLocation']) && is_numeric($_POST['prixLocation'])) {
	$prixLocation = (int)$_POST['prixLocation'];
} else {
	$prixLocation = "100";
}

if(isset($_POST['titre']) and $_POST['titre'] != "") {
	$titre = $_POST['titre'];
	// $all = 1;
} else {
	$titre = '';
	// $all = 0;
}

$xslt->setParameter('', 'pl', $prixLocation);
$xslt->setParameter('', 't', $titre);
//$xslt->setParameter('', 'a', $all);

#PRINT
$result = $xslt->transformToXML( $XML );
$avant = $result;

// $pos = explode("#", $result);
// $result = str_replace("PHP_PHP01", $pos[1], $result);

// <xsl:value-of select="$myVar">

// $proc = new XSLTProcessor();
//

echo $result;
?>
</div>
		</div>
		<div id="footer"></div>
	</div>
</body>
</html>
