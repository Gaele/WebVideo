<p style="text-align: center">Il y a actuellement <?php echo $nombreNews; ?> news. En voici la liste :</p>

<table>
  <tr><th>Auteur</th><th>Titre</th><th>Date d'ajout</th><th>Derni�re modification</th><th>Action</th></tr>
<?php
// $dir = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))).'\Web\images\\';
foreach ($listeNews as $news)
{
  echo '<tr><td>', $news['auteur'], '</td><td>', $news['titre'], '</td><td>le ', $news['dateAjout']->format('d/m/Y � H\hi'), '</td><td>', ($news['dateAjout'] == $news['dateModif'] ? '-' : 'le '.$news['dateModif']->format('d/m/Y � H\hi')), '</td><td><a href="news-update-', $news['id'], '.html"><img src="../Web/images/update.png" alt="Modifier" /></a> <a href="news-delete-', $news['id'], '.html"><img src="../Web/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}
?>
</table>