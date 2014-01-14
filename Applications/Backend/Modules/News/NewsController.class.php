<?php
namespace Applications\Backend\Modules\News;

class NewsController extends \Library\BackController
{
  public function executeFilmIndex(\Library\HTTPRequest $request)
  {
    $this->page->addVar('title', 'Gestion des Films');
	
	$managerFilm = $this->managers->getManagerOf('Film');
	
	$this->page->addVar('listeFilms', $managerFilm->getListOf());
	$this->page->addVar('nombreFilms', $managerFilm->count());
  }
  
  public function executeClientIndex(\Library\HTTPRequest $request)
  {
    $this->page->addVar('title', 'Gestion des Clients');
    
	$managerFilm = $this->managers->getManagerOf('Clients');
	
	$this->page->addVar('listeData', $managerFilm->getListOf());
	$this->page->addVar('nombreData', $managerFilm->count());
  }
  
  public function executeClientInsert(\Library\HTTPRequest $request)
  {
    if ($request->postExists('pseudonyme'))
    {
      $this->processFormClient($request);
    }
    $this->page->addVar('title', 'Ajout d\'un client');
  }
  
  public function executeFilmInsert(\Library\HTTPRequest $request)
  {
    if ($request->postExists('titre'))
    {
      $this->processFormFilm($request);
    }
    
    $this->page->addVar('title', 'Ajout d\'un film');
  }
  
  public function processFormClient(\Library\HTTPRequest $request)
  {
    $news = new \Library\Entities\Client(
      array(
        'pseudonyme' => $request->postData('pseudonyme'),
        'motDePasse' => $request->postData('motDePasse'),
        'montantCharge' => $request->postData('montantCharge'),
        'numeroCarteBanquaire' => $request->postData('numeroCarteBanquaire'),
        'cleCarteBancaire' => $request->postData('cleCarteBancaire'),
        'mail' => $request->postData('mail'),
        'nomDuTitulaire' => $request->postData('nomDuTitulaire'),
        'dateInscription' => $request->postData('dateInscription'),
        'dateExpiration' => $request->postData('dateExpiration')
      )
    );
    
    // L'identifiant de la news est transmis si on veut la modifier.
    if ($request->postExists('id'))
    {
      $news->setId($request->postData('id'));
    }
    
    if ($news->isValid())
    {
      $erreur = $this->managers->getManagerOf('Clients')->save($news);
	  if($erreur != "") {
	    $this->app->user()->setFlash($erreur);
	  } else {
        $this->app->user()->setFlash($news->isNew() ? 'Le client a bien été ajoutée !' : 'Le client a bien été modifiée !');
	  }
    }
    else
    {
		echo "NEWS INVALIDE";
		echo $news->debugClient();
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
  
  public function executeClientUpdate(\Library\HTTPRequest $request)
  {
    if ($request->postExists('pseudonyme'))
    {
      $this->processFormClient($request);
    }
    else
    {
      $this->page->addVar('news', $this->managers->getManagerOf('Clients')->getUnique($request->getData('id')));
    }
    
    $this->page->addVar('title', 'Modification d\'un client');
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
  
  public function executeClientDelete(\Library\HTTPRequest $request)
  {
	$this->managers->getManagerOf('Clients')->delete($request->getData('id'));
	$this->app->user()->setFlash('Le client a bien ete supprimee !');
	$this->app->httpResponse()->redirect('client');
  }
  
  public function executeFilmDelete(\Library\HTTPRequest $request)
  {
	$this->managers->getManagerOf('Film')->delete($request->getData('id'));
	$this->app->user()->setFlash('Le film a bien ete supprimee !');
	$this->app->httpResponse()->redirect('.');
  }
  
}