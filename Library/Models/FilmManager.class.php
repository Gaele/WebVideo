<?php
namespace Library\Models;

use \Library\Entities\Film;

abstract class FilmManager extends \Library\Manager
{
  
  /**
   * Méthode permettant de récupérer une liste de client.
   * @return array
   */
  abstract public function getListOf();
  

  
}