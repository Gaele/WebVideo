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

  /*
	public function formatedYear() {
		if(date('Y-m-d H:i:s', strtotime($this->dateFin)) == $this->dateFin) { // La date est dans le bon format
			$DateAFormater = explode(' ', $this->dateFin()); // contient {'AAAA-MM-JJ', 'HH-II-SS'}
			$calendar = explode('-', $DateAFormater[0]); // contient {'AAAA', 'MM', 'JJ'}
			$clock = explode(':', $DateAFormater[1]); // contient {'HH', 'II', 'SS'}
			
			// return 'Le '.
			return $calendar[0].'/'.$calendar[1].'/'.$calendar[0].' a '.$clock[0].'h'.$clock[1].'min'.$clock[2].'s';
		} else { // La date n'a pas le bon format
			echo 'erreur : date incorrecte';
			echo $this->dateFin;
			echo '<br/>';
			return null;
		}
	}
	*/
  
}

