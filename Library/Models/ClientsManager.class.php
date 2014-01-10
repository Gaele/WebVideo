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
    if ($client->isValid())
    {
      $client->isNew() ? $this->add($client) : $this->modify($client);
    }
    else
    {
      throw new \RuntimeException('Le client doit être validé pour être enregistré');
    }
  }
  
  /**
   * Méthode permettant de récupérer une liste de client.
   * @return array
   */
  abstract public function getListOf();
  
}