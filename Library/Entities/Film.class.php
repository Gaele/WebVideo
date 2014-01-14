<?php
namespace Library\Entities;

class Film extends \Library\Entity
{
  protected $titre,
            $description,
			$genre, 
			$acteurs,
			$realisateurs,
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
  
  
  public function isValid()
  {
    return !(empty($this->titre) || empty($this->description) || empty($this->genre) || empty($this->acteurs) ||
	empty($this->realisateurs) || empty($this->dateDeSortie)|| empty($this->langue) || empty($this->duree) || empty($this->prixLocation) || empty($this->prixAchat));
  }
  
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
  
  public function setActeurs($acteurs)
  {
	if (!is_string($acteurs) || empty($acteurs))
	{
      $this->erreurs[] = self::ACTEURS_INVALIDE;		
	}
	else 
	{
		$this->acteurs = $acteurs;	
	}
  }
  
  public function setRealisateurs($realisateurs)
  {
	if (!is_string($realisateurs) || empty($realisateurs))
	{
      $this->erreurs[] = self::REALISATEURS_INVALIDE;		
	}
	else 
	{
		$this->realisateurs = $realisateurs;	
	}
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
  
  
  public function setDuree($d)
  {
	if (empty($d) || (int)$d <= 0)
	{
      $this->erreurs[] = self::DUREE_INVALIDE;		
	  
	}
	else 
	{
		$this->duree = (int)$d;	
	}
  }
  
  public function setPrixLocation($prixLocation)
  {
	if (empty($prixLocation) || (int)$prixLocation <= 0)
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
	if (empty($prixAchat) || (int)$prixAchat <= 0)
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
  
  public function titreAvecBarres()
  {
    $titreAvecBarres = $this->titre;
	str_replace(" ", "_", $this->titreAvecBarres);
	return $titreAvecBarres;
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
  
  // retourne la date formatee pour les humains (le ... a ...)
		
		
		public function formatedYear() {
			if(date('Y-m-d H:i:s', strtotime($this->dateDeSortie)) == $this->dateDeSortie) { // La date est dans le bon format
				$DateAFormater = explode(' ', $this->dateDeSortie()); // contient {'AAAA-MM-JJ', 'HH-II-SS'}
				$calendar = explode('-', $DateAFormater[0]); // contient {'AAAA', 'MM', 'JJ'}
				$clock = explode(':', $DateAFormater[1]); // contient {'HH', 'II', 'SS'}
				
				// return 'Le '.
				return $calendar[0];//.'/'.$calendar[1].'/'.$calendar[0];//.' a '.$clock[0].'h'.$clock[1].'min'.$clock[2].'s';
			} else { // La date n'a pas le bon format
				echo 'erreur : date incorrecte';
				echo $this->dateDeSortie;
				echo '<br/>';
				return null;
			}
		}
		
		public function formatedYearAndMonth() {
			if(date('Y-m-d H:i:s', strtotime($this->dateDeSortie)) == $this->dateDeSortie) { // La date est dans le bon format
				$DateAFormater = explode(' ', $this->dateDeSortie()); // contient {'AAAA-MM-JJ', 'HH-II-SS'}
				$calendar = explode('-', $DateAFormater[0]); // contient {'AAAA', 'MM', 'JJ'}
				$clock = explode(':', $DateAFormater[1]); // contient {'HH', 'II', 'SS'}
				
				// return 'Le '.
				return $calendar[1].'/'.$calendar[0];//.'/'.$calendar[0];//.' a '.$clock[0].'h'.$clock[1].'min'.$clock[2].'s';
			} else { // La date n'a pas le bon format
				echo 'erreur : date incorrecte';
				echo $this->dateDeSortie;
				echo '<br/>';
				return null;
			}
		}
  
}