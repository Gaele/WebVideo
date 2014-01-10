<h2>Inscription</h2>
<?php
	//foreach($erreurs as $erreur) {
	//	echo $erreur."<br/>";
	//}
?>
<form action="" method="post">
  <?php if (isset($erreurs) && in_array(\Library\Entities\Client::PSEUDONYME_INVALIDE, $erreurs)) echo 'Le pseudonyme est vide.<br />'; ?>
  <label>Pseudo</label>
  <input type="text" name="pseudonyme" value="<?php if (isset($_POST["pseudonyme"])) echo $_POST["pseudonyme"]; ?>" /><br />
  
  <?php if (isset($erreurs) && in_array(\Library\Entities\Client::MOTDEPASSE_INVALIDE, $erreurs)) echo 'Mot de passe invalide.<br />'; ?>
  <label>Mot de passe</label>
  <input type="password" name="motDePasse" value="<?php if (isset($_POST["motDePasse"])) echo $_POST["motDePasse"]; ?>" /><br />

  <?php if (isset($erreurs) && in_array(\Library\Entities\Client::TITULAIRE_INVALIDE, $erreurs)) echo 'Titulaire invalide.<br />'; ?>
  <label>nom du titulaire du compte</label>
  <input type="text" name="nomDuTitulaire" value="<?php if (isset($_POST["nomDuTitulaire"])) echo $_POST["nomDuTitulaire"]; ?>" /><br />
  
  <?php if (isset($erreurs) && in_array(\Library\Entities\Client::CARTE_WRONG_SIZE, $erreurs)) echo 'Le numero de carte a une taille abherente.<br />'; ?>
  <?php if (isset($erreurs) && in_array(\Library\Entities\Client::CARTE_FAKE, $erreurs)) echo 'Le numero de carte est un faux.<br />'; ?>
  <?php if (isset($erreurs) && in_array(\Library\Entities\Client::CARTE_NOTDIGITSTRING, $erreurs)) echo 'Le numero de carte doit etre une suite de chiffres.<br />'; ?>
  <label>Numero de carte</label>
  <input type="text" name="numeroCarteBanquaire" value="<?php if (isset($_POST["numeroCarteBanquaire"])) echo $_POST["numeroCarteBanquaire"]; ?>" /><br />
  
  <?php if (isset($erreurs) && in_array(\Library\Entities\Client::CLE_INVALIDE, $erreurs)) echo 'Clef invalide.<br />'; ?>
  <?php if (isset($erreurs) && in_array(\Library\Entities\Client::CLE_ABSCENTE, $erreurs)) echo 'Clef abscente.<br />'; ?>
  <label>Cryptogramme visuel (au dos)</label>
  <input type="text" name="cleCarteBancaire" value="<?php if (isset($_POST["cleCarteBancaire"])) echo $_POST["cleCarteBancaire"]; ?>" /><br />
  
  <?php if (isset($erreurs) && in_array(\Library\Entities\Client::MAIL_NOTSTRING, $erreurs)) echo 'Le mail doit etre une chaine de caracteres.<br />'; ?>
  <?php if (isset($erreurs) && in_array(\Library\Entities\Client::MAIL_INVALID, $erreurs)) echo 'mail invalide.<br />'; ?>
  <label>Mail</label>
  <input type="text" name="mail" value="<?php if (isset($_POST["mail"])) echo $_POST["mail"]; ?>" /><br />
  
  <label>Montant a charger sur le compte</label>
  <input type="text" name="montantCharge" value="<?php if (isset($_POST["montantCharge"])) echo $_POST["montantCharge"]; ?>" /><br /><br />
  
  <input type="submit" value="Inscription" />
</form>
