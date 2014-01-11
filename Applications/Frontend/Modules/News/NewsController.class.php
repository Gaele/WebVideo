<?php
namespace Applications\Frontend\Modules\News;

class NewsController extends \Library\BackController
{
  public function executeIndex(\Library\HTTPRequest $request)
  {
  
    $nombreFilms = $this->app->config()->get('nombre_news');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
    
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Liste des films');
    
    // On récupère le manager des films.
    $manager = $this->managers->getManagerOf('Film');
    
	$films = $manager->getListOf((int)0, (int)$nombreFilms);
    
    // On ajoute la variable $listeNews à la vue.
    $this->page->addVar('films', $films);
	$this->page->addVar('nombreCaracteres', $nombreCaracteres);
	
  }
  
  public function executeShow(\Library\HTTPRequest $request)
  {
    $film = $this->managers->getManagerOf('Film')->getUnique($request->getData('id'));
    $loue = $this->managers->getManagerOf('Louer')->loue($this->app->user()->getAuthenticated(), $request->getData('id'));
	
    if (empty($film))
    {
      $this->app->httpResponse()->redirect404();
    }
    
    $this->page->addVar('film', $film);
	$this->page->addVar('loue', $loue);
    // $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($film->id()));
  }
  
  public function executeInsertComment(\Library\HTTPRequest $request)
  {
    $this->page->addVar('title', 'Ajout d\'un commentaire');
    
    if ($request->postExists('pseudo'))
    {
      $comment = new \Library\Entities\Comment(array(
        'news' => $request->getData('news'),
        'auteur' => $request->postData('pseudo'),
        'contenu' => $request->postData('contenu')
      ));
      
      if ($comment->isValid())
      {
        $this->managers->getManagerOf('Comments')->save($comment);
        
        $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
        
        $this->app->httpResponse()->redirect('news-'.$request->getData('news').'.html');
      }
      else
      {
        $this->page->addVar('erreurs', $comment->erreurs());
      }
      
      $this->page->addVar('comment', $comment);
    }
  }
  
}