<?php

# LOAD XML FILE 
$XML = new DOMDocument();
$XML->load( "GeekAFilm.xml" );
//$XML->load( "movies.xml" );
//movies

# START XSLT
$xslt = new XSLTProcessor();
$XSL = new DOMDocument();
$XSL->load( 'listeVideos2.xsl', LIBXML_NOCDATA);
//$XSL->load( 'style4.xsl', LIBXML_NOCDATA);
$xslt->importStylesheet( $XSL );
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