<?php
namespace Library\Models;

use \Library\Entities\Louer;

class LouerManager_PDO extends LouerManager
{
 
  public function loue($idC, $idFilm) {
    $q = $this->dao->prepare('SELECT idClient, idFilm, dateFin FROM louer where idClient = :idClient AND idFilm = :idFilm');
	$q->bindValue(':idClient', (int)$idC, \PDO::PARAM_INT);
	$q->bindValue(':idFilm', (int)$idFilm, \PDO::PARAM_INT);
	$q->execute();
	
	$result = $q->fetch(\PDO::FETCH_ASSOC);
	if(!empty($result)) {
		$location = new Louer($result);
		if(strtotime($location->dateFin()) > strtotime('now')) {
			return $location;
		} else {
			// return delete $location
		}
	} else {
		return null;
	}
	
	if (($location = $q->fetch()) && strtotime($location->dateFin()) > strtotime('now'))
    {
      return $true;
    }
	return false;
  }
  // DATE_ADD(date, INTERVAL 15 DAY) AS date_expiration
  
  public function location($idC, $idFilm) {
	$q = $this->dao->prepare('INSERT INTO louer(idClient, idFilm, dateFin) VALUES(:client, :film, DATE_ADD(NOW(), INTERVAL 48 HOUR))');
	$q->bindValue(':client', (int)$idC, \PDO::PARAM_INT);
	$q->bindValue(':film', (int)$idFilm, \PDO::PARAM_INT);
	$q->execute();
  }
  
  public function rentedBy($idC) {
    $q = $this->dao->prepare('SELECT idClient, idFilm, dateFin FROM louer where idClient = :idClient');
	$q->bindValue(':idClient', (int)$idC, \PDO::PARAM_INT);
	$q->execute();
	
	$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Louer');
	
	$locs = $q->fetchAll();
	$locations = array();
    foreach ($locs as $location)
    {
		//$location = new Louer($loc);
		if (strtotime($location->dateFin()) > strtotime('now'))
		{
		  $locations[] = $location;
		}
		
	  // $client->setDate(new \DateTime($client->date()));
    }
    
    return $locations;
  }
  
}