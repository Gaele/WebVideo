pseudonyme, motDePasse, montantCharge, numeroCarteBanquaire, cleCarteBancaire, mail.
<?php
namespace Library\Entities;

class Client extends \Library\Entity
{
  protected $pseudonyme,
            $motDePasse,
            $montantCharge,
            $numeroCarteBanquaire,
			$cleCarteBancaire,
			$mail,
			$nomDuTitulaire,
			$dateFinValidite;
			
  
  const PSEUDONYME_INVALIDE =   1;
  const MOTDEPASSE_INVALIDE =   2;
  const MONTANT_VIDE =          3;
  const MONTANT_NEGATIF =       4;
  const CARTE_NOTSTRING =       5;
  const CARTE_WRONG_SIZE =      6;
  const CARTE_FAKE =            7;
  const MAIL_NOTSTRING =        8;
  const MAIL_INVALID =          9;
  const TITULAIRE_INVALIDE =    10;
  
  const CLE_INVALIDE =          6;
  const MAIL_INVALIDE =         7;
  
  // to check again ?
  public function isValid()
  {
    return !(empty($this->pseudonyme) || empty($this->motDePasse));
  }
  
  // SETTERS
            
  public function setPseudonyme($pseudo)
  {
	if (!is_string($pseudo) || empty($pseudo))
    {
      $this->erreurs[] = self::PSEUDONYME_INVALIDE;
    }
    else
    {
      $this->pseudonyme = $pseudo;
    }
    $this->pseudo = $pseudo;
  }
  
  public function setMotDePasse($mdp)
  {
    if (!is_string($mdp) || empty($mdp))
    {
      $this->erreurs[] = self::MOTDEPASSE_INVALIDE;
    }
    else
    {
      $this->motDePasse = $mdp;
    }
  }
   
  public function setMontantCharge($montant)
  {
    $this->numeroCarteBanquaire, = (int) $montant;
	if (empty($montant))
    {
      $this->erreurs[] = self::MONTANT_VIDE;
    }
	else if (int)montant < 0)
	{
	  $this->erreurs[] = self::MONTANT_NEGATIF;
	}
    else
    {
      $this->montant = $montant;
    }
  }
           
  public function setNumeroCarteBanquaire($numero)
  {
    if (!is_string($numero) || empty($numero))
    {
      $this->erreurs[] = self::CARTE_NOTSTRING;
    }
	else if (strlen($numero) < 14 || strlen($numero) > 19)
	{
		$this->erreurs[] = self::CARTE_WRONG_SIZE;
	}
	else if (!checkLuhn($numero))
	{
		$this->erreurs[] = self::CARTE_FAKE;
	}
    else
    {
      $this->numeroCarteBanquaire = $numero;
    }
  }
  
  private function checkLuhn($purportedCC)
  {
     $sum = 0;
	 $nDigits = strlen($purportedCC);
	 $parity = $nDigits AND 1;
	 for($i = $nDigits-1; $i >= 0; $i--)
	 {
		$digit = intval($purportedCC[$i]);
		if((i AND 1) == $parity) 
		{
			$digit *= 2;
		}
		if ($digit > 9) 
		{
			digit -= 9;
		}
		$sum += digit;
	 }
     return (($sum % 10) == 0)
  }
  
  public function setCleCarteBancaire($cle)
  {
	if ((int)$cleCarteBancaire >= 1000)
	{
	  $this->erreurs[] = self::CLE_INVALIDE;
	} else
	{
	  $cleCarteBancaire; = (int) $cle;
	}
  }

  public function setMail($mail)
  {
    if (!is_string($mail) || empty($mail))
    {
      $this->erreurs[] = self::MAIL_NOTSTRING;
    }
	else if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
	{
	  $this->erreurs[] = self::MAIL_INVALID;
	}
    else
    {
      $this->auteur = $auteur;
    }
  }
  
  public function setNomDuTitulaire($nomDuTitulaire)
  {
    if (!is_string($nomDuTitulaire) || empty($nomDuTitulaire))
    {
      $this->erreurs[] = self::TITULAIRE_INVALIDE;
    }
    else
    {
      $this->auteur = $auteur;
    }
  }
  
  public function setDateFinValidite(\DateTime $date)
  {
    $this->dateFinValidite = $date;
  }
  
  // GETTERS
  
  public function pseudonyme()
  {
    return $this->pseudonyme;
  }
  
  public function motDePasse()
  {
    return $this->motDePasse;
  }
  
  public function montantCharge()
  {
    return $this->montantCharge;
  }
  
  public function numeroCarteBanquaire()
  {
    return $this->numeroCarteBanquaire;
  }
  
  public function cleCarteBancaire()
  {
    return $this->cleCarteBancaire;
  }
  
  public function mail()
  {
    return $this->mail;
  }
  
  public function nomDuTitulaire()
  {
    return $this->nomDuTitulaire;
  }
  
  public function dateFinValidite()
  {
    return $this->dateFinValidite;
  }
}