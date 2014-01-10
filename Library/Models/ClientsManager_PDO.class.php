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
  
}