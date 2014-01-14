<?php
namespace Library\Models;

use \Library\Entities\Client;

abstract class ClientsManager extends \Library\Manager
{

  /**
   * Méthode comptant le nombre de clients
   * @return int
   */
  abstract public function count();

  /**
   * Méthode permettant d'ajouter un client.
   * @param $client Le client à ajouter
   * @return String pour les erreurs, null sinon
   */
  abstract protected function add(Client $client);
  
  /**
   * Méthode permettant d'enregistrer un client.
   * @param $client Le client à enregistrer
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
   * Méthode permettant de supprimer un client.
   * @param $id Int L'identifiant du client à supprimer
   * @return void
   */
  abstract function delete($id);

  
}