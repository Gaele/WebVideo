
<?php

class Film{
var $adresseXml;
var $fichierXml;

public function __construct($nom){
	$this->adresseXml = '/WebVideo/Xml/'. $nom;
	echo 'koko';
	echo ''. $this->adresseXml;
	//$temp = new DomDocument();
	 $this->fichierXml = $this->chargementXmlFile();
	//include 'IdManager.php';
        
}
public function chargementXmlFile()
    {
        $doc = new DomDocument();
        $doc->load($this->adresseXml);
        return $doc;
    }

public function ajoutFilm($titre,$annee, $description, $acteur, $realisateur)
    {
	$racine = $this->fichierXml->getElementsByTagName('movies');
        $movies = $racine->item(0);
        $movie = $this->fichierXml->createElement('movie', '');
        $title = $this->fichierXml->createElement('title', $titre);
        $dateDeSortie = $this->fichierXml->createElement('date', $annee);
        $describe = $this->fichierXml->createElement('description', $description);
	
	$actors = $this->fichierXml->createElement('actors','');
	$listeActeurs = explode(", ", $acteur);
	
	$i=0;
	while ($i<count($listeActeurs)){
		$actor = $this->fichierXml->createElement('actor', $listeActeurs[$i]);		
		$actors->appendChild($actor);		
		$i++;

	}	
	
	
	
	        

	$actor = $this->fichierXml->createElement('actor', $acteur);
        $director = $this->fichierXml->createElement('director', $realisateur);
         
        $movie->appendChild($title);
        $movie->appendChild($dateDeSortie);
        $movie->appendChild($describe);
        $movie->appendChild($actors);
        $movie->appendChild($director);
        
        $movies->appendChild($movie)->setAttribute('id', 'tt' . uniqid());
        $this->fichierXml->save($this->adresseXml);   
    }

public function SupprimerFilm($idFilm){
	$xpathRequete = new DomXpath($this->fichierXml);
	$query = '//movie[@id="'. $idFilm . '"]';
	$result = $xpathRequete->query($query);
	foreach ($result as $r) 
	{
    		$r->parentNode->removeChild($r);
	}
	$this->fichierXml->save($this->adresseXml); 
}

public function ModifierFilm($idFilm,$titre,$annee, $description, $acteur, $realisateur){
	$xpathRequete = new DomXpath($this->fichierXml);
	$query = '//movie[@id="'. $idFilm . '"]';
	$result = $xpathRequete->query($query);
	foreach ($result as $r) 
	{
    		$r->parentNode->removeChild($r);
	}
	$racine = $this->fichierXml->getElementsByTagName('movies');
        $movies = $racine->item(0);
        $movie = $this->fichierXml->createElement('movie', '');
        $title = $this->fichierXml->createElement('title', $titre);
        $dateDeSortie = $this->fichierXml->createElement('date', $annee);
        $describe = $this->fichierXml->createElement('description', $description);
	
	$actors = $this->fichierXml->createElement('actors','');
	$listeActeurs = explode(", ", $acteur);
	
	$i=0;
	while ($i<count($listeActeurs)){
		$actor = $this->fichierXml->createElement('actor', $listeActeurs[$i]);		
		$actors->appendChild($actor);		
		$i++;

	}	
	
	
	
	        

	$actor = $this->fichierXml->createElement('actor', $acteur);
        $director = $this->fichierXml->createElement('director', $realisateur);
         
        $movie->appendChild($title);
        $movie->appendChild($dateDeSortie);
        $movie->appendChild($describe);
        $movie->appendChild($actors);
        $movie->appendChild($director);
        
        $movies->appendChild($movie)->setAttribute('id',$idFilm);
        $this->fichierXml->save($this->adresseXml);   
	
	
}
}

$film = new Film('movies.xml');
//$film->ajoutFilm('nouredine','2003','jojo','acteur1, acteur2, momo','real');
//$film->SupprimerFilm("t52cff46ca1839");
$film->ModifierFilm("tt52d0067ed001b","1","2","3","4","4","4","4");
echo "</br> tt52d0067ed001b </br>";
?>


