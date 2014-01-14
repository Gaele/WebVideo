<?php
namespace Library\Models;

use \Library\Entities\Film;

abstract class FilmManager extends \Library\Manager
{
  
  /**
   * Méthode permettant de récupérer une liste de client.
   * @return array
   */
  abstract public function getListOf(/*$first, $last*/);
  
  /*
   * Methode retourne la video d'id $id
   * @return Video
   *
   */
  abstract public function getUnique($id);
  
  /*
   * Methode retourne le nombre de videos
   */
  abstract function count();
  
    /**
   * Méthode permettant d'enregistrer une news.
   * @param $news News la news à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(Film $film)
  {
    if ($film->isValid())
    {
      $film->isNew() ? $this->add($film) : $this->modify($film);
    }
    else
    {
      throw new \RuntimeException('La film doit être validée pour être enregistrée');
    }
  }
  
  /**
   * Méthode permettant d'ajouter un film
   * @param $film Film le film à ajouter
   * @return void
   */
  abstract protected function add(Film $film);

  /**
   * Méthode permettant de supprimer un film.
   * @param $id Int L'identifiant du film à supprimer
   * @return void
   */
  abstract function delete($id);
  
}