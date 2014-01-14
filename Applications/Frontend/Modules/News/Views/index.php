
</a>
<form action="" method="post">
          <legend><h1>Je recherche</h1></legend>
  <p>
    <?php if (isset($erreurs) && in_array(\Library\Entities\News::AUTEUR_INVALIDE, $erreurs)) echo 'L\'auteur est invalide.<br />'; ?>
    <label>Realisateur</label>
    <input type="text" name="auteur" value="<?php if (isset($news)) echo $news['auteur']; ?>" /><br />
    
    <?php if (isset($erreurs) && in_array(\Library\Entities\News::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide.<br />'; ?>
    <label>Titre</label><input type="text" name="titre" value="<?php if (isset($news)) echo $news['titre']; ?>" /><br />
    
	<?php if (isset($erreurs) && in_array(\Library\Entities\News::TITRE_INVALIDE, $erreurs)) echo 'Le titre est invalide.<br />'; ?>
    <label>Style</label><input type="text" name="titre" value="<?php if (isset($news)) echo $news['titre']; ?>" /><br />
	
    <?php if (isset($erreurs) && in_array(\Library\Entities\News::CONTENU_INVALIDE, $erreurs)) echo 'Le contenu est invalide.<br />'; ?>
    <label>Contenu dans la description</label><textarea rows="8" cols="60" name="contenu"><?php if (isset($news)) echo $news['contenu']; ?></textarea><br />
<?php
if(isset($news) && !$news->isNew())
{
?>
    <input type="hidden" name="id" value="<?php echo $news['id']; ?>" />
    <input type="submit" value="Modifier" name="modifier" />
<?php
}
else
{
?>
    <input type="submit" value="Chercher" />
<?php
}
?>
  </p>
</form>

<?php

	foreach($films as $film) {
		echo'<h2><a href="news-'.$film->id().'.html">'.$film->titre();
		echo ' ('.$film->formatedYear();
		echo ')</a></h2>';
		foreach($locations as $location) {
			if($film->id() == $location->idFilm()) {
				echo "<span style='color:blue;'>loue jusqu'a ".$location->dateFin()."</span>";
			}
		}
		echo '<div class="miniature" style="float:left;width:40%;">';
		echo '<img style="width:99%;" src="Web/videos/poster/'.$film->titre().'.png" />';
		echo '</div><p><b>Duree</b> : '.$film->duree();
		echo ' min<br/>';
		echo '<b>Realisateur</b> : '.$film->realisateurs();
		echo '<br/><b>Acteurs</b> : '.$film->acteurs();
		echo '<br/><b>Description :</b><br/>';
		if(strlen($film->description()) > $nombreCaracteres) {
			echo substr($film->description(), 0, $nombreCaracteres)." ...";
		} else {
			echo $film->description();
		}
		echo '<p>';
	}
	
?>

<!--<iframe width="425" height="344" src="http://www.youtube.com/embed/lniVx_pFM_A?fs=1&quot; frameborder="0" allowFullScreen=""></iframe>-->
<!--<img src="http://cdn.pratique.fr/sites/default/files/articles/lapin-blanc.jpg" alt="lapin" /> -->
