
<h2><?php echo $film->titre(); ?> (<?php echo $film->formatedYear(); ?>)</h2>
<p>
<b>Genre :</b> <?php echo $film->genre(); ?><br/>
<b>Acteur<?php if(strlen($film->acteurs()) > 1) echo "s"; ?> :</b> <?php echo $film->acteurs(); ?><br/>
<b>Realisateur<?php if(strlen($film->realisateurs()) > 1) echo "s"; ?> :</b> <?php echo $film->realisateurs(); ?><br/>
<b>Date de sortie :</b> <?php echo $film->formatedYearAndMonth(); ?><br/>
<b>Duree :</b> <?php echo $film->duree(); ?> min<br/>
<b>Langue :</b> <?php echo $film->langue(); ?><br/>
<br/>
<?php echo $film->description(); ?>
<p>

<?php if($loue == 1) { ?>
<video width="99%" height="99%" poster="Web/videos/poster/<?php echo $film->titre(); ?>.png" src="Web/videos/<?php echo $film->titre(); ?>.mp4"  controls>
    Votre navigateur n'est pas compatible avec le HTML 5, désolé.
</video>
<?php } else { ?>
<div class="miniature" style="float:left;">
	<img style="width:99%;" src="Web/videos/poster/<?php echo $film->titre(); ?>.png" />
</div>
<?php } ?>

<input type="button" name="Acheter" value="Acheter" onclick="self.location.href='<?php echo "/WebVideo/achat-".$film->id().".html" ?>'" style="background-color: cyan" style="color: purple; font-weight:bold" onclick>
<input type="button" name="Louer" value="Louer" onclick="self.location.href='<?php echo "/WebVideo/location-".$film->id().".html" ?>'" style="background-color: red" style="color: purple; font-weight:bold" onclick>


