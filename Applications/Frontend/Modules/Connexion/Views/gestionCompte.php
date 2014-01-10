<h2>Gestion du compte</h2>

<p> Montant du compte : 
<?php
	echo $client->montantCharge();
?>

</p>
<form action="" method="post">
  <legend>Recharger le compte</legend><br/>
  <?php if (isset($erreurs) && in_array(\Library\Entities\Client::PSEUDONYME_INVALIDE, $erreurs)) echo 'Le pseudonyme est vide.<br />'; ?>
  <label>Recharge</label>
  <input type="number" name="recharge" step="10" value="<?php if (isset($_POST["pseudonyme"])) {echo $_POST["pseudonyme"];} else { echo 100;} ?>" /><br /><br />
  
  <input type="submit" value="Recharger" />
</form>
