<?php
namespace Applications\Frontend\Modules\Connexion;

class ConnexionController extends \Library\BackController
{
  public function executeIndex(\Library\HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');
    
    if ($request->postExists('login'))
    {
      $login = $request->postData('login');
      $password = $request->postData('password');
      $manager = $this->managers->getManagerOf('Clients');
	  if ($login == $this->app->config()->get('login') && $password == $this->app->config()->get('pass'))
	  {
	    $this->app->user()->setAdministrator(true);
		$this->app->user()->setAuthenticated(true);
        $this->app->httpResponse()->redirect('.');
	  }
      else if ($manager->hasSubscribed($login, $password))
      {
        $this->app->user()->setAuthenticated(true);
        $this->app->httpResponse()->redirect('.');
      }
      else
      {
        $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
      }
    }
  }
  
  public function executeInscription(\Library\HTTPRequest $request)
  {
    $this->page->addVar('title', 'Inscription');
    
    if ($request->postExists('pseudonyme'))
    {
      $client = new \Library\Entities\Client(array(
        'pseudonyme' => $request->postData('pseudonyme'),
        'motDePasse' => $request->postData('motDePasse'),
		'montantCharge' => $request->postData('montantCharge'),
		'numeroCarteBanquaire' => $request->postData('numeroCarteBanquaire'),
		'dateExpiration' => $request->postData('dateExpiration'),
		'cleCarteBancaire' => $request->postData('cleCarteBancaire'),
		'mail' => $request->postData('mail'),
		'nomDuTitulaire' => $request->postData('nomDuTitulaire')
      ));
	  echo $client->debug();
      if ($client->isValid())
      {
		$manager = $this->managers->getManagerOf('Clients');
	    if ($manager->isPseudoTaken($request->postData('pseudonyme')))
	    {
			echo "pseudo deja pris";
		}
		else
		{
          $manager->save($client);
        
          // $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
          $this->app->user()->setAuthenticated(true);
          $this->app->httpResponse()->redirect('.');
		}
      }
      else
      {
        $this->page->addVar('erreurs', $client->erreurs());
      }
      
      $this->page->addVar('comment', $client);
    }
  }
  
  public function executeDeconnexion(\Library\HTTPRequest $request)
  {
    $this->page->addVar('title', 'Deconnexion');
    
	$_SESSION = array();
	session_destroy();

	$this->app->httpResponse()->redirect('.');
    
  }
  
}