<?php
namespace Library\Models;

use \Library\Entities\Client;

abstract class ClientsManager extends \Library\Manager
{

  /**
   * M�thode comptant le nombre de clients
   * @return int
   */
  abstract public function count();

  /**
   * M�thode permettant d'ajouter un client.
   * @param $client Le client � ajouter
   * @return String pour les erreurs, null sinon
   */
  abstract protected function add(Client $client);
  
  /**
   * M�thode permettant d'enregistrer un client.
   * @param $client Le client � enregistrer
   * @return String (pour les erreurs)
   */
  public function save(Client $client)
  {
    if ($client->isValid())
    {
		if($client->isNew()) {
			return $this->add($client);
		} else {
			return $this->modify($client);
		}
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
   * @param $pseudo String the pseudonyme
   * @return client
   */
  abstract public function getUnique($pseudo);

  /**
   * Return the person with the given id
   * @param $id Integer the id of the person
   * @return client
   */
  abstract public function get($id);
  

    /**
   * M�thode permettant de supprimer un client.
   * @param $id Int L'identifiant du client � supprimer
   * @return void
   */
  abstract function delete($id);

  
}