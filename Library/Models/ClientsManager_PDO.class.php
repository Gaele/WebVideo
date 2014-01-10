<?php
namespace Library\Models;

use \Library\Entities\Client;

class ClientsManager_PDO extends ClientsManager
{

  protected function add(Client $client)
  {
    $q = $this->dao->prepare('INSERT INTO clients SET pseudonyme = :pseudo, motDePasse = :mdp, montantCharge = :montant, numeroCarteBanquaire = :numeroCarte, 
	cleCarteBancaire = :cle, mail = :mail, nomDuTitulaire = :nomTitulaire, dateExpiration = :dateExpiration, dateInscription = NOW()');
    
    $q->bindValue(':pseudo', $client->pseudonyme());
    $q->bindValue(':mdp', $client->motDePasse());
	$q->bindValue(':montant', $client->montantCharge(), \PDO::PARAM_INT);
	$q->bindValue(':numeroCarte', $client->numeroCarteBanquaire());
	$q->bindValue(':cle', $client->cleCarteBancaire(), \PDO::PARAM_INT);
	$q->bindValue(':mail', $client->mail());
	$q->bindValue(':nomTitulaire', $client->nomDuTitulaire());
	$q->bindValue(':dateExpiration', $client->dateExpiration(), \PDO::PARAM_STR);
	
    $q->execute();
    
    $client->setId($this->dao->lastInsertId());
  }
  
  /**
   * tell if the pseudonyme is already taken
   * @param $pseudo the pseudonyme to check
   * @return true if the pseudonyme is not used, false otherwise
   */
  public function isPseudoTaken($pseudo) {
	$q = $this->dao->prepare('SELECT COUNT(*) FROM clients where pseudonyme = :pseudo');
	$q->bindValue(':pseudo', $pseudo);
	$q->execute();
	return $q->fetchColumn() != 0;
  }
  
  public function getListOf()
  {
    $q = $this->dao->prepare('SELECT id, pseudonyme, motDePasse, montantCharge, numeroCarteBanquaire, cleCarteBancaire, mail, nomDuTitulaire, dateInscription, dateExpiration FROM clients');
	
    $q->execute();
    
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Clients');
    
    $clients = $q->fetchAll();
    
    foreach ($clients as $client)
    {
      $client->setDate(new \DateTime($client->date()));
    }
    
    return $clients;
  }
  
  public function hasSubscribed($pseudo, $pass) {
    $q = $this->dao->prepare('SELECT COUNT(*) FROM clients where pseudonyme = :pseudo AND motDePasse = :pass');
	$q->bindValue(':pseudo', $pseudo);
	$q->bindValue(':pass', $pass);
	$q->execute();
	
	return $q->fetchColumn() != 0;
  }
  
  public function get($pseudo) {
    $q = $this->dao->prepare('SELECT pseudonyme, motDePasse, montantCharge, numeroCarteBanquaire, 
	cleCarteBancaire, mail, nomDuTitulaire, dateExpiration, dateInscription FROM clients where pseudonyme = :pseudo');
	$q->bindValue(':pseudo', $pseudo);
	$q->execute();
	
	return new Client($q->fetch(\PDO::FETCH_ASSOC));
  }
  
  // Met a jour le membres membres
	public function update(Client $client) {
		
		// On stocke les valeurs dans des variables car on ne peut pas extraire des donnees aux objets dans les structures conditionnelles
		$motDePasse = $client->motDePasse();
		$montantCharge = $client->montantCharge();
		$numeroCarteBanquaire = $client->numeroCarteBanquaire();
		$cleCarteBancaire = $client->cleCarteBancaire();
		$mail = $client->mail();
		$nomDuTitulaire = $client->nomDuTitulaire();
		$dateInscription = $client->dateInscription();
		$dateExpiration = $client->dateExpiration();
		$insertionRequete = '';
		// On cree une chaine qui va nous servir a updater les champs qui sont defini dans l'objet
		if(!empty($motDePasse))
			$insertionRequete .= ' motDePasse = :motDePasse,';
		if(!empty($montantCharge))
			$insertionRequete .= ' montantCharge = :montantCharge,';
		if(!empty($numeroCarteBanquaire))
			$insertionRequete .= ' numeroCarteBanquaire = :numeroCarteBanquaire,';
		if(!empty($cleCarteBancaire))
			$insertionRequete .= ' cleCarteBancaire = :cleCarteBancaire,';
		if(!empty($mail))
			$insertionRequete .= ' mail = :mail,';
		if(!empty($nomDuTitulaire))
			$insertionRequete .= ' nomDuTitulaire = :nomDuTitulaire,';
		if(!empty($dateInscription))
			$insertionRequete .= ' dateInscription = :dateInscription,';
		if(!empty($dateExpiration))
			$insertionRequete .= ' dateExpiration = :dateExpiration,';
			
		if(!empty($insertionRequete)) // Si la chaine n'est pas nulle, on retire la derniere virgule
			$insertionRequete = substr($insertionRequete, 0, -1);
		
		$q = $this->dao->prepare('UPDATE clients SET'.$insertionRequete.' WHERE pseudonyme = :pseudonyme');
		// Enfin, on fait toutes les liaisons.
		$q->bindValue(':pseudonyme', $client->pseudonyme());
		if(!empty($motDePasse))
			$q->bindValue(':motDePasse', $motDePasse);
		if(!empty($montantCharge))
			$q->bindValue(':montantCharge', $montantCharge);
		if(!empty($numeroCarteBanquaire))
			$q->bindValue(':numeroCarteBanquaire', $numeroCarteBanquaire);
		if(!empty($cleCarteBancaire))
			$q->bindValue(':cleCarteBancaire', $cleCarteBancaire);
		if(!empty($mail))
			$q->bindValue(':mail', $mail);
		if(!empty($nomDuTitulaire))
			$q->bindValue(':nomDuTitulaire', $nomDuTitulaire);
		if(!empty($dateInscription))
			$q->bindValue(':dateInscription', $dateInscription);
		if(!empty($dateExpiration))
			$q->bindValue(':dateExpiration', $dateExpiration);
		$q->execute();
	}
 
}