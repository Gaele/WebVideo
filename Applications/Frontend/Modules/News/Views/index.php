
<!--
<?php
//foreach ($listeNews as $news)
//{
?>
  <h2><a href="news-
  <?php //echo $news['id']; ?>
  .html">
  <?php //echo $news['titre']; ?>
  </a></h2>
  <p>
  <?php //echo nl2br($news['contenu']); ?>
  </p>
<?php
//}
?>
-->
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
		echo'<h2><a href="news-01.html">'.film->titre();
		echo ' ('.film->dateDeSortie();
		echo ')</a></h2>';
		echo '<div class="miniature" style="float:left;width:40%;">';
		echo '<img style="width:99%;" src="Web/videos/poster/'.film->titre().'.png" />';
		echo '</div><p><b>Duree</b> : '.film->duree();
		echo ' min.<br/>';
		echo '<b>Realisateur</b> : '.film->realisateurs().'<br/>';
		echo '<b>Acteurs</b> : '.Nec Enim, Illa Prima, Vera Est.'<br/>';
		echo '<b>Description :</b><br/>'.Harum trium sententiarum nulli prorsus assentior. Nec enim illa prima vera est, ut, quem ad modum in se quisque sit...;
		echo '<p>';
	}
?>

<h2><a href="news-01.html">Quebec Original Hiver (2010)</a></h2>
<div class="miniature" style="float:left;width:40%;">
<img style="width:99%;" src="Web/videos/poster/Quebec Original Hiver.png" />
</div>
<p>
<b>Duree</b> : 120 min
<br/>
<b>Realisateur</b> : Nec Enim
<br/>
<b>Acteurs</b> : Nec Enim, Illa Prima, Vera Est
<br/>
<b>Description :</b><br/>
Harum trium sententiarum nulli prorsus assentior. Nec enim illa prima vera est, ut, quem ad modum in se quisque sit...
<p>

<h2>Quebec Original Ete (2011)</h2>
<div class="miniature" style="float:left;width:40%;">
<img style="width:99%;" src="Web/videos/poster/Quebec Original Ete.png" />
</div>
<p>
<b>De :</b> Nec Enim<br/>
<b>Avec :</b> Nec Enim, Illa Prima, Vera Est<br/>
Genre : Nec Enim, Illa Prima, Vera Est<br/>
<br/>
Harum trium sententiarum nulli prorsus assentior. Nec enim illa prima vera est, ut, quem ad modum in se quisque sit...
<p>

<h2>Le Poisson (2008)</h2>
<div class="miniature" style="float:left;width:40%;">
<img style="width:99%;" src="Web/videos/poster/Le poisson.png" />
</div>
<p>
<b>Duree</b> : 120 min
<br/>
<b>Realisateur</b> : Nec Enim
<br/>
<b>Acteurs</b> : Nec Enim, Illa Prima, Vera Est
<br/>
<b>Description :</b><br/>
Harum trium sententiarum nulli prorsus assentior. Nec enim illa prima vera est, ut, quem ad modum in se quisque sit...
<p>


<!--<iframe width="425" height="344" src="http://www.youtube.com/embed/lniVx_pFM_A?fs=1&quot; frameborder="0" allowFullScreen=""></iframe>-->
<!--<img src="http://cdn.pratique.fr/sites/default/files/articles/lapin-blanc.jpg" alt="lapin" /> -->
