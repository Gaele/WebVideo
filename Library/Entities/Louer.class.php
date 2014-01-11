<?php
namespace Library\Entities;

class Louer extends \Library\Entity
{
  protected $idClient,
            $idFilm,
			$dateFin;

	const CLIENT_INVALIDE = 1;
	const FILM_INVALIDE = 2;
	const DATE_INVALIDE = 3;
  
  // SETTERS
  
  public function setIdClient($id)
  {
	if (empty($id) || (int)$id <= 0)
	{
      $this->erreurs[] = self::CLIENT_INVALIDE;		
	}
	else 
	{
		$this->idClient = (int)$id;	
	}
  }
   
  public function setIdFilm($id)
  {
	if (empty($id) || (int)$id <= 0)
	{
      $this->erreurs[] = self::CLIENT_INVALIDE;		
	}
	else 
	{
		$this->idFilm = (int)$id;	
	}
  }
  
  public function setDateFin($date)
  {
	if (empty($date) || (int)$date <= 0)
	{
      $this->erreurs[] = self::DUREE_INVALIDE;		
	}
	else 
	{
		$this->dateFin = (int)$date;	
	}
  }
  
  // GETTERS
  
  public function idClient()
  {
    return $this->idClient;
  }
  
  public function idFilm()
  {
    return $this->idFilm;
  }
  
  public function dateFin()
  {
    return $this->dateFin;
  }
    
}

