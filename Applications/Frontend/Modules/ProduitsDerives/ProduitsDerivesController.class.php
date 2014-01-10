<?php
namespace Applications\Frontend\Modules\ProduitsDerives;

class ProduitsDerivesController extends \Library\BackController
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
	    echo "Admin";
	    $this->app->user()->setAdministrator(true);
		$this->app->user()->setAuthenticated("Admin");
        $this->app->httpResponse()->redirect('.');
	  }
      else if ($manager->hasSubscribed($login, $password))
      {
        $this->app->user()->setAuthenticated($login);
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
	  // echo $client->debug();
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
      
      $this->page->addVar('client', $client);
    }
  }
  
  public function executeDeconnexion(\Library\HTTPRequest $request)
  {
    $this->page->addVar('title', 'Deconnexion');
    
	$_SESSION = array();
	session_destroy();

	$this->app->httpResponse()->redirect('.');
  }
  
  public function executeCartesPrePayees(\Library\HTTPRequest $request)
  {
    $this->page->addVar('title', 'Cartes pre-payees');
    $pseudo = $this->app->user()->getAuthenticated();
	$manager = $this->managers->getManagerOf('Clients');
	$client = $manager->get($pseudo);
	
	if ($request->postExists('offre'))
	{
		// if card still ok
		if(strtotime($client->dateExpiration()) <= strtotime('now'))
		{
			$this->app->user()->setFlash("Carte bancaire passée de date, veuillez la mettre à jour !");
		} // if can pay
		else if((int)$request->postData('offre') > $client->montantCharge())
		{
			$this->app->user()->setFlash("Refusé : somme trop importante");
		} // if the receiver exists
		else if(!$manager->isPseudoTaken(htmlspecialchars($request->postData('receveur'))))
		{
			$this->app->user()->setFlash("Refusé : La personne recevant le cadeau n'existe pas");
		} // it's ok
		else
		{
			$manager = $this->managers->getManagerOf('Clients');
			$receveur = $manager->get(htmlspecialchars($request->postData('receveur')));
			
			$client->setMontantCharge($client->montantCharge() - (int)$request->postData('offre'));
			$receveur->setMontantCharge($receveur->montantCharge() + (int)$request->postData('offre'));
			$manager->update($client);
			$manager->update($receveur);
			$this->app->user()->setFlash("Vous avez bien offert une carte pre-payee a ".htmlspecialchars($receveur->pseudonyme()));
		}
	}
	
	$this->page->addVar('client', $client);
  }
  
}

