<?php
namespace Library\Models;

use \Library\Entities\Film;

abstract class FilmManager extends \Library\Manager
{
  
  /**
   * M�thode permettant de r�cup�rer une liste de client.
   * @return array
   */
  abstract public function getListOf($first, $last);
  
  /*
   * Methode retourne la video d'id $id
   * @return Video
   *
   */
  abstract public function getUnique($id);
  
}