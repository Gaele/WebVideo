<?php
namespace Applications\Frontend\Modules\News;

use \Xml\XmlLoader;

class NewsController extends \Library\BackController
{

  public function executeIndex3(\Library\HTTPRequest $request)
  {
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Liste des films');
	
	$nombreFilms = $this->app->config()->get('nombre_news');
	$xmlLoader = new XmlLoader();

	$filmManager = $this->managers->getManagerOf('Film');
	$films = $filmManager->getListOf((int)0, (int)$nombreFilms);
	
	# LOAD XML FILE 
	$XML = $xmlLoader->ajoutTitre($films);
	
	# START XSLT
	$xslt = new \XSLTProcessor();
	$XSL = new \DOMDocument();
	$XSL->load( 'Xml/listeVideos4.xsl', LIBXML_NOCDATA);
	$xslt->importStylesheet( $XSL );
	
	$PL = $request->postData('id');
	if($PL != null && is_numeric($PL)) {
		$prixLocation = (int)$PL;
	} else {
		$prixLocation = "99999";
	}
	$TITRE = $request->postData('titre');
	if(($TITRE != null) and ($TITRE != "")) {
		$titre = $TITRE;
	} else {
		$titre = '';
	}

	$xslt->setParameter('', 'pl', $prixLocation);
	$xslt->setParameter('', 't', $titre);
	
	#PRINT
	$result = $xslt->transformToXML( $XML );
	
	$this->page->addVar('result', $result);
    // On ajoute la variable $listeNews à la vue.
    // $this->page->addVar('films', $films);
	// $this->page->addVar('nombreCaracteres', $nombreCaracteres);
	
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
	//$this->page->addVar('loue', $loue);
	if($loue != null) {
		$this->page->addVar('loue', 1);
	} else {
		$this->page->addVar('loue', 0);
	}
	
    // $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($film->id()));
  }
  
  public function executeShow2(\Library\HTTPRequest $request)
  {
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Page d\'un film');
	
	$nombreFilms = $this->app->config()->get('nombre_news');
	$xmlLoader = new XmlLoader();

	$film = $this->managers->getManagerOf('Film')->getUnique($request->getData('id'));
	
	# LOAD XML FILE 
	$XML = $xmlLoader->ajoutTitre($films);
	
	# START XSLT
	$xslt = new \XSLTProcessor();
	$XSL = new \DOMDocument();
	$XSL->load( 'Xml/listeVideos4.xsl', LIBXML_NOCDATA);
	$xslt->importStylesheet( $XSL );
	
	$PL = $request->postData('id');
	if($PL != null && is_numeric($PL)) {
		$prixLocation = (int)$PL;
	} else {
		$prixLocation = "99999";
	}
	$TITRE = $request->postData('titre');
	if(($TITRE != null) and ($TITRE != "")) {
		$titre = $TITRE;
	} else {
		$titre = '';
	}

	$xslt->setParameter('', 'pl', $prixLocation);
	$xslt->setParameter('', 't', $titre);
	
	#PRINT
	$result = $xslt->transformToXML( $XML );
	
	$this->page->addVar('result', $result);
    // On ajoute la variable $listeNews à la vue.
    // $this->page->addVar('films', $films);
	// $this->page->addVar('nombreCaracteres', $nombreCaracteres);
	
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

  public function executeAchat(\Library\HTTPRequest $request)
  {
	$userName = $this->app->user()->getAuthenticated();
	$userManager = $this->managers->getManagerOf('Clients');
	$user = $userManager->get($userName);
	
	$filmManager = $this->managers->getManagerOf('Film');
	$film = $filmManager->getUnique($request->getData('id'));
	
	$file = 'Web/videos/'.$film->titre().'.mp4';
	if(file_exists($file)) {
		if($user->montantCharge() - $film->prixAchat() < 0)
		{
			$this->app->user()->setFlash('Erreur : veuillez recharger votre compte.');
			$this->app->httpResponse()->redirect('.');
		}
		else
		{
			// Payement
			$user->setMontantCharge($user->montantCharge() - $film->prixAchat());
			$userManager->update($user);
			// $this->app->httpResponse()->redirect('/WebVideo/Web/video/'.$film->titre().'.mp4');
			
			// Telechargement
			header('Content-Description: File Transfert');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.basename($file));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: '.filesize($file));
			ob_clean();
			flush();
			readfile($file);
			// exit;
			$this->app->httpResponse()->redirect("/WebVideo/news-".$film->id().".html");
			$this->app->user()->setFlash("Téléchargement en cours");
		}
	} else {
		$this->app->user()->setFlash("Erreur : le fichier demandé n'existe pas.");
	}
	$this->app->httpResponse()->redirect("/WebVideo/news-".$film->id().".html");
  }
  
  
  public function executeLocation(\Library\HTTPRequest $request)
  {
	$userName = $this->app->user()->getAuthenticated();
	$userManager = $this->managers->getManagerOf('Clients');
	$user = $userManager->get($userName);
	
	$filmManager = $this->managers->getManagerOf('Film');
	$film = $filmManager->getUnique($request->getData('id'));
	
	// location => //$this->app->httpResponse()->redirect('/WebVideo/Web/videos/'.$film->titre().'.mp4');
	
	$file = 'Web/videos/'.$film->titre().'.mp4';
	if(file_exists($file)) {
		if($user->montantCharge() - $film->prixAchat() < 0)
		{
			$this->app->user()->setFlash('Erreur : veuillez recharger votre compte.');
			$this->app->httpResponse()->redirect('.');
		}
		else
		{
			// Payement
			$user->setMontantCharge($user->montantCharge() - $film->prixLocation());
			$userManager->update($user);
			
			$loue = $this->managers->getManagerOf('Louer')->location($userName, $request->getData('id'));
			$this->page->addVar('loue', $loue);
			
			$this->app->user()->setFlash("Location effectuée");
		}
	} else {
		$this->app->user()->setFlash("Erreur : le fichier demandé n'existe pas.");
	}
	$this->app->httpResponse()->redirect("/WebVideo/news-".$film->id().".html");
  }
  
  private function general() {
    $locationManager = $this->managers->getManagerOf('Louer');
	$clientManager = $this->managers->getManagerOf('Clients');
	$clientName = $this->app->user()->getAuthenticated();
    $locations = $locationManager->rentedBy($clientManager->get($clientName)->id());
    
	$this->page->addVar('locations', $locations);
  }
  
}