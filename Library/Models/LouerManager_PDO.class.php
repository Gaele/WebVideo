<?php
namespace Library\Models;

use \Library\Entities\Louer;

class LouerManager_PDO extends LouerManager
{
 
  public function loue($idC, $idFilm) {
    $q = $this->dao->prepare('SELECT dateFin FROM louer where idClient = :idClient AND idFilm = :idFilm');
	$q->bindValue(':idClient', (int)$idC, \PDO::PARAM_INT);
	$q->bindValue(':idFilm', (int)$idFilm, \PDO::PARAM_INT);
	$q->execute();
	
	if ($location = $q->fetch() && strtotime($location->dateFin()) > strtotime('now'))
    {
      return $true;
    }
	return false;
  }  
  
}