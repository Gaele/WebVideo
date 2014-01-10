<h2>Offrir des cartes pres-payees</h2>

<p> Montant du compte : 
<?php
	echo $client->montantCharge();
?>

</p>
<?php
	if($this->app->user()->hasFlash()) {
		echo $this->app->user()->getFlash();
	}
?>
<form action="" method="post">
  <legend>Offrir une carte a quelqu'un</legend><br/>
  <?php if (isset($erreurs) && in_array(\Library\Entities\Client::PSEUDONYME_INVALIDE, $erreurs)) echo 'Le pseudonyme est vide.<br />'; ?>
  <label>Somme a offrir</label>
  <input type="number" name="offre" step="10" value="<?php if (isset($_POST["pseudonyme"])) {echo $_POST["pseudonyme"];} else { echo 100;} ?>" /><br /><br />
  
  <label>Personne recevant le cadeau</label>
  <input type="text" name="receveur" step="10" value="<?php if (isset($_POST["pseudonyme"])) echo $_POST["pseudonyme"]; ?>" /><br /><br />
  
  <input type="submit" value="Recharger" />
</form>
