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
			$dateInscription,
			$dateExpiration;
			
  
  const PSEUDONYME_INVALIDE =      1;
  const MOTDEPASSE_INVALIDE =      2;
  const MONTANT_VIDE =             3;
  const MONTANT_NEGATIF =          4;
  const CARTE_NOTDIGITSTRING =     5;
  const CARTE_WRONG_SIZE =         6;
  const CARTE_FAKE =               7;
  const CLE_INVALIDE =             8;
  const CLE_ABSCENTE =             9;
  const MAIL_NOTSTRING =           10;
  const MAIL_INVALID =             11;
  const TITULAIRE_INVALIDE =       12;
  const DATE_EXPIRATION_ABSURDE =  13;
  
  public function isValid()
  {
    return !(empty($this->pseudonyme) || empty($this->motDePasse) || empty($this->montantCharge) || empty($this->numeroCarteBanquaire) ||
	empty($this->cleCarteBancaire) || empty($this->mail)|| empty($this->nomDuTitulaire) || empty($this->dateExpiration));
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
    $this->numeroCarteBanquaire = (int) $montant;
	if (empty($montant))
    {
      $this->erreurs[] = self::MONTANT_VIDE;
    }
	else if ((int)$montant < 0)
	{
	  $this->erreurs[] = self::MONTANT_NEGATIF;
	}
    else
    {
      $this->montantCharge = $montant;
    }
  }
           
  public function setNumeroCarteBanquaire($numero)
  {
    if (!is_string($numero) || empty($numero) || !ctype_digit($numero))
    {
      $this->erreurs[] = self::CARTE_NOTDIGITSTRING;
    }
	else if (strlen($numero) < 14 || strlen($numero) > 19)
	{
		$this->erreurs[] = self::CARTE_WRONG_SIZE;
	}
//	else if (!$this->checkLuhn($numero))
//	{
//		$this->erreurs[] = self::CARTE_FAKE;
//	}
    else
    {
      $this->numeroCarteBanquaire = $numero;
    }
  }
  
  // American Express : 3111-1111-1111-1117
  // Visa : 4111-1111-1111-1111
  // MasterCard : 5111-1111-1111-1118
  // Découvrir : 6111-1111-1111-1116
  private function checkLuhn($purportedCC)
  {
     $sum = 0;
	 $nDigits = strlen($purportedCC);
	 $parity = $nDigits AND 1;
	 for($i = $nDigits-1; $i >= 0; $i--)
	 {
		$digit = intval($purportedCC[$i]);
		if(($i AND 1) == $parity) 
		{
			$digit *= 2;
		}
		if ($digit > 9) 
		{
			$digit -= 9;
		}
		$sum += $digit;
	 }
     return (($sum % 10) == 0);
  }
  
  public function setCleCarteBancaire($cle)
  {
	if (empty($cle))
	{
	  $this->erreurs[] = self::CLE_ABSCENTE;
	}
	else if ((int)$cle >= 1000)
	{
	  $this->erreurs[] = self::CLE_INVALIDE;
	} else
	{
	  $this->cleCarteBancaire = (int) $cle;
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
      $this->mail = $mail;
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
      $this->nomDuTitulaire = $nomDuTitulaire;
    }
  }
  
  public function setDateInscription($date)
  {
    $this->dateInscription = $date;
  }
  
  public function setDateExpiration($date)
  {
    //if( strtotime($date) <= strtotime('now') )
	//{
    //  $this->erreurs[] = self::DATE_EXPIRATION_ABSURDE;
	//}
	//else
	//{
      $this->dateExpiration = $date;
	//}
  }
  
  // GETTERS
  
  public function pseudonyme()
  {
    return htmlspecialchars($this->pseudonyme);
  }
  
  public function motDePasse()
  {
    return htmlspecialchars($this->motDePasse);
  }
  
  public function montantCharge()
  {
    return (int)$this->montantCharge;
  }
  
  public function numeroCarteBanquaire()
  {
    return htmlspecialchars($this->numeroCarteBanquaire);
  }
  
  public function cleCarteBancaire()
  {
    return (int)$this->cleCarteBancaire;
  }
  
  public function mail()
  {
    return htmlspecialchars($this->mail);
  }
  
  public function nomDuTitulaire()
  {
    return htmlspecialchars($this->nomDuTitulaire);
  }
  
  public function dateInscription()
  {
    return htmlspecialchars($this->dateInscription);
  }
  
  public function dateExpiration()
  {
    return htmlspecialchars($this->dateExpiration);
  }
  
  public function debug() {
	echo "Pseudonyme: ".$this->pseudonyme."<br/>".
         "PassWd: ".$this->motDePasse."<br/>".
         "MontantCharge: ".$this->montantCharge."<br/>".
         "numeroCarte: ".$this->numeroCarteBanquaire."<br/>".
		 "cleCarte: ".$this->cleCarteBancaire."<br/>".
		"mail: ".$this->mail."<br/>".
		"Nom Titulaire: ".$this->nomDuTitulaire."<br/>".
		"date Inscription: ".$this->dateInscription."<br/>".
		"date Expiration: ".$this->dateExpiration."<br/>";
  }
}