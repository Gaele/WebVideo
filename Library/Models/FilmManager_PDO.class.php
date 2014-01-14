<?php
namespace Library\Models;

use \Library\Entities\Film;

class FilmManager_PDO extends FilmManager
{
  protected function add(Film $film)
  {
    $requete = $this->dao->prepare('INSERT INTO film SET titre = :titre, description = :description, genre = :genre, acteurs = :acteurs,
	realisateurs = :realisateurs, dateDeSortie = :dateDeSortie, langue = :langue, duree = :duree, prixLocation = :prixLocation, prixAchat = :prixAchat');
    
    $requete->bindValue(':titre', $film->titre());
    $requete->bindValue(':description', $film->description());
    $requete->bindValue(':genre', $film->genre());
    $requete->bindValue(':acteurs', $film->acteurs());
    $requete->bindValue(':realisateurs', $film->realisateurs());
    $requete->bindValue(':dateDeSortie', $film->dateDeSortie());
    $requete->bindValue(':langue', $film->langue());
    $requete->bindValue(':duree', $film->duree());
    $requete->bindValue(':prixLocation', $film->prixLocation());
    $requete->bindValue(':prixAchat', $film->prixAchat());
	
    $requete->execute();
  }

  public function getListOf(/*$debut, $limite*/)
  {
	/*if(!is_int($debut) || !is_int($limite)) {
		trigger_error('Erreur de chargement des page des l\'espace perso.', E_USER_WARNING);
		return;
	}*/
  
    $films = array();
	$q = $this->dao->prepare('SELECT id, titre, description, genre, acteurs, realisateurs, dateDeSortie, langue, duree, prixLocation, prixAchat FROM film'/* LIMIT :debut, :fin'*/);
    //$q->bindValue(':debut', $debut, \PDO::PARAM_INT);
	//$q->bindValue(':fin', $limite, \PDO::PARAM_INT);
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

  public function count()
  {
    return $this->dao->query('SELECT COUNT(*) FROM film')->fetchColumn();
  }
  
  protected function modify(Film $news)
  {
    $requete = $this->dao->prepare('UPDATE film SET titre = :titre, description = :description, genre = :genre,
	acteurs = :acteurs, realisateurs = :realisateurs, dateDeSortie = :dateDeSortie, langue = :langue, duree = :duree,
	prixLocation = :prixLocation, prixAchat = :prixAchat WHERE id = :id');
    
    $requete->bindValue(':titre', $news->titre());
    $requete->bindValue(':description', $news->description());
    $requete->bindValue(':genre', $news->genre());
	$requete->bindValue(':acteurs', $news->acteurs());
	$requete->bindValue(':realisateurs', $news->realisateurs());
	$requete->bindValue(':dateDeSortie', $news->dateDeSortie());
	$requete->bindValue(':langue', $news->langue());
	$requete->bindValue(':duree', (int)$news->duree(), \PDO::PARAM_INT);
	$requete->bindValue(':prixLocation', (int)$news->prixLocation(), \PDO::PARAM_INT);
	$requete->bindValue(':prixAchat', (int)$news->prixAchat(), \PDO::PARAM_INT);
    $requete->bindValue(':id', $news->id(), \PDO::PARAM_INT);
    
    $requete->execute();
  }
  
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM film WHERE id = '.(int) $id);
  }
  
}
