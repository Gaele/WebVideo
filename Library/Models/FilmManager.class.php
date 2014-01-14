<?php
namespace Library\Models;

use \Library\Entities\Film;

abstract class FilmManager extends \Library\Manager
{
  
  /**
   * M�thode permettant de r�cup�rer une liste de client.
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
   * M�thode permettant d'enregistrer une news.
   * @param $news News la news � enregistrer
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
      throw new \RuntimeException('La film doit �tre valid�e pour �tre enregistr�e');
    }
  }
  
  /**
   * M�thode permettant d'ajouter un film
   * @param $film Film le film � ajouter
   * @return void
   */
  abstract protected function add(Film $film);

  /**
   * M�thode permettant de supprimer un film.
   * @param $id Int L'identifiant du film � supprimer
   * @return void
   */
  abstract function delete($id);
  
}