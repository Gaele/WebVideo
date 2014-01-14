<?php
namespace Xml;

use \Library\Entities\Film;
use \DomDocument;

class XmlLoader {

	/*
	 * Renvoit un arbre xml
	 * @return DomDocument
	 */
	public function ajoutTitre(array $films) {
		// require \DomDocument;
		$doc = new DomDocument();
        // $doc->load($url);
		
		// creation des noeuds
		$movies = $doc->createElement('movies', '');
		$doc->appendChild($movies);
		
		foreach($films as $film) {
			// pour tout film...
			$movie = $doc->createElement('movie', '');
			$movie->setAttribute('id', $film->id());
			$movies->appendChild($movie);
			
			
			// title
			$title = $doc->createElement('title', $film->titre());
			$movie->appendChild($title);
			
			// summary
			$summary = $doc->createElement('summary', $film->description());
			$movie->appendChild($summary);
			
			// genres
			$genres = $doc->createElement('genres', $film->genre());
			$movie->appendChild($genres);
			
			// acteurs
			$i=0;
			$listeActeurs = explode(",", $film->acteurs());
			while ($i<count($listeActeurs)){
				$actor = $doc->createElement('actor', $listeActeurs[$i]);		
				$movie->appendChild($actor);
				$i++;
			}
			
			// directors
			$directors = $doc->createElement('directors', '');
			$movie->appendChild($directors);
			$listeDirectors = explode(",", $film->realisateurs());
			$i=0;
			while ($i<count($listeDirectors)){
				$director = $doc->createElement('director', $listeDirectors[$i]);		
				$directors->appendChild($director);
				$i++;
			}
			
			// dateDeSortie
			$dateDeSortie = $doc->createElement('date', $film->dateDeSortie());
			$movie->appendChild($dateDeSortie);
			
			// runtime
			$runtime = $doc->createElement('runtime', $film->duree());
			$movie->appendChild($runtime);
			
			// language
			$language = $doc->createElement('language', $film->langue());
			$movie->appendChild($language);
			
			// prixLocation
			$prixLocation = $doc->createElement('prixLocation', $film->prixLocation());
			$movie->appendChild($prixLocation);
			
			// prixAchat
			$prixAchat = $doc->createElement('prixAchat', $film->prixAchat());
			$movie->appendChild($prixAchat);
		}
		//$doc->save("Xml/GeekAFilm2.xml");
		
		return $doc;
	}

}

?>

