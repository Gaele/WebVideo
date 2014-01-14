<form action="" method="post">
  <p>
    <?php if (isset($erreurs) && in_array(\Library\Entities\Client::PSEUDONYME_INVALIDE, $erreurs)) echo 'Le pseudonyme est invalide.<br />'; ?>
    <label>Pseudonyme</label>
    <input type="text" name="pseudonyme" value="<?php if (isset($news)) echo $news['pseudonyme']; ?>" /><br />
    
    <?php if (isset($erreurs) && in_array(\Library\Entities\Client::MOTDEPASSE_INVALIDE, $erreurs)) echo 'Le mot de passe est invalide.<br />'; ?>
    <label>Mot de Passe</label><input type="text" name="motDePasse" value="<?php if (isset($news)) echo $news['motDePasse']; ?>" /><br />
    
	<?php if (isset($erreurs) && in_array(\Library\Entities\Client::MONTANT_VIDE, $erreurs)) echo 'Le montant est vide.<br />'; ?>
	<?php if (isset($erreurs) && in_array(\Library\Entities\Client::MONTANT_VIDE, $erreurs)) echo 'Le montant est négatif.<br />'; ?>
    <label>Montant Chargé</label><input type="text" name="montantCharge" value="<?php if (isset($news)) echo $news['montantCharge']; ?>" /><br />
    
	<?php if (isset($erreurs) && in_array(\Library\Entities\Client::CARTE_NOTDIGITSTRING, $erreurs)) echo 'Le numéro de la carte banquaire doit etre un numéro.<br />'; ?>
	<?php if (isset($erreurs) && in_array(\Library\Entities\Client::CARTE_WRONG_SIZE, $erreurs)) echo 'Le numéro de la carte banquaire n\'a pas la bonne taille.<br />'; ?>
	<?php if (isset($erreurs) && in_array(\Library\Entities\Client::CARTE_FAKE, $erreurs)) echo 'Le numéro de la carte banquaire est une fausse.<br />'; ?>
    <label>Numéro carte banquaire</label><input type="text" name="numeroCarteBanquaire" value="<?php if (isset($news)) echo $news['numeroCarteBanquaire']; ?>" /><br />
    
	<?php if (isset($erreurs) && in_array(\Library\Entities\Client::CLE_INVALIDE, $erreurs)) echo 'La clé de la carte banquaire est invalide.<br />'; ?>
	<?php if (isset($erreurs) && in_array(\Library\Entities\Client::CLE_ABSCENTE, $erreurs)) echo 'La clé de la carte banquaire est abscente.<br />'; ?>
    <label>Clef carte banquaire</label><input type="text" name="cleCarteBancaire" value="<?php if (isset($news)) echo $news['cleCarteBancaire']; ?>" /><br />
    
	<?php if (isset($erreurs) && in_array(\Library\Entities\Client::MAIL_NOTSTRING, $erreurs)) echo 'Le mail doit être une chaine de caractères valides.<br />'; ?>
	<?php if (isset($erreurs) && in_array(\Library\Entities\Client::MAIL_INVALID, $erreurs)) echo 'Le mail est invalide.<br />'; ?>
    <label>Mail</label><input type="email" name="mail" value="<?php if (isset($news)) echo $news['mail']; ?>" /><br />
    
	<?php if (isset($erreurs) && in_array(\Library\Entities\Client::TITULAIRE_INVALIDE, $erreurs)) echo 'Le titulaire est invalide.<br />'; ?>
    <label>Nom du titulaire</label><input type="text" name="nomDuTitulaire" value="<?php if (isset($news)) echo $news['nomDuTitulaire']; ?>" /><br />
    
	
    <label>Date d'inscription</label><input type="text" name="dateInscription" value="<?php if (isset($news)) echo $news['dateInscription']; ?>" /><br />
    
	<?php if (isset($erreurs) && in_array(\Library\Entities\Client::DATE_EXPIRATION_ABSURDE, $erreurs)) echo 'La date d\'expiration est invalide.<br />'; ?>
    <label>Date d'expiration</label><input type="text" name="dateExpiration" value="<?php if (isset($news)) echo $news['dateExpiration']; ?>" /><br />
    <br />
<?php
if(isset($news) && !$news->isNew())
{
?>
    <input type="hidden" name="id" value="<?php echo $news['id']; ?>" />
    <input type="submit" value="Modifier" name="Modifier" />
<?php
}
else
{
?>
    <input type="submit" value="Ajouter" />
<?php
}
?>
  </p>
</form>