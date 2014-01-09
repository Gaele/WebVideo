<?php
namespace Applications\Backend\Modules\News;

class NewsController extends \Library\BackController
{
  public function executeIndex(\Library\HTTPRequest $request)
  {
    $this->page->addVar('title', 'Gestion des news');
    
    $manager = $this->managers->getManagerOf('News');
	
    $this->page->addVar('listeNews', $manager->getList());
    $this->page->addVar('nombreNews', $manager->count());
  }
  
  public function executeInsert(\Library\HTTPRequest $request)
  {
    if ($request->postExists('auteur'))
    {
      $this->processForm($request);
    }
    
    $this->page->addVar('title', 'Ajout d\'une news');
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
      
      $this->app->user()->setFlash($news->isNew() ? 'La news a bien �t� ajout�e !' : 'La news a bien �t� modifi�e !');
    }
    else
    {
      $this->page->addVar('erreurs', $news->erreurs());
    }
    
    $this->page->addVar('news', $news);
  }
  
  public function executeUpdate(\Library\HTTPRequest $request)
  {
    if ($request->postExists('auteur'))
    {
      $this->processForm($request);
    }
    else
    {
      $this->page->addVar('news', $this->managers->getManagerOf('News')->getUnique($request->getData('id')));
    }
    
    $this->page->addVar('title', 'Modification d\'une news');
  }
  
  public function executeDelete(\Library\HTTPRequest $request)
  {
	$this->managers->getManagerOf('News')->delete($request->getData('id'));
	$this->app->user()->setFlash('La news a bien ete supprimee !');
	$this->app->httpResponse()->redirect('.');

  }
  
  
  
}