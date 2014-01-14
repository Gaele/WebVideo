<form action="" method="post">
  <p>
	<?php if (isset($erreurs) && in_array(\Library\Entities\News::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide.<br />'; ?>
    <label>Titre</label><input type="text" name="titre" value="<?php if (isset($film)) echo $film['titre']; ?>" /><br />
	
	<?php if (isset($erreurs) && in_array(\Library\Entities\News::DESCRIPTION_INVALIDE, $erreurs)) echo 'La description est invalide.<br />'; ?>
    <label>Description</label>
	<textarea rows="8" cols="60" name="description"><?php if (isset($film)) echo $film['description']; ?></textarea><br />
    
	<?php if (isset($erreurs) && in_array(\Library\Entities\News::GENRE_INVALIDE, $erreurs)) echo 'Le genre est invalide.<br />'; ?>
    <label>Genre</label>
    <input type="text" name="genre" value="<?php if (isset($film)) echo $film['genre']; ?>" /><br />
    
	<?php if (isset($erreurs) && in_array(\Library\Entities\News::ACTEURS_INVALIDE, $erreurs)) echo 'Les acteurs sont invalides.<br />'; ?>
	<label>Acteurs</label>
    <input type="text" name="acteurs" value="<?php if (isset($film)) echo $film['acteurs']; ?>" /><br />
	
	<?php if (isset($erreurs) && in_array(\Library\Entities\News::REALISATEURS_INVALIDE, $erreurs)) echo 'Les réalisateurs sont invalide.<br />'; ?>
	<label>Realisateurs</label>
    <input type="text" name="realisateurs" value="<?php if (isset($film)) echo $film['realisateurs']; ?>" /><br />
	
	<?php if (isset($erreurs) && in_array(\Library\Entities\News::DATE_DE_SORTIE_INVALIDE, $erreurs)) echo 'La date de sortie est invalide.<br />'; ?>
	<label>Date de sortie</label>
    <input type="text" name="dateDeSortie" value="<?php if (isset($film)) echo $film['dateDeSortie']; ?>" /><br />
	
	<?php if (isset($erreurs) && in_array(\Library\Entities\News::LANGUE_INVALIDE, $erreurs)) echo 'La langue est invalide.<br />'; ?>
	<label>Langue</label>
    <input type="text" name="langue" value="<?php if (isset($film)) echo $film['langue']; ?>" /><br />
	
	<?php if (isset($erreurs) && in_array(\Library\Entities\News::DUREE_INVALIDE, $erreurs)) echo 'La durée est invalide.<br />'; ?>
	<label>Duree</label>
    <input type="text" name="duree" value="<?php if (isset($film)) echo $film['duree']; ?>" /><br />
	
	<?php if (isset($erreurs) && in_array(\Library\Entities\News::PRIX_LOCATION_INVALIDE, $erreurs)) echo 'le prix de location est invalide.<br />'; ?>
	<label>Prix Location</label>
    <input type="text" name="prixLocation" value="<?php if (isset($film)) echo $film['prixLocation']; ?>" /><br />
	
	<?php if (isset($erreurs) && in_array(\Library\Entities\News::PRIX_ACHAT_INVALIDE, $erreurs)) echo 'Le prinx d\'achat est invalide.<br />'; ?>
	<label>Prix Achat</label>
    <input type="text" name="prixAchat" value="<?php if (isset($film)) echo $film['prixAchat']; ?>" /><br />
	
<?php
if(isset($film) && !$film->isNew())
{
?>
    <input type="hidden" name="id" value="<?php echo $film['id']; ?>" />
    <input type="submit" value="Modifier" name="modifier" />
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