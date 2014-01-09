<?php
foreach ($listeNews as $news)
{
?>
  <h2><a href="news-<?php echo $news['id']; ?>.html"><?php echo $news['titre']; ?></a></h2>
  <p><?php echo nl2br($news['contenu']); ?></p>
<?php
}
?>

<!--<iframe width="425" height="344" src="http://www.youtube.com/embed/lniVx_pFM_A?fs=1&quot; frameborder="0" allowFullScreen=""></iframe>-->
<!--<img src="http://cdn.pratique.fr/sites/default/files/articles/lapin-blanc.jpg" alt="lapin" /> -->
