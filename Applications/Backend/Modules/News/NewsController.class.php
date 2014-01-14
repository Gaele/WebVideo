<?php 
namespace Applications\Backend\Modules\News;

class NewsController extends \Library\BackController
{
  public function executeIndex(\Library\HTTPRequest $request)
  {
    $this->page->addVar('title', 'Gestion des Films');
    
    $manager = $this->managers->getManagerOf('News');
	$managerFilm = $this->managers->getManagerOf('Film');
	
    $this->page->addVar('listeNews', $manager->getList());
	$this->page->addVar('listeFilms', $managerFilm->getListOf());
    $this->page->addVar('nombreNews', $manager->count());
	$this->page->addVar('nombreFilms', $managerFilm->count());
  }
  
  public function executeInsert(\Library\HTTPRequest $request)
  {
    if ($request->postExists('auteur'))
    {
      $this->processForm($request);
    }
    
    $this->page->addVar('title', 'Ajout d\'une news');
  }
  
  public function executeFilmInsert(\Library\HTTPRequest $request)
  {
    if ($request->postExists('titre'))
    {
      $this->processFormFilm($request);
    }
    
    $this->page->addVar('title', 'Ajout d\'un film');
  }
  
  public function processForm(\Library\HTTPRequest $request)
  {
    $news = new \Library\Entities\News(
      array(
        'auteur' => $request->postData('auteur'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu')
      )
    );
    
    // L'identifiant de la news est transmis si on veut la modifier.
    if ($request->postExists('id'))
    {
      $news->setId($request->postData('id'));
    }
    
    if ($news->isValid())
    {
      $this->managers->getManagerOf('News')->save($news);
      
      $this->app->user()->setFlash($news->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !');
    }
    else
    {
      $this->page->addVar('erreurs', $news->erreurs());
    }
    
    $this->page->addVar('news', $news);
  }
  
  private function processFormFilm(\Library\HTTPRequest $request)
  {
    $news = new \Library\Entities\Film(
      array(
        'titre' => $request->postData('titre'),
        'description' => $request->postData('description'),
        'genre' => $request->postData('genre'),
        'acteurs' => $request->postData('acteurs'),
        'realisateurs' => $request->postData('realisateurs'),
        'dateDeSortie' => $request->postData('dateDeSortie'),
        'langue' => $request->postData('langue'),
        'duree' => $request->postData('duree'),
        'prixLocation' => $request->postData('prixLocation'),
        'prixAchat' => $request->postData('prixAchat')
      )
    );
    
    // L'identifiant de la news est transmis si on veut la modifier.
    if ($request->postExists('id'))
    {
      $news->setId($request->postData('id'));
    }
    
    if ($news->isValid())
    {
	  $this->managers->getManagerOf('Film')->save($news);
      $this->app->user()->setFlash($news->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !');
    }
    else
    {
      $this->page->addVar('erreurs', $news->erreurs());
    }
    
    $this->page->addVar('film', $news);
  }
  
  public function executeUpdate(\Library\HTTPRequest $request)
  {
    if ($request->postExists('auteur'))
    {
      $this->processForm($request);
    }
    else
    {
      $this->page->addVar('film', $this->managers->getManagerOf('Film')->getUnique($request->getData('id')));
    }
    
    $this->page->addVar('title', 'Modification d\'une news');
  }
  
  public function executeFilmUpdate(\Library\HTTPRequest $request)
  {
    if ($request->postExists('titre'))
    {
      $this->processFormFilm($request);
    }
    else
    {
      $this->page->addVar('film', $this->managers->getManagerOf('Film')->getUnique($request->getData('id')));
    }
    
    $this->page->addVar('title', 'Modification d\'un film');
  }
  
  public function executeDelete(\Library\HTTPRequest $request)
  {
	$this->managers->getManagerOf('News')->delete($request->getData('id'));
	$this->app->user()->setFlash('La news a bien ete supprimee !');
	$this->app->httpResponse()->redirect('.');
  }
  
  public function executeFilmDelete(\Library\HTTPRequest $request)
  {
	$this->managers->getManagerOf('Film')->delete($request->getData('id'));
	$this->app->user()->setFlash('Le film a bien ete supprimee !');
	$this->app->httpResponse()->redirect('.');
  }
  
}