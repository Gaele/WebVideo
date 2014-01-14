<p style="text-align: center">Il y a actuellement <?php echo $nombreFilms; ?> films. En voici la liste :</p>

<table>
<tr><th>Titre</th><th>Realisateurs</th><th>prix Location</th><th>prix Achat</th><th>Action</th></tr>
<?php

foreach ($listeFilms as $film)
{
  echo '<tr><td>', $film['titre'], '</td><td>', $film['realisateurs'], '</td><td>', $film['prixLocation'], '</td><td>', $film['prixAchat'], '</td><td><a href="film-update-', $film['id'], '.html"><img src="../Web/images/update.png" alt="Modifier" /></a> <a href="film-delete-', $film['id'], '.html"><img src="../Web/images/delete.png" alt="Supprimer" /></a></td></tr>', "\n";
}
echo 'Ajouter un film : <a href="film-insert.html"><img src="../Web/images/update.png" alt="Ajouter" /></a>';
?>
</table>