<?php
namespace Library\Models;

use \Library\Entities\Film;

class FilmManager_PDO extends FilmManager
{

  public function getListOf($url)
  {
	$xml = simplexml_load_file($url);

	$films = array();
	foreach ($xml->movie as $mov) {
		$name = $mov->title;
		$summary = $mov->summary;
		$genre = "";
		foreach($mov->genres->genre as $g) {
			$genre .= $g." ";
		}
		$acteur = array();
		foreach($mov->actor as $a) {
			$acteur []= $a;
		}
		$directors = array;
		foreach($mov->directors->director as $d) {
			$directors[] = $d;
		}
		$date = $mov->date;
		$runtime = $mov->runtime;
		$language = $mov->language;
		$prixLocation = $mov->prixLocation;
		$prixAchat = $mov->prixAchat;

		$films[] = new \Library\Entities\Film(array(
        'titre' => $name,
        'description' => $summary,
		'genre' => $genre,
		'actors' => $actors,
		'realisateurs' => $directors,
		'dateDeSortie' => $date,
		'langue' => $language,
		'duree' => $runtime,
		'prixLocation' => $request->postData('prixLocation'),
		'prixAchat' => $request->postData('prixAchat')
      ));

$client = new \Library\Entities\Client(array(
        'pseudonyme' => $request->postData('pseudonyme'),
        'motDePasse' => $request->postData('motDePasse'),
		'montantCharge' => $request->postData('montantCharge'),
		'numeroCarteBanquaire' => $request->postData('numeroCarteBanquaire'),
		'dateExpiration' => $request->postData('dateExpiration'),
		'cleCarteBancaire' => $request->postData('cleCarteBancaire'),
		'mail' => $request->postData('mail'),
		'nomDuTitulaire' => $request->postData('nomDuTitulaire')
      ));
		
		echo "<p>Name: ".$name.", sum:".$summary."<br/>genre:".$genre.", dir:".$directors.", date:".$date.", time:".$runtime.", lang:".$language.", loc:".$prixLocation.", acht:".$prixAchat.", post:".$poster."</p><br/><br/>";
	}
  
  
    $q = $this->dao->prepare('SELECT id, pseudonyme, motDePasse, montantCharge, numeroCarteBanquaire, cleCarteBancaire, mail, nomDuTitulaire, dateInscription, dateExpiration FROM clients');
	
    $q->execute();
    
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Clients');
    
    $clients = $q->fetchAll();
    
    foreach ($clients as $client)
    {
      $client->setDate(new \DateTime($client->date()));
    }
    
    return $clients;
  }


  
}