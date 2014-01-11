<?php
namespace Library\Models;

use \Library\Entities\Film;

class FilmManager_PDO extends FilmManager
{
  public function getListOf($debut, $limite)
  {
	if(!is_int($debut) || !is_int($limite)) {
		trigger_error('Erreur de chargement des page des l\'espace perso.', E_USER_WARNING);
		return;
	}
  
    $films = array();
	$q = $this->dao->prepare('SELECT id, titre, description, genre, acteurs, realisateurs, dateDeSortie, langue, duree, prixLocation, prixAchat FROM film LIMIT :debut, :fin');
    $q->bindValue(':debut', $debut, \PDO::PARAM_INT);
	$q->bindValue(':fin', $limite, \PDO::PARAM_INT);
	$q->execute();
	
	while($donnees = $q->fetch(\PDO::FETCH_ASSOC)) {
		$films[] = new Film($donnees);
	}
	$q->closeCursor();
	  
    return $films;
  }

    public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, titre, description, genre, acteurs, realisateurs, dateDeSortie, langue, duree, prixLocation, prixAchat FROM film WHERE id = :id');
	$requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Film');
    
	if ($film = $requete->fetch())
    {
      return $film;
    }
	
    return null;
  }

  
  
}