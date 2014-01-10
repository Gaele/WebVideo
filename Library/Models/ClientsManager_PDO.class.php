<?php
namespace Library\Models;

use \Library\Entities\Client;

class ClientsManager_PDO extends CommentsManager
{

  protected function add(Client $client)
  {
    $q = $this->dao->prepare('INSERT INTO clients SET pseudonyme = :pseudo, motDePasse = :mdp, montantCharge = :montant, numeroCarteBanquaire = :numeroCarte, 
	cleCarteBanquaire = :cle, mail = :mail, nomDuTitulaire = :nomTitulaire, dateInscription = NOW()');
    
    $q->bindValue(':pseudo', $client->pseudonyme());
    $q->bindValue(':mdp', $client->motDePasse());
	$q->bindValue(':montant', $client->montantCharge(), \PDO::PARAM_INT);
	$q->bindValue(':numeroCarte', $client->numeroCarteBanquaire());
	$q->bindValue(':cle', $client->cleCarteBanquaire(), \PDO::PARAM_INT);
	$q->bindValue(':mail', $client->mail());
	$q->bindValue(':nomTitulaire', $client->nomDuTitulaire());
	
    $q->execute();
    
    $client->setId($this->dao->lastInsertId());
  }
  
  public function getListOf()
  {
    $q = $this->dao->prepare('SELECT id, pseudonyme, motDePasse, montantCharge, numeroCarteBanquaire, cleCarteBancaire, mail, nomDuTitulaire, dateInscription FROM clients');
	
    $q->execute();
    
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Library\Entities\Clients');
    
    $clients = $q->fetchAll();
    
    foreach ($clients as $client)
    {
      $client->setDate(new \DateTime($client->date()));
    }
    
    return $clients;
  }
}