<?php
namespace Library\Models;

use \Library\Entities\Client;

abstract class ClientsManager extends \Library\Manager
{
  /**
   * M�thode permettant d'ajouter un client.
   * @param $client Le client � ajouter
   * @return void
   */
  abstract protected function add(Client $client);
  
  /**
   * M�thode permettant d'enregistrer un client.
   * @param $client Le client � enregistrer
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
      throw new \RuntimeException('Le client doit �tre valid� pour �tre enregistr�');
    }
  }
  
  /**
   * M�thode permettant de savoir si un pseudonyme est deja pris ou non
   * @return boolean
   */
  abstract public function isPseudoTaken($pseudo);
  
  /**
   * M�thode permettant de r�cup�rer une liste de client.
   * @return array
   */
  abstract public function getListOf();
  
  /**
   * M�thode permettant de savoir si un couple login-motDePasse est enregistre
   * @return boolean
   */
  abstract public function hasSubscribed($pseudo, $pass);


  /**
   * Return the person with the given pseudonyme
   * @return client
   */
  abstract public function get($pseudo);


  
}