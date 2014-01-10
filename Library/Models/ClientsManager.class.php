<?php
namespace Library\Models;

use \Library\Entities\Client;

abstract class ClientsManager extends \Library\Manager
{
  /**
   * Méthode permettant d'ajouter un client.
   * @param $client Le client à ajouter
   * @return void
   */
  abstract protected function add(Client $client);
  
  /**
   * Méthode permettant d'enregistrer un client.
   * @param $client Le client à enregistrer
   * @return void
   */
  public function save(Client $client)
  {
	$client->debug();
    if ($client->isValid())
    {
		echo "valide client";
      // $client->isNew() ? $this->add($client) : $this->modify($client);
	  $this->add($client);
    }
    else
    {
      throw new \RuntimeException('Le client doit être validé pour être enregistré');
    }
  }
  
  /**
   * Méthode permettant de savoir si un pseudonyme est deja pris ou non
   * @return boolean
   */
  abstract public function isPseudoTaken($pseudo);
  
  /**
   * Méthode permettant de récupérer une liste de client.
   * @return array
   */
  abstract public function getListOf();
  
  /**
   * Méthode permettant de savoir si un couple login-motDePasse est enregistre
   * @return boolean
   */
  abstract public function hasSubscribed($pseudo, $pass);


  /**
   * Return the person with the given pseudonyme
   * @return client
   */
  abstract public function get($pseudo);


  
}