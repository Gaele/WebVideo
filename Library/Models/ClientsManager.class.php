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
    if ($client->isValid())
    {
      $client->isNew() ? $this->add($client) : $this->modify($client);
    }
    else
    {
      throw new \RuntimeException('Le client doit �tre valid� pour �tre enregistr�');
    }
  }
  
  /**
   * M�thode permettant de r�cup�rer une liste de client.
   * @return array
   */
  abstract public function getListOf();
  
}