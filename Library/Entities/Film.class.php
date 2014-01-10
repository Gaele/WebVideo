
<?php
namespace Library\Entities;

class Film extends \Library\Entity
{
  protected $titre,
            $description,
			$genre, 
			$acteurs = array(),
			$realisateurs = array(),
			$dateDeSortie,
			$langue,
			$duree,
			$prixLocation,
			$prixAchat;

	const TITRE_INVALIDE = 1;
    const DESCRIPTION_INVALIDE = 2;
	const GENRE_INVALIDE = 3;
	const ACTEURS_INVALIDE = 4;
    const REALISATEURS_INVALIDE = 5;
	const DATE_DE_SORTIE_INVALIDE = 6;
	const LANGUE_INVALIDE = 7;
    const DUREE_INVALIDE = 8;
	const PRIX_LOCATION_INVALIDE = 9;
	const PRIX_ACHAT_INVALIDE = 10;
  
  
  // SETTERS
  
  public function setTitre($titre)
  {
	if (!is_string($titre) || empty($titre))
	{
      $this->erreurs[] = self::TITRE_INVALIDE;		
	}
	else 
	{
		$this->titre = $titre;	
	}
  }
   
  public function setDescription($description)
  {
	if (!is_string($description) || empty($description))
	{
      $this->erreurs[] = self::DESCRIPTION_INVALIDE;		
	}
	else 
	{
		$this->description = $description;	
	}
  }
  
  public function setGenre($genre)
  {
	if (!is_string($genre) || empty($genre))
	{
      $this->erreurs[] = self::GENRE_INVALIDE;		
	}
	else 
	{
		$this->genre = $genre;	
	}
  }
  
  public function setActeurs(array $acteurs)
  {
//	if (!is_string($acteurs) || empty($acteurs))
//	{
//      $this->erreurs[] = self::ACTEURS_INVALIDE;		
//	}
//	else 
//	{
		$this->acteurs = $acteurs;	
//	}
  }
  
  public function setRealisateurs(array $realisateurs)
  {
//	if (!is_string($realisateurs) || empty($realisateurs))
//	{
//      $this->erreurs[] = self::REALISATEURS_INVALIDE;		
//	}
//	else 
//	{
		$this->realisateurs = $realisateurs;	
//	}
  }
  
  public function setDateDeSortie($dateDeSortie)
  {
	if (!is_string($dateDeSortie) || empty($dateDeSortie))
	{
      $this->erreurs[] = self::DATE_DE_SORTIE_INVALIDE;		
	}
	else 
	{
		$this->dateDeSortie = $dateDeSortie;	
	}
  }
  
  public function setLangue($langue)
  {
	if (!is_string($langue) || empty($langue))
	{
      $this->erreurs[] = self::LANGUE_INVALIDE;		
	}
	else 
	{
		$this->langue = $langue;	
	}
  }
  
  
  public function setDuree($duree)
  {
	if (!empty($duree) || (int)$duree <= 0)
	{
      $this->erreurs[] = self::DUREE_INVALIDE;		
	}
	else 
	{
		$this->duree = (int)$duree;	
	}
  }
  
  public function setPrixLocation($prixLocation)
  {
	if (!empty($prixLocation) || (int)$prixLocation <= 0)
	{
      $this->erreurs[] = self::DUREE_INVALIDE;		
	}
	else 
	{
		$this->prixLocation = (int)$prixLocation;	
	}
  }
  
  public function setPrixAchat($prixAchat)
  {
	if (!empty($prixAchat) || (int)$prixAchat <= 0)
	{
      $this->erreurs[] = self::DUREE_INVALIDE;		
	}
	else 
	{
		$this->prixAchat = (int)$prixAchat;	
	}
  }
  
  


  
  // GETTERS
  
  public function titre()
  {
    return $this->titre;
  }
  
  public function description()
  {
    return $this->description;
  }
  
  public function genre()
  {
    return $this->genre;
  }
  
  public function acteurs()
  {
    return $this->acteurs;
  }
  
  public function realisateurs()
  {
    return $this->realisateurs;
  }
  
  public function dateDeSortie()
  {
    return $this->dateDeSortie;
  }
  
  public function langue()
  {
    return $this->langue;
  }
  
  public function duree()
  {
    return $this->duree;
  }
  
  public function prixLocation()
  {
    return $this->prixLocation;
  }
  
  public function prixAchat()
  {
    return $this->prixAchat;
  }
  
  
  
  
  
  